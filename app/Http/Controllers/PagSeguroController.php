<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseConfirmationMail;
use App\Models\Purchase;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PagSeguro; // Assuming the package is installed

class PagSeguroController extends Controller
{
    public function callback(Request $request)
    {
        try {
            $credentials = PagSeguro::credentials()->get();
            $transaction = PagSeguro::transaction()->get($request->notificationCode, $credentials);

            $purchase = Purchase::find($transaction->getReference());

            if ($purchase) {
                $purchase->status = $transaction->getStatus()->getName(); // e.g., 'PAID', 'CANCELLED'
                $purchase->save();

                if ($transaction->getStatus()->getName() === 'PAID' && $purchase->tickets()->count() === 0) {
                    $raffle = $purchase->raffle;
                    $ticketNumbers = [];

                    for ($i = 0; $i < $purchase->quantity; $i++) {
                        $ticket = Ticket::create([
                            'purchase_id' => $purchase->id,
                            'raffle_id' => $raffle->id,
                            'number' => $this->generateUniqueTicketNumber($raffle->id),
                            'status' => 'paid',
                        ]);

                        $ticketNumbers[] = $ticket->number;
                    }

                    if (! empty($ticketNumbers)) {
                        $purchase->loadMissing('customer', 'raffle');

                        if ($purchase->customer && $purchase->customer->email) {
                            Mail::to($purchase->customer->email)->send(
                                new PurchaseConfirmationMail($purchase, $ticketNumbers)
                            );
                        }
                    }
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('PagSeguro callback error', [
                'notification_code' => $request->notificationCode,
                'error' => $e->getMessage(),
            ]);

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function success()
    {
        $successUrl = config('services.frontend.success_url', '/');

        if (filter_var($successUrl, FILTER_VALIDATE_URL)) {
            return redirect()->away($successUrl);
        }

        return redirect($successUrl ?: '/');
    }

    private function generateUniqueTicketNumber($raffleId)
    {
        do {
            $number = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (Ticket::where('raffle_id', $raffleId)->where('number', $number)->exists());

        return $number;
    }
}
