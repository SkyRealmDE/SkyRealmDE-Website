<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class PlayerStatistics
{
    private $uniqueId;

    public $damageDealt = 0;

    public $damageTaken = 0;

    public $deaths = 0;

    public $mobKills = 0;

    public $playerKills = 0;

    public $fishCaught = 0;

    public $animalsBred = 0;

    public $timesQuit = 0;

    public $jumps = 0;

    public $dropCount = 0;

    public $totalOnlineTime = 0;

    public $sneakTime = 0;

    public $walkCms = 0;

    public $walkOnWaterCms = 0;

    public $fallCms = 0;

    public $climbCms = 0;

    public $flyCms = 0;

    public $walkUnderWaterCms = 0;

    public $minecartCms = 0;

    public $boatCms = 0;

    public $pigCms = 0;

    public $horseCms = 0;

    public $sprintCms = 0;

    public $crouchCms = 0;

    public $aviateCms = 0;

    public $striderCms = 0;

    public $talkedToVillagers = 0;

    public $tradedWithVillagers = 0;

    public $onlineTime = '-';

    public $asList = [];

    public function __construct($uniqueId)
    {
        $this->uniqueId = $uniqueId;

        $dbRow = DB::selectOne('SELECT * FROM `player_statistics` WHERE `unique_id` = UNHEX(?)', [$uniqueId]);

        if ($dbRow) {
            $this->damageDealt = $dbRow->damage_dealt;
            $this->damageTaken = $dbRow->damage_taken;
            $this->deaths = $dbRow->deaths;
            $this->mobKills = $dbRow->mob_kills;
            $this->playerKills = $dbRow->player_kills;
            $this->fishCaught = $dbRow->fish_caught;
            $this->animalsBred = $dbRow->animals_bred;
            $this->timesQuit = $dbRow->times_quit;
            $this->jumps = $dbRow->jumps;
            $this->dropCount = $dbRow->drop_count;
            $this->totalOnlineTime = $dbRow->total_online_time;

            // Calculate online time (totalOnlineTime is in 1/20 seconds)
            $this->onlineTime = $this->calculateOnlineTime($this->totalOnlineTime);

            $this->sneakTime = $dbRow->sneak_time;
            $this->walkCms = $dbRow->walk_cms;
            $this->walkOnWaterCms = $dbRow->walk_on_water_cms;
            $this->fallCms = $dbRow->fall_cms;
            $this->climbCms = $dbRow->climb_cms;
            $this->flyCms = $dbRow->fly_cms;
            $this->walkUnderWaterCms = $dbRow->walk_under_water_cms;
            $this->minecartCms = $dbRow->minecart_cms;
            $this->boatCms = $dbRow->boat_cms;
            $this->pigCms = $dbRow->pig_cms;
            $this->horseCms = $dbRow->horse_cms;
            $this->sprintCms = $dbRow->sprint_cms;
            $this->crouchCms = $dbRow->crouch_cms;
            $this->aviateCms = $dbRow->aviate_cms;
            $this->striderCms = $dbRow->strider_cms;
            $this->talkedToVillagers = $dbRow->talked_to_villagers;
            $this->tradedWithVillagers = $dbRow->traded_with_villagers;

            $this->asList = [
                'damageDealt' => $this->damageDealt,
                'damageTaken' => $this->damageTaken,
                'deaths' => $this->deaths,
                'mobKills' => $this->mobKills,
                'playerKills' => $this->playerKills,
                'fishCaught' => $this->fishCaught,
                'animalsBred' => $this->animalsBred,
                'timesQuit' => $this->timesQuit,
                'jumps' => $this->jumps,
                'dropCount' => $this->dropCount,
                'totalOnlineTime' => $this->totalOnlineTime,
                'sneakTime' => $this->sneakTime,
                'walkCms' => $this->walkCms,
                'walkOnWaterCms' => $this->walkOnWaterCms,
                'fallCms' => $this->fallCms,
                'climbCms' => $this->climbCms,
                'flyCms' => $this->flyCms,
                'walkUnderWaterCms' => $this->walkUnderWaterCms,
                'minecartCms' => $this->minecartCms,
                'boatCms' => $this->boatCms,
                'pigCms' => $this->pigCms,
                'horseCms' => $this->horseCms,
                'sprintCms' => $this->sprintCms,
                'crouchCms' => $this->crouchCms,
                'aviateCms' => $this->aviateCms,
                'striderCms' => $this->striderCms,
                'talkedToVillagers' => $this->talkedToVillagers,
                'tradedWithVillagers' => $this->tradedWithVillagers,
            ];
        }
    }

    // Calculate online time (totalOnlineTime is in 1/20 seconds)
    private function calculateOnlineTime($totalOnlineTime)
    {
        $seconds = $totalOnlineTime / 20;
        $minutes = $seconds / 60;
        $hours = $minutes / 60;
        $days = $hours / 24;

        $seconds = $seconds % 60;
        $minutes = $minutes % 60;
        $hours = $hours % 24;
        $days = intval($days);

        $onlineTime = '';

        if ($days > 0) {
            $onlineTime .= $days.'d ';
        }

        if ($hours > 0) {
            $onlineTime .= $hours.'h ';
        }

        if ($minutes > 0) {
            $onlineTime .= $minutes.'m ';
        }

        if ($seconds > 0) {
            $onlineTime .= $seconds.'s';
        }

        return $onlineTime;
    }
}
