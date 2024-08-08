<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $form;


    public function __construct($form)
    {
        $this->form = (object) $form;
    }

    public function build()
    {
        $subject = __('admin.email.contact.title');
        $subject .= ' '.getConstField('page_title');

        return $this->subject($subject)
            ->view('mail.form_contact');
    }
}
