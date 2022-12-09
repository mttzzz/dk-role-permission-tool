<?php

namespace Mttzzz\DkRolePermissionTool\Resources;

use App\Nova\Resource;
use App\Nova\User;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Pavloniym\OptionsSelector\OptionsSelector;

class Role extends Resource
{
    public static $model = \Mttzzz\DkRolePermissionTool\Models\Role::class;

    public static $title = 'name';
    public static $globallySearchable = false;

    public static $search = [
        'name',
    ];

    public static function singularLabel()
    {
        return "Роль";
    }

    public static function label()
    {
        return "Роли";
    }

    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Название', 'name'),
            Text::make('Защищенное название', 'guard_name')->readonly()->default(fn() => 'web'),
            HasMany::make('Пользователи', 'users', User::class),
            Tabs::make('Some Title', $this->tabs()),
        ];
    }

    public function tabs()
    {
        return \Mttzzz\DkRolePermissionTool\Models\NovaTypeResource::query()->get()->transform(function ($type) {
            $resolve = $this->permissions()
                ->whereRelation('resource.type', 'id', $type->id)
                ->pluck('name')->toArray();
            return OptionsSelector::make($type->name, $type->name)
                ->options(\Mttzzz\DkRolePermissionTool\Models\NovaResource::OptionSelectorData($type->name))
                ->hideWhenCreating()
                ->hideLabel()
                ->hideFromIndex()
                ->resolveUsing(fn() => $resolve) // show search bar on form and detail views
                ->setGridColumnsGap(5)  // set gap between columns
                ->setGridColumnsWidth(250) // set grid columns width in pixels
                ->setMaxRowWidthOnIndex('200px');
        })->toArray();
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
