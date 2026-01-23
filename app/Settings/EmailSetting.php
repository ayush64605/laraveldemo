<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class EmailSetting extends Settings
{

    public ?string $smtp_host;
    public ?string $smtp_port;
    public ?string $encryption;
    public ?string $smtp_username;
    public ?string $smtp_password;
    public ?string $sender;
    public ?string $sender_email;

    public static function group(): string
    {
        return 'email';
    }
}