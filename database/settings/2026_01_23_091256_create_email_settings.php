<?php

use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    protected array $settings = [
        'email.smtp_host' => null,
        'email.smtp_port' => null,
        'email.encryption' => null,
        'email.smtp_username' => null,
        'email.smtp_password' => null,
        'email.sender' => null,
        'email.sender_email' => null,
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
