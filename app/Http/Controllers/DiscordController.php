<?php

namespace App\Http\Controllers;

use App\Models\Discord\Embed;
use App\Models\Discord\Webhook;
use Exception;
use Illuminate\Http\Request;

class DiscordController extends Controller
{

    public function testWebhook(Request $request)
    {
        $this->sendWebhook($request);
        return view('home');
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
        $hook->send();
    }
}
