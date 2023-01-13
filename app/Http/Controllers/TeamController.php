<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{

    public function index()
    {
        $team = DB::select('SELECT `uuid`, `username` FROM luckperms_players WHERE `primary_group` = "team"');
        return view('team', ['team' => $team]);
    }
}
