<?php

namespace Mttzzz\DkRolePermissionTool\Resources;

use App\Nova\Resource;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaTypeResource extends Resource
{
    public static $model = \Mttzzz\DkRolePermissionTool\Models\NovaTypeResource::class;

    public static $title = 'name';
    public static $globallySearchable = false;
    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Название', 'name')->sortable(),
            BelongsToMany::make('Права', 'permissions', NovaTypePermission::class)
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
