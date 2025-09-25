<?php

namespace App\Mail;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Purchase $purchase;

    /**
     * @var array<int, string>
     */
    public array $ticketNumbers;

    public function __construct(Purchase $purchase, array $ticketNumbers)
    {
        $this->purchase = $purchase;
        $this->ticketNumbers = $ticketNumbers;
    }

    public function build(): self
    {
        $raffleName = $this->purchase->raffle->name ?? 'Sorteio Solidário';

        return $this
            ->subject("Confirmação da sua participação - {$raffleName}")
            ->view('emails.purchase-confirmed');
    }
}
