<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Jobs;
use Illuminate\Http\Request;

class JobsController extends Controller
{

    public function index() {
        $jobs = Jobs::all()->filter(function ($job) {
            return $job->active == 1;
        });

        return view('jobs', ['openJobs' => $jobs]);
    }

    public function byId(Request $request, $id) {
        $job = Jobs::all()->find($id);
        return view('jobs.job', ['job' => $job]);
    }

    public function sendHook(Apply $apply) {
        $webhookurl = "https://discord.com/api/webhooks/1063798755163390052/6RS2znihexYXhWh2ORcgdP0F4Et14Hzf2i53T6VTPiOJ1AatL9E9kuzuqqNqRmR5Laob";
        $timestamp = date("c", strtotime("now"));
        $json_data = json_encode([
            'content' => null,
            'embeds' => [
                [
                    'title' => $apply->title,
                    'type' => 'rich',
                    'description' => $apply->about,
                    'color' => hexdec($apply->color),
                    'fields' => [
                        [
                            'name' => 'Discord Name',
                            'value' => $apply->discord,
                            'inline' => true
                        ],
                        [
                            'name' => 'E-Mail',
                            'value' => $apply->mail,
                            'inline' => true
                        ],
                        [
                            'name' => 'Name',
                            'value' => $apply->name,
                            'inline' => true
                        ],
                        [
                            'name' => 'Anhänge',
                            'value' => $apply->attachments,
                            'inline' => true
                        ]
                    ],
                    'footer' => [
                        'text' => 'Neue Bewerbung erhalten',
                        'icon_url' => 'https://skyrealm.de/android-chrome-512x512.png'
                    ],
                    'timestamp' => $timestamp
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
        $ch = curl_init( $webhookurl );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec( $ch );
        // If you need to debug, or find out why you can't send message uncomment line below, and execute script.
        // echo $response;
        curl_close( $ch );
    }

}
