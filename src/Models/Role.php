<?php

namespace Mttzzz\DkRolePermissionTool\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\PermissionRegistrar;

class Role extends \Spatie\Permission\Models\Role
{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            config('permission.table_names.role_has_permissions'),
            PermissionRegistrar::$pivotRole,
            PermissionRegistrar::$pivotPermission
        );
    }
}
