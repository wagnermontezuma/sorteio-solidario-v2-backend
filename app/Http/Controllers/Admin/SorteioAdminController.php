<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sorteio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SorteioAdminController extends Controller
{
    public function index(): View
    {
        $sorteios = Sorteio::query()->latest()->paginate(15);

        return view('admin.sorteios.index', compact('sorteios'));
    }

    public function create(): View
    {
        return view('admin.sorteios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'premio' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'regras' => ['nullable', 'string'],
            'status' => ['required', 'in:active,completed,cancelled'],
            'valor_bilhete' => ['required', 'numeric', 'min:0'],
            'total_bilhetes' => ['required', 'integer', 'min:1'],
            'data_sorteio' => ['nullable', 'date'],
            'imagem_url' => ['required', 'url', 'max:255'],
        ]);

        $slugBase = Str::slug($dados['titulo']);
        $slug = $slugBase !== '' ? $slugBase : Str::slug($dados['titulo'].'-'.now()->timestamp);
        $contador = 1;

        while (Sorteio::where('slug', $slug)->exists()) {
            $slug = $slugBase.'-'.$contador;
            $contador++;
        }

        Sorteio::create([
            'name' => $dados['titulo'],
            'slug' => $slug,
            'prize' => $dados['premio'],
            'description' => $dados['descricao'],
            'rules' => $dados['regras'] ?? null,
            'status' => $dados['status'],
            'ticket_price' => $dados['valor_bilhete'],
            'total_tickets' => $dados['total_bilhetes'],
            'draw_date' => $dados['data_sorteio'] ?? null,
            'image_url' => $dados['imagem_url'],
            'gallery_images' => [],
        ]);

        return redirect()
            ->route('admin.sorteios.index')
            ->with('success', 'Sorteio criado com sucesso!');
    }
}
