<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$items,$company)
    {
        $this->data = $data;
        $this->items = $items;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('softsb7@gmail.com')->subject("Invoice")->view('pages.invoices.sale_invoice_email')->with('data',$this->data)->with('items',$this->items)->with('company',$this->company);
    }
}
