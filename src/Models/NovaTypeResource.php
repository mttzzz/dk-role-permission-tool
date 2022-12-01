<?php

namespace Mttzzz\DkRolePermissionTool\Models;

use Illuminate\Database\Eloquent\Model;

class NovaTypeResource extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(NovaTypePermission::class, 'nova_type_permission', 'type_id', 'permission_id');
    }
}
