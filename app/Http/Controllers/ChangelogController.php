<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Parsedown;

class ChangelogController extends Controller
{
    public function index(): Factory|View|Application
    {
        $changelogs = [];
        $changelogDir = storage_path('changelogs');
        $parseDown = new Parsedown();

        foreach (glob("$changelogDir/*.md") as $filename) {
            $basename = basename($filename, '.md');
            $parts = explode('-', $basename);
            $changelogs[] = [
                'filename' => $filename,
                'title' => implode(' ', array_slice($parts, 3)),
                'date' => implode('.', array_slice($parts, 0, 3)),
                'anchor' => strtolower(str_replace(' ', '-', implode('-', array_slice($parts, 3)))),
                'content' => $parseDown->text(file_get_contents($filename)),
            ];
        }

        usort($changelogs, function ($a, $b) {
            return $b['date'] <=> $a['date'];
        });



        return view('changelogs.index', ['changelogs' => $changelogs]);
    }
}
