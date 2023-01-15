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
        $job = Jobs::all()->find($id);
        $this->sendApplyWebhook($job->title, $request->post('about'), $job->color, $request->post('discord'),
            $request->post('mail'), $request->post('name'), $request->post('attachments'));
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
    private function sendApplyWebhook($title, $about, $color, $discord, $mail, $name, $attachments) {
        $embed = new Embed();
        $embed->setTitle($title);
        $embed->setDescription($about);
        $embed->setColor(hexdec($color));
        $embed->addField("Discord Name", $discord, true);
        $embed->addField("E-Mail", $mail, true);
        $embed->addField("Name", $name, true);
        $embed->addField("Anhänge", $attachments);
        $embed->setFooter("Neue Bewerbung erhalten", "https://skyrealm.de/android-chrome-512x512.png");
        $embed->setTimestamp(date('c', strtotime('now')));

        $hook = new Webhook();
        $hook->setEmbed($embed);
        $hook->send("DISCORD_WEBHOOK_JOB");
    }

}
