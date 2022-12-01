<?php

namespace Mttzzz\DkRolePermissionTool\Models;


class Permission extends \Spatie\Permission\Models\Permission
{
    public function resource()
    {
        return $this->belongsTo(NovaResource::class);
    }
}
