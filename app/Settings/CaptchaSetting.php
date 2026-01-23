<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CaptchaSetting extends Settings
{
    public ?string $status;
    public ?string $site_key;
    public ?string $site_secret;

    public static function group(): string
    {
        return 'captcha';
    }
}