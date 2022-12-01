<?php

namespace Mttzzz\DkRolePermissionTool;

use Mttzzz\DkRolePermissionTool\Resources\NovaResource;
use Mttzzz\DkRolePermissionTool\Resources\NovaTypePermission;
use Mttzzz\DkRolePermissionTool\Resources\NovaTypeResource;
use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Mttzzz\DkRolePermissionTool\Resources\Permission;
use Mttzzz\DkRolePermissionTool\Resources\Role;

class DkRolePermissionTool extends Tool
{
    public function boot()
    {
        //Nova::script('dk-role-permission-tool', __DIR__ . '/../dist/js/tool.js');
        //Nova::style('dk-role-permission-tool', __DIR__ . '/../dist/css/tool.css');

        Nova::resources([
            NovaResource::class,
            NovaTypePermission::class,
            NovaTypeResource::class,
            Role::class,
            Permission::class,
        ]);
    }

    public function menu(Request $request)
    {
        return
            //->path('/dk-role-permission-tool')

            MenuSection::make('Права', [
                MenuItem::resource(NovaResource::class),
                MenuItem::resource(NovaTypeResource::class),
                MenuItem::resource(NovaTypePermission::class),
                MenuItem::link('Роли', 'resources/roles'),
                MenuItem::link('Пермишены', 'resources/permissions'),
            ])->icon('key')->collapsable();
    }
}
