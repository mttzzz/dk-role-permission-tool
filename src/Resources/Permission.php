<?php

namespace Mttzzz\DkRolePermissionTool\Resources;

use App\Nova\Actions\SetPermissionsRoleAction;
use App\Nova\Resource;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Permission extends Resource
{
    public static $model = \Spatie\Permission\Models\Permission::class;

    public static $title = 'name';
    public static $globallySearchable = false;
    public static $perPageViaRelationship = 50;

    public static $search = [
        'name',
    ];

    public static function singularLabel()
    {
        return "Пермишин";
    }

    public static function label()
    {
        return "Пермишины";
    }

    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Название', 'name')->sortable(),
        ];
    }

    public function cards(NovaRequest $request)
    {
        return [];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function lenses(NovaRequest $request)
    {
        return [];
    }

    public function actions(NovaRequest $request)
    {
        return [new SetPermissionsRoleAction];
    }
}
