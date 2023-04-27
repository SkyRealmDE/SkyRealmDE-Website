<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Parsedown;

class GuidesController extends Controller
{
    private array $guides;

    private $parseDown;

    public function __construct()
    {
        $this->guides = [];
        $guidesDir = storage_path('guides');
        $this->parseDown = new Parsedown();

        foreach (glob("$guidesDir/*.md") as $filename) {
            $basename = basename($filename, '.md');
            $parts = explode('-', $basename);
            $this->guides[strtolower(str_replace(' ', '-', implode('-', $parts)))] = [
                'filename' => $filename,
                'title' => implode(' ', $parts),
            ];
        }
    }

    public function index(): Factory|View|Application
    {
        return view('guides.index', ['guides' => $this->guides]);
    }

    public function view($guide): Factory|View|Application
    {
        if (!isset($this->guides[$guide])) {
            abort(404);
        }

        $guide = $this->guides[$guide];

        $guide['content'] = $this->parseDown->text(file_get_contents($guide['filename']));

        return view('guides.view', [
            'guide' => $guide
        ]);
    }
}
