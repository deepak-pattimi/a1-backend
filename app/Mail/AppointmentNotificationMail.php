<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;

class AppointmentNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $paymentType = $this->appointment->payment_method === 'online' ? 'Razorpay Paid' : 'Pay at Clinic';
        $subject = 'New Appointment: ' . $this->appointment->fullname . ' - ' . $paymentType;

        return $this->subject($subject)
                    ->view('emails.appointment_notification');
    }
}
