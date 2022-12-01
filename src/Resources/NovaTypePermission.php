<?php

namespace Mttzzz\DkRolePermissionTool\Resources;

use App\Nova\Resource;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaTypePermission extends Resource
{
    public static $model = \Mttzzz\DkRolePermissionTool\Models\NovaTypePermission::class;

    public static $title = 'name';
    public static $globallySearchable = false;
    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Название', 'name')->sortable()
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
        return [];
    }
}
