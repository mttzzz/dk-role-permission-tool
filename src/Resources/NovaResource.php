<?php

namespace Mttzzz\DkRolePermissionTool\Resources;

use App\Nova\Actions\GenerateNovaResourcesAction;
use App\Nova\Resource;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaResource extends Resource
{
    public static $model = \Mttzzz\DkRolePermissionTool\Models\NovaResource::class;

    public static $title = 'name';
    public static $globallySearchable = false;
    public static $search = [
        'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Название', 'name')->sortable(),
            BelongsTo::make('Тип', 'type',NovaTypeResource::class)->sortable(),
            HasMany::make('Права', 'permissions', Permission::class)->sortable(),
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
        return [(new GenerateNovaResourcesAction)];
    }
}
