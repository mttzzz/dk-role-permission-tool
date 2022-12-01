<?php

namespace Mttzzz\DkRolePermissionTool\Commands;

use App\Models\Account;
use Illuminate\Console\Command;
use mttzzz\AmoClient\AmoClientOctane;
use Mttzzz\DkRolePermissionTool\Models\NovaTypePermission;
use Mttzzz\DkRolePermissionTool\Models\NovaTypeResource;

class DKRolePermissionToolSeedCommand extends Command
{
    protected $signature = 'dk-role-permission:seed';
    protected AmoClientOctane $amo;
    protected $description = 'Command description';
    protected Account $account;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $permissions = ['view', 'viewAny', 'create', 'update', 'delete', 'run'];
        foreach ($permissions as $permission) {
            NovaTypePermission::query()->firstOrCreate(['name' => $permission]);
        }


        $type = NovaTypeResource::query()->firstOrCreate(['name' => 'Resources']);
        $permissions = NovaTypePermission::query()
            ->whereIn('name', ['view', 'viewAny', 'create', 'update', 'delete'])
            ->get()->pluck('id')->toArray();
        $type->permissions()->sync($permissions);

        $types = ['Dashboards', 'Filters', 'Lenses', 'Metrics'];
        foreach ($types as $t) {
            $type = NovaTypeResource::query()->firstOrCreate(['name' => $t]);
            $permissions = NovaTypePermission::query()
                ->whereIn('name', ['view'])
                ->get()->pluck('id')->toArray();
            $type->permissions()->sync($permissions);
        }

        $type = NovaTypeResource::query()->firstOrCreate(['name' => 'Actions']);
        $permissions = NovaTypePermission::query()
            ->whereIn('name', ['view', 'run'])
            ->get()->pluck('id')->toArray();
        $type->permissions()->sync($permissions);
    }
}
