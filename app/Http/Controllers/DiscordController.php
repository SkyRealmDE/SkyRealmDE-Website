<?php

namespace App\Http\Controllers;

use App\Models\Discord\Embed;
use App\Models\Discord\Webhook;
use App\Models\Jobs;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;

class DiscordController extends Controller
{
    /**
     * @throws Exception
     */
    public function testWebhook(Request $request): View|FoundationApplication|Factory|ContractApplication
    {
        $this->sendWebhook($request);

        return view('home');
    }

    /**
     * @throws Exception
     */
    public function applyWebhook(Request $request, $id)
    {
        $incorrectCaptchaText = 'Du hast den Captcha nicht bestanden!';

        // Check if cf-turnstile-response is valid
        if (! $request->has('cf-turnstile-response')) {
            return redirect()->back()->with('error', $incorrectCaptchaText);
        }

        $recaptchaUrl = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
        $recaptchaSecret = env('CFCAPTCHA_SECRET');
        $recaptchaResponse = $request->post('cf-turnstile-response');

        // Make and decode POST request:
        $data = ['secret' => $recaptchaSecret, 'response' => $recaptchaResponse];

        // use key 'http' even if you send the request to https://...
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($recaptchaUrl, false, $context);
        if ($result === false) {
            return redirect()->back()->with('error', $incorrectCaptchaText);
        }

        $recaptcha = $result;
        $recaptcha = json_decode($recaptcha);
        //print_r($recaptcha);
        // Take action based on the score returned:
        if (! $recaptcha->success) {
            return redirect()->back()->with('error', $incorrectCaptchaText);
        }

        $job = Jobs::all()->find($id);
        $this->sendApplyWebhook(
            $job->title,
            $request->post('about'),
            $job->color,
            $request->post('discord'),
            $request->post('mail'),
            $request->post('name'),
            $request->post('age'),
            $request->post('strengths'),
            $request->post('weaknesses'),
            $request->post('online'),
            $request->post('knowledge'),
            $request->post('referer')
        );

        try {
            // Send mail to user using PHPMailer
            $mail = new MailController();
            $mail->sendApplyMail($request->post('name'), $request->post('mail'), $job->title);
        } catch (Exception $exception) {
            return redirect()->back()->
            with('error', 'Es ist ein Fehler aufgetreten. Wir konnten dir keine Bestätigungs E-Mail senden.');
        }

        return view('jobs.applied', ['title' => $job->title]);
    }

    /**
     * @throws Exception
     */
    private function sendWebhook(Request $request): void
    {
        $embed = new Embed();
        $embed->setTitle('Website Benachrichtigung 🌶️');
        $embed->setDescription('Es wurde ein Test-Login empfangen. Daten wurden gespeichert und übertragen.');
        $embed->setURL('https://skyrealm.de');
        $embed->setColor(hexdec('badc58'));
        $embed->setFooter('Powered by SkyRealmDE ❤️', 'https://skyrealm.de/android-chrome-512x512.png');
        $embed->setTimestamp(date('c', strtotime('now')));
        $embed->addField('=+= IP', '```'.$request->ip().'```', false);
        $embed->addField('=+= User-Agent', '```'.$request->userAgent().'```', false);

        $hook = new Webhook();
        $hook->setEmbed($embed);
        $hook->send('DISCORD_WEBHOOK_SHOP');
    }

    /**
     * @throws Exception
     */
    private function sendApplyWebhook($title,
                                      $about,
                                      $color,
                                      $discord,
                                      $mail,
                                      $name,
                                      $age,
                                      $strengths,
                                      $weaknesses,
                                      $online,
                                      $knowledge,
                                      $referer
    )
    {
        $embed = new Embed();
        $embed->setTitle($name.' hat sich als '.$title.' beworben');
        $embed->setColor(hexdec(str_replace('#', '', $color)));
        $embed->addField('=+= Discord', "```$discord```");
        $embed->addField('=+= E-Mail', "```$mail```");
        $embed->addField('=+= Name', "```$name```");
        $embed->addField('=+= Alter', "```$age```");
        $embed->addField('=+= Online', "```$online```");
        $embed->addField('=+= Stärken', "```$strengths```", false);
        $embed->addField('=+= Schwächen', "```$weaknesses```", false);
        $embed->addField('=+= Minecraft Java Erfahrung', "```$knowledge```", false);
        $embed->addField('=+= Wie hast du von SkyRealmDE erfahren?', "```$referer```", false);
        $line = 1;
        $aboutBlocks = str_split($about, 1000);
        foreach ($aboutBlocks as $block) {
            $embed->addField('=+= Über mich ('.$line.')', '```'.PHP_EOL."$block```", false);
            ++$line;
        }
        $embed->setFooter('Neue Bewerbung erhalten', 'https://skyrealm.de/android-chrome-512x512.png');
        $embed->setTimestamp(date('c', strtotime('now')));

        $hook = new Webhook();
        $hook->setEmbed($embed);
        $hook->send('DISCORD_WEBHOOK_JOB');
    }
}
