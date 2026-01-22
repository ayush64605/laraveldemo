<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ThemeSetting extends Settings
{
    public ?string $theme_color;
    public static function group(): string
    {
        return 'theme';
    }
}