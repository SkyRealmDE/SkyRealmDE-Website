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
        $teamRanks = explode(',', $teamRanks);

        $team = DB::select('SELECT lp.uuid, sp.username, lp.primary_group FROM luckperms_players lp JOIN realm_players sp ON UNHEX(REPLACE(lp.uuid, "-", "")) = sp.unique_id WHERE lp.primary_group != "default";');

        $prefixPermission = DB::select('SELECT `name`, `permission` FROM luckperms_group_permissions WHERE `permission` LIKE "prefix.%"');

        $prefixPermission = array_map(function ($permObj) {
            $splitted = explode('.', $permObj->permission);
            $permObj->weight = $splitted[1];
            preg_match('/<(?<color>#[a-f0-9]{6})>(?<rank>.*)/', $splitted[2], $matches);
            $permObj->prefix = $matches['rank'];
            $permObj->color = $matches['color'];

            return $permObj;
        }, $prefixPermission);

        $prefixPermission = array_reduce($prefixPermission, function ($carry, $item) {
            $carry[$item->name] = $item;

            return $carry;
        }, []);

        $team = array_map(function ($member) use ($prefixPermission) {
            $permObj = $prefixPermission[$member->primary_group];
            $member->rankWeight = $permObj->weight;
            $member->rankPrefix = $permObj->prefix;
            $member->color = $permObj->color;
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
