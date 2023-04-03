<?php

namespace App\Http\Controllers;

use App\Models\PlayerStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatistkenController extends Controller
{
    public function index()
    {
        $topUsers = DB::select('SELECT *, HEX(unique_id) AS uuid FROM `realm_players` WHERE `xp` > 0 ORDER BY `xp` DESC LIMIT 12');

        $topUsers = array_map(function ($user) {
            // Add - to uuid
            $user->formattedUUID = substr($user->uuid, 0, 8).'-'.substr($user->uuid, 8, 4).'-'.substr($user->uuid, 12, 4).'-'.substr($user->uuid, 16, 4).'-'.substr($user->uuid, 20, 12);
            $userLP = DB::selectOne('SELECT * FROM luckperms_players WHERE `uuid` = ?', [$user->formattedUUID]);
            $user->rank = match ($userLP->primary_group) {
                'webdev' => 'Web-Dev',
                'eventmanager' => 'EventManager',
                default => Str::title($userLP->primary_group),
            };
            $user->name = $user->username;

            $prefixPermission = DB::selectOne('SELECT `name`, `permission` FROM luckperms_group_permissions WHERE `permission` LIKE "prefix.%" AND `name` = ?', [$userLP->primary_group]);
            $splitted = explode('.', $prefixPermission->permission);
            preg_match('/<(?<color>#[a-f0-9]{6})>(?<rank>.*)/', $splitted[2], $matches);
            $user->prefix = $matches['rank'];
            $user->color = $matches['color'];

            $user->statistics = new PlayerStatistics($user->uuid);

            return $user;
        }, $topUsers);

        return view('stats', ['topUsers' => $topUsers]);
    }

    public function userStats(Request $request, string $uuid)
    {
        $userLP = DB::selectOne('SELECT * FROM luckperms_players WHERE `uuid` = ?', [$uuid]);
        $uuidAsUUID = str_replace('-', '', $uuid);
        $userRealm = DB::selectOne('SELECT * FROM realm_players WHERE `unique_id` = UNHEX(?)', [$uuidAsUUID]);

        if ($userLP == null || $userRealm == null) {
            return view('stats.nouser', ['uuid' => $uuid]);
        }

        $user = (object) array_merge((array) $userLP, (array) $userRealm);
        $user->rank = Str::title($user->primary_group);
        $user->name = Str::title($user->username);
        $user->statistics = new PlayerStatistics($uuidAsUUID);

        return view('stats.userstats', ['user' => $user]);
    }
}
