<?php

use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    protected array $settings = [
        'annoucement.status' => null,
        'annoucement.link' => null,
        'annoucement.link_text' => null,
        'annoucement.msg' => null,
        'annoucement.bg_color' => null,
        'annoucement.msg_color' => null,
        'annoucement.txt_color' => null,
    ];

    public function up(): void
    {
        if (!Schema::hasTable('settings')) {
            return;
        }

        foreach ($this->settings as $key => $value) {
            if (!$this->migrator->exists($key)) {
                $this->migrator->add($key, $value);
            }
        }
    }
    public function down(): void
    {
        foreach (array_keys($this->settings) as $key) {
            if ($this->migrator->exists($key)) {
                $this->migrator->delete($key);
            }
        }
    }
};
