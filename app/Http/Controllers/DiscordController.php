<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiscordController extends Controller
{

    public function testWebhook(Request $request)
    {
        $this->sendWebhook($request);
        return view('home');
    }


    private function sendWebhook(Request $request) {
        $WEBHOOK_URL = env('DISCORD_WEBHOOK');

        if($WEBHOOK_URL == null) {
            return;
        }

        $data = [
            'content' => null,
            'embeds' => [
                [
                    'title' => 'Website Benachrichtigung 🌶️',
                    'description' => 'Es wurde ein Test-Login empfangen.\nDaten wurden gespeichert und übertragen.',
                    'url' => 'https://skyrealm.de',
                    'color' => hexdec('badc58'),
                    'fields' => [
                        [
                            'name' => '=+= User',
                            'value' => '```' . $request->ip() . '\n' . $request->userAgent() . '```',
                            'inline' => true
                        ]
                    ],
                    'footer' => [
                        'text' => 'Powered by SkyRealmDE ❤️',
                        'icon_url' => 'https://skyrealm.de/android-chrome-512x512.png'
                    ],
                    'timestamp' => date('c', strtotime('now')),
                    'thumbnail' => [
                        'url' => 'https://skyrealm.de/android-chrome-512x512.png'
                    ]
                ]
            ],
            'attachments' => []
        ];

        $json_data = json_encode($data);
        Http::post($WEBHOOK_URL, $json_data);
    }
}
