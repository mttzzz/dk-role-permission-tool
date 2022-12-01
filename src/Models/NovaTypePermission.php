<?php

namespace Mttzzz\DkRolePermissionTool\Models;

use Illuminate\Database\Eloquent\Model;

class NovaTypePermission extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(NovaTypeResource::class);
    }
}
