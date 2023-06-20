<?php

namespace PalaganTeam\MuhKansai\App;
class DotEnv{
    /**
     * Get default timezone
     */
    public static function getTimezoneArea(?string $targetTimezone = 'Asia/Tokyo'){
        date_default_timezone_set($targetTimezone);

        return date_default_timezone_get();
    }
}