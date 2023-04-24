<?php

if (!function_exists('getLevel')) {
    function getLevel($xp): int
    {
        return intval(pow($xp / 100.0, 0.6));
    }
}
