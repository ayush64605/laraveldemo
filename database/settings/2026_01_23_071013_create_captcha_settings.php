<?php

use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    protected array $settings = [
        'captcha.status' => 'off',
        'captcha.site_key' => null,
        'captcha.site_secret' => null,
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
