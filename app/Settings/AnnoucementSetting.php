<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AnnoucementSetting extends Settings
{
    public ?string $status;
    public ?string $link;
    public ?string $link_text;
    public ?string $msg;
    public ?string $bg_color;
    public ?string $msg_color;
    public ?string $txt_color;
    public static function group(): string
    {
        return 'annoucement';
    }
}