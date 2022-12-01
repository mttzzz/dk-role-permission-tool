<?php

namespace Mttzzz\DkRolePermissionTool\Observers;

use Mttzzz\DkRolePermissionTool\Models\NovaTypeResource;
use Mttzzz\DkRolePermissionTool\Models\Permission;
use Mttzzz\DkRolePermissionTool\Models\Role;

class RoleObserver
{
    public function updating(Role $role)
    {
        $permissions = NovaTypeResource::query()->whereIn('name', array_keys($role->toArray()))
            ->get()->transform(function ($type) use ($role) {
                $permissions = Permission::query()->whereIn('name', $role->{$type->name})->get()->pluck('id')->toArray();
                unset($role->{$type->name});
                return $permissions;
            })->collapse()->toArray();
        $role->permissions()->sync($permissions);

    }
}
