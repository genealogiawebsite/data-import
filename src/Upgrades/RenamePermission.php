<?php

namespace LaravelEnso\DataImport\Upgrades;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Roles\Models\Role;
use LaravelEnso\Upgrade\Contracts\MigratesData;

class RenamePermission implements MigratesData
{
    public function isMigrated(): bool
    {
        return ! $this->query()->exists();
    }

    public function migrateData(): void
    {
        $this->query()->update([
            'name' => 'import.template',
        ]);

        if (App::isLocal()) {
            Role::get()
                ->reject(fn ($role) => $role->name === Config::get('enso.config.defaultRole'))
                ->each->writeConfig();
        }
    }

    private function query()
    {
        return Permission::whereName('import.downloadTemplate');
    }
}
