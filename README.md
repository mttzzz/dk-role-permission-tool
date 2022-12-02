# DK ROLE PERMISSION TOOL

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mttzzz/dk-role-permission-tool.svg?style=flat-square)](https://packagist.org/packages/mttzzz/dk-role-permission-tool)

## Requirements

- `php: >=8.0`
- `laravel/nova: ^4.1`

## Installation

Install the package in a Laravel Nova project via Composer:

```bash
composer require mttzzz/dk-role-permission-tool
```

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

```bash
php artisan vendor:publish --provider="Mttzzz\DkRolePermissionTool\ToolServiceProvider"
```

```bash
php artisan migrate
```

```bash
php artisan dk-role-permission:seed
```

## Usage

> add meunu in NovaServiceProvider

```php
use Mttzzz\DkRolePermissionTool\DkRolePermissionTool;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();

        Nova::mainMenu(function (Request $request) {
            return [
            .....
            (new DkRolePermissionTool)->menu($request),
            .....
             ];
        });
```

## License

This project is open-sourced software licensed under the [MIT license](LICENSE.md).
