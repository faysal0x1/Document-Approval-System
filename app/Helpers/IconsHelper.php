<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class IconsHelper
{
    public static function getBootstrapIcons()
    {
        $iconsJsonUrl = 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.json';
        $response = Http::get($iconsJsonUrl);

        if ($response->successful()) {
            $iconsData = $response->json();
            $icons = array_keys($iconsData);

            return $icons;
        }

        return [
            'bi-alarm',
            'bi-apple',
            'bi-archive',
            'bi-award',
            'bi-bell',
        ];
    }
}
