<?php

namespace Mttzzz\DkRolePermissionTool\Actions;

use Brightspot\Nova\Tools\DetachedActions\DetachedAction;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ActionFields;
use Mttzzz\DkRolePermissionTool\Models\NovaResource;
use Mttzzz\DkRolePermissionTool\Models\NovaTypeResource;

class GenerateNovaResourcesAction extends DetachedAction
{
    use InteractsWithQueue, Queueable;

    public $name = 'Генерация ресурсов';
    public $label = 'Генерация ресурсов';

    public function handle(ActionFields $fields, Collection $models)
    {
        try {
            $this->resources();
            $this->resources('\Nova\Actions', 'Actions');
            $this->resources('\Nova\Dashboards', 'Dashboards');
            $this->resources('\Nova\Filters', 'Filters');
            $this->resources('\Nova\Metrics', 'Metrics');
        } catch (\Exception $e) {
            report($e);
        }

        return DetachedAction::redirect('nova-resources');
    }

    public function resources($path = '\Nova', $type = 'Resources')
    {
        $pathResource = env('APP_ENV') !== 'production' ?: Str::replace('\\', '/', $path);
        $resources = scandir(app_path() . $pathResource);
        foreach ($resources as $key => $r) {
            if (!Str::contains($r, '.php')) {
                unset($resources[$key]);
            } else {
                $resources[$key] = "App$path\\" . Str::before($r, '.php');
            }
        }

        $t = NovaTypeResource::query()->where('name', $type)->first();
        foreach ($resources as $res) {
            NovaResource::query()->firstOrCreate(['name' => $res, 'type_id' => $t->id]);
        }
    }
}
