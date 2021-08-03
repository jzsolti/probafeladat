<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CheckSheet;

class CheckSheetCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $checkSheet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CheckSheet $checkSheet)
    {
        $this->checkSheet = $checkSheet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.checksheet_created');
    }
}
