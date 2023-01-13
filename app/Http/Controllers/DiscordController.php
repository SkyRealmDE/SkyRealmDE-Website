<?php

namespace App\Http\Controllers;

use App\Models\Discord\Embed;
use App\Models\Discord\Webhook;
use Illuminate\Http\Request;

class DiscordController extends Controller
{

    public function testWebhook(Request $request)
    {
        $this->sendWebhook($request);
        return view('home');
    }


    private function sendWebhook(Request $request) {
        $embed = new Embed();
        $embed->setTitle('Website Benachrichtigung 🌶️');
        $embed->setDescription('Es wurde ein Test-Login empfangen.\nDaten wurden gespeichert und übertragen.');
        $embed->setURL('https://skyrealm.de');
        $embed->setColor(hexdec('badc58'));
        $embed->setFooter('Powered by SkyRealmDE ❤️', 'https://skyrealm.de/android-chrome-512x512.png');
        $embed->setTimestamp(date('c', strtotime('now')));
        $embed->setThumbnail('https://skyrealm.de/android-chrome-512x512.png');
        $embed->addField('=+= User', '```' . $request->ip() . '\n' . $request->userAgent() . '```', true);

        $hook = new Webhook();
        $hook->setEmbed($embed);
        $hook->send();
    }
}
