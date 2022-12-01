<?php

namespace Mttzzz\DkRolePermissionTool\Observers;


use Mttzzz\DkRolePermissionTool\Models\NovaResource;
use Spatie\Permission\Models\Permission;

class NovaResourceObserver
{
    public function created(NovaResource $resource)
    {
        $resource->type->permissions->each(fn($p) => Permission::query()
            ->firstOrCreate([
                'name' => $p->name . ' ' . $resource->name,
                'resource_id' => $resource->id
            ]));
    }
}
