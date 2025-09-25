<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaffleResource;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PagSeguro; // Assuming the package is installed and the alias is available

class RaffleController extends Controller
{
    public function index()
    {
        $raffles = Raffle::query()
            ->withCount([
                'tickets as sold_tickets_count' => function ($query) {
                    $query->where('status', 'paid');
                },
            ])
            ->orderByDesc('created_at')
            ->get();

        return RaffleResource::collection($raffles);
    }

    public function show(Raffle $raffle)
    {
        $raffle->loadCount([
            'tickets as sold_tickets_count' => function ($query) {
                $query->where('status', 'paid');
            },
        ]);

        return new RaffleResource($raffle);
    }

    public function purchase(Request $request, Raffle $raffle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer|min:1',
        ]);

        $raffle->loadCount([
            'tickets as sold_tickets_count' => function ($query) {
                $query->where('status', 'paid');
            },
        ]);

        $availableTickets = max(0, $raffle->total_tickets - $raffle->sold_tickets_count);

        if ($availableTickets === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Este sorteio está esgotado.',
            ], 422);
        }

        if ($request->quantity > $availableTickets) {
            return response()->json([
                'success' => false,
                'message' => 'Quantidade solicitada indisponível.',
                'available_tickets' => $availableTickets,
            ], 422);
        }

        $customer = Customer::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name, 'phone' => $request->phone]
        );

        $totalPrice = (float) $raffle->ticket_price * $request->quantity;

        $purchase = Purchase::create([
            'customer_id' => $customer->id,
            'raffle_id' => $raffle->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        $pagseguroData = [
            'items' => [
                [
                    'id' => $raffle->id,
                    'description' => $raffle->name,
                    'quantity' => $request->quantity,
                    'amount' => number_format($raffle->ticket_price, 2, '.', ''),
                ],
            ],
            'sender' => [
                'name' => $customer->name,
                'email' => $customer->email,
            ],
            'currency' => 'BRL',
            'redirectURL' => route('pagseguro.success'),
            'notificationURL' => route('pagseguro.callback'),
            'reference' => (string) $purchase->id,
        ];

        try {
            $checkout = PagSeguro::checkout()->createFromArray($pagseguroData);
            $credentials = PagSeguro::credentials()->get();
            $information = $checkout->send($credentials);

            return response()->json([
                'success' => true,
                'message' => 'Checkout criado com sucesso.',
                'purchase_id' => $purchase->id,
                'payment_url' => $information->getLink(),
                'ticket_numbers' => [],
            ], 201);
        } catch (\Exception $e) {
            $purchase->update(['status' => 'failed']);

            Log::error('PagSeguro checkout error', [
                'purchase_id' => $purchase->id,
                'raffle_id' => $raffle->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Não foi possível iniciar o checkout. Tente novamente mais tarde.',
            ], 500);
        }
    }
}
