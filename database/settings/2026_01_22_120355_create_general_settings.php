<?php

use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {

    protected array $settings = [
        'general.site_name' => 'Project Management',
        'general.site_logo' => '',
        'general.favicon' => '',
        'general.meta_title' => 'Default Title',
        'general.meta_description' => '',
        'general.meta_keywords' => '',
        'general.time_zone' => 'UTC',
        'general.date_format' => 'Y-m-d',
        'general.time_format' => '24 hours',
        'general.language' => 'English'
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
