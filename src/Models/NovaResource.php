<?php

namespace Mttzzz\DkRolePermissionTool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class NovaResource extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(NovaTypeResource::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'resource_id');
    }

    public static function OptionSelectorData($type = 'Resources'): array
    {
        return NovaResource::query()->whereRelation('type', 'name', $type)->with('permissions')->get()->transform(function (NovaResource $r) {
            return [
                'title' => '1',
                'group' => ['title' => Str::afterLast($r->name, '\\')],
                'entries' => $r->permissions->transform(fn($p) => ['key' => $p->name, 'title' => Str::before($p->name, ' ')])->toArray()
            ];
        })->toArray();
    }
}
