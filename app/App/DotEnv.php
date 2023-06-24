<?php

namespace PalaganTeam\MuhKansai\App;
class DotEnv{
    /**
     * Get default timezone
     * 
     * Default timezone ialah tokyo time 
     */
    public static function getTimezoneArea(?string $targetTimezone = 'Asia/Tokyo'){
        date_default_timezone_set($targetTimezone);

        return date_default_timezone_get();
    }

    /**
     * News Path Thumbnail
     * 
     * Mengambil path folder untuk news, diperlukan __DIR__ diawal pemanggilan fungsi ini
     * @return '/../../public/images/news/'
     */
    public static function getNewsPath(){
        // news path
        $path = '/../../public/image/news/';

        return $path;
    }
}