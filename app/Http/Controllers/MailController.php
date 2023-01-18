<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function sendApplyMail($name, $email, $job) {
        Mail::send('emails.apply_email', ['name' => $name, 'job' => $job], function ($message) use ($job, $email) {
            $message->to($email)->subject("Vielen Dank für deine Bewerbung als $job bei SkyRealm");
        });
    }
    public function sendApproveMail($name, $email, $day, $date, $time, $participants) {
        Mail::send('emails.approve_email', ['name' => $name, 'day' => $day, 'date' => $date, 'time' => $time, 'participants' => $participants], function ($message) use ($email) {
            $message->to($email)->subject("Einladung zum Online-Interview - SkyRealm");
        });
    }
    public function sendDenyMail($name, $email) {
        Mail::send('emails.deny_email', ['name' => $name], function ($message) use ($email) {
            $message->to($email)->subject("Deine Bewerbung bei SkyRealm");
        });
    }

}
