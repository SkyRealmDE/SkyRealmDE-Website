<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeamController extends Controller
{

    public function index()
    {
        $teamRanks = DB::selectOne('SELECT `groups` FROM luckperms_tracks WHERE `name` = "team"')->groups;
        $teamRanks = Str::replace('[', '', $teamRanks);
        $teamRanks = Str::replace(']', '', $teamRanks);
        $teamRanks = Str::replace('"', '', $teamRanks);
        $teamRanks = explode(",", $teamRanks);

        $team = DB::select('SELECT `uuid`, `username`, `primary_group` FROM luckperms_players WHERE `primary_group` != "default"');

        $rankWeights = DB::select('SELECT `name`, `permission` FROM luckperms_group_permissions WHERE `permission` LIKE "weight.%"');

        $rankWeights = array_map(function ($rankWeight) {
            $rankWeight->permission = Str::replace('weight.', '', $rankWeight->permission);
            return $rankWeight;
        }, $rankWeights);

        $rankWeights = array_column($rankWeights, 'permission', 'name');

        $team = array_map(function ($member) use ($rankWeights) {
            $member->rankWeight = $rankWeights[$member->primary_group];
            $member->rank = Str::title($member->primary_group);
            $member->name = Str::title($member->username);
            return $member;
        }, $team);

        $team = array_filter($team, function ($member) use ($teamRanks) {
            return in_array($member->primary_group, $teamRanks);
        });

        // Sort by rank weight
        usort($team, function ($a, $b) {
            return $b->rankWeight <=> $a->rankWeight;
        });

        return view('team', ['team' => $team]);
    }
}
