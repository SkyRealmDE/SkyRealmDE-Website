<?php

namespace App\Http\Controllers;

use App\Models\Discord\Embed;
use App\Models\Discord\Webhook;
use App\Models\Jobs;
use Exception;
use Illuminate\Http\Request;

class DiscordController extends Controller
{

    public function testWebhook(Request $request)
    {
        $this->sendWebhook($request);
        return view('home');
    }

    public function applyWebhook(Request $request, $id)
    {

        // Check if cf-turnstile-response is valid
        if (!$request->has('cf-turnstile-response')) {
            return redirect()->back()->with('error', 'Du hast den Captcha nicht bestätigt!');
        }

        $recaptcha_url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
        $recaptcha_secret = env('CFCAPTCHA_SECRET');
        $recaptcha_response = $request->post('cf-turnstile-response');

        // Make and decode POST request:
        $data = array('secret' => $recaptcha_secret, 'response' => $recaptcha_response);

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($recaptcha_url, false, $context);
        if ($result === FALSE) return redirect()->back()->with('error', 'Du hast den Captcha nicht bestätigt!');

        $recaptcha = $result;
        $recaptcha = json_decode($recaptcha);
        //print_r($recaptcha);
        // Take action based on the score returned:
        if (!$recaptcha->success) {
            return redirect()->back()->with('error', 'Du hast den Captcha nicht bestätigt!');
        }

        $job = Jobs::all()->find($id);
        $this->sendApplyWebhook($job->title, $request->post('about'), $job->color, $request->post('discord'),
            $request->post('mail'), $request->post('name'));

        // Send mail to user using PHPMailer
        $mail = new MailController();
        $mail->sendApplyMail($request->post('name'), $request->post('mail'), $job->title);

        return view('jobs.applied', ['title' => $job->title]);
    }


    /**
     * @throws Exception
     */
    private function sendWebhook(Request $request) {
        $embed = new Embed();
        $embed->setTitle('Website Benachrichtigung 🌶️');
        $embed->setDescription('Es wurde ein Test-Login empfangen. Daten wurden gespeichert und übertragen.');
        $embed->setURL('https://skyrealm.de');
        $embed->setColor(hexdec('badc58'));
        $embed->setFooter('Powered by SkyRealmDE ❤️', 'https://skyrealm.de/android-chrome-512x512.png');
        $embed->setTimestamp(date('c', strtotime('now')));
        $embed->addField('=+= IP', '```' . $request->ip() . '```', false);
        $embed->addField('=+= User-Agent', '```' . $request->userAgent() . '```', false);

        $hook = new Webhook();
        $hook->setEmbed($embed);
        $hook->send("DISCORD_WEBHOOK_SHOP");
    }

    /**
     * @throws Exception
     */
    private function sendApplyWebhook($title, $about, $color, $discord, $mail, $name) {
        $embed = new Embed();
        $embed->setTitle($name." hat sich als ".$title." beworben");
        $embed->setColor(hexdec(str_replace('#', '', $color)));
        $embed->addField("=+= Discord", "```$discord```");
        $embed->addField("=+= E-Mail", "```$mail```");
        $embed->addField("=+= Name", "```$name```");
        $embed->addField("=+= Über mich", "```".PHP_EOL."$about```");
        $embed->setFooter("Neue Bewerbung erhalten", "https://skyrealm.de/android-chrome-512x512.png");
        $embed->setTimestamp(date('c', strtotime('now')));

        $hook = new Webhook();
        $hook->setEmbed($embed);
        $hook->send("DISCORD_WEBHOOK_JOB");
    }

}
