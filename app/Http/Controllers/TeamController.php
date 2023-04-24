<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;

class TeamController extends Controller
{
    public function index(): View|FoundationApplication|Factory|ContractApplication
    {
        $teamRanks = DB::selectOne('SELECT `groups` FROM luckperms_tracks WHERE `name` = "team"')->groups;
        $teamRanks = Str::replace('[', '', $teamRanks);
        $teamRanks = Str::replace(']', '', $teamRanks);
        $teamRanks = Str::replace('"', '', $teamRanks);
        $teamRanks = explode(',', $teamRanks);

        $team = DB::select(
            'SELECT lp.uuid, sp.username, lp.primary_group
            FROM luckperms_players lp JOIN realm_players sp ON UNHEX(REPLACE(lp.uuid, "-", "")) = sp.unique_id
            WHERE lp.primary_group != "default";'
        );

        $prefixPermission = DB::select(
            'SELECT `name`, `permission`
            FROM luckperms_group_permissions
            WHERE `permission` LIKE "prefix.%"'
        );

        $prefixPermission = array_map(function ($permObj) {
            $split = explode('.', $permObj->permission);
            $permObj->weight = $split[1];
            preg_match('/<(?<color>#[a-f0-9]{6})>(?<rank>.*)/', $split[2], $matches);

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
            $member->rank = match ($member->primary_group) {
                'webdev' => 'Web-Dev',
                'eventmanager' => 'EventManager',
                default => Str::title($member->primary_group),
            };
            $member->name = $member->username;

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
