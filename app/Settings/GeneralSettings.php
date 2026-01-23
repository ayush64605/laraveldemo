<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $site_name;
    public ?string $site_logo;
    public ?string $favicon;
    public ?string $meta_title;
    public ?string $meta_description;
    public ?string $meta_keywords;
    public ?string $language;
    public ?string $time_zone;
    public ?string $date_format;
    public ?string $time_format;
    public static function group(): string
    {
        return 'general';
    }
}