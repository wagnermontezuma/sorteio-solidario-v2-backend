<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RaffleAdminController extends Controller
{
    public function index(Request $request): View
    {
        $raffles = Raffle::query()
            ->withCount(['tickets as paid_tickets_count' => fn ($query) => $query->where('status', 'paid')])
            ->when($request->input('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('controle.raffles.index', [
            'raffles' => $raffles,
            'filters' => $request->only('search'),
        ]);
    }

    public function create(): View
    {
        return view('controle.raffles.form', [
            'raffle' => new Raffle(),
            'mode' => 'create',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        if (blank($data['slug'] ?? null)) {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['slug'] = $this->ensureUniqueSlug($data['slug']);
        $data['gallery_images'] = $this->splitGalleryImages($request->input('gallery_images_raw'));
        $data['draw_date'] = $this->normalizeDrawDate($data['draw_date'] ?? null);

        Raffle::create($data);

        return redirect()
            ->route('controle.raffles.index')
            ->with('status', 'Sorteio criado com sucesso.');
    }

    public function edit(Raffle $raffle): View
    {
        return view('controle.raffles.form', [
            'raffle' => $raffle,
            'mode' => 'edit',
        ]);
    }

    public function update(Request $request, Raffle $raffle): RedirectResponse
    {
        $data = $this->validatedData($request, $raffle->id);

        if (blank($data['slug'] ?? null)) {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['slug'] = $this->ensureUniqueSlug($data['slug'], $raffle->id);
        $data['gallery_images'] = $this->splitGalleryImages($request->input('gallery_images_raw'));
        $data['draw_date'] = $this->normalizeDrawDate($data['draw_date'] ?? null);

        $raffle->update($data);

        return redirect()
            ->route('controle.raffles.edit', $raffle)
            ->with('status', 'Sorteio atualizado com sucesso.');
    }

    public function destroy(Raffle $raffle): RedirectResponse
    {
        $raffle->delete();

        return redirect()
            ->route('controle.raffles.index')
            ->with('status', 'Sorteio removido.');
    }

    private function validatedData(Request $request, ?int $raffleId = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'rules' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url', 'max:255'],
            'ticket_price' => ['required', 'numeric', 'min:0'],
            'total_tickets' => ['required', 'integer', 'min:1'],
            'draw_date' => ['nullable', 'date'],
            'status' => ['required', 'in:active,completed,cancelled'],
        ]);
    }

    private function splitGalleryImages(?string $raw): array
    {
        return array_values(array_filter(array_map(function ($line) {
            $line = trim($line);
            return filter_var($line, FILTER_VALIDATE_URL) ? $line : null;
        }, preg_split('/\r\n|\r|\n/', $raw ?? ''))));
    }

    private function normalizeDrawDate($value): ?string
    {
        if (blank($value)) {
            return null;
        }

        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    private function ensureUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $original = $slug;
        $suffix = 1;

        while (
            Raffle::where('slug', $slug)
                ->when($ignoreId, fn ($query, $id) => $query->where('id', '!=', $id))
                ->exists()
        ) {
            $slug = $original.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
