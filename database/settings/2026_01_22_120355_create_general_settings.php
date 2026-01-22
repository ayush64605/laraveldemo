<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'My App');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.favicon', null);
        $this->migrator->add('general.meta_title', 'Default Title');
        $this->migrator->add('general.meta_description', null);
        $this->migrator->add('general.meta_keywords', null);
    }
};
