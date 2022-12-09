<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->string('model_type')->default('App\Models\User')->change();
        });
        
        if (Schema::hasTable('permissions')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->foreignId('resource_id')->nullable()->after('guard_name')->constrained('nova_resources')->cascadeOnDelete();
            });
        } else {
            echo "table permissions not exists\n";
            echo "run command\n";
            echo 'php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"' . "\n";
            return;
        }

        Schema::dropDatabaseIfExists('nova_type_resources');
        Schema::create('nova_type_resources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::dropDatabaseIfExists('nova_resources');
        Schema::create('nova_resources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('type_id')->constrained('nova_type_resources')->cascadeOnDelete();
        });

        Schema::dropDatabaseIfExists('nova_type_permissions');
        Schema::create('nova_type_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::dropDatabaseIfExists('nova_type_permission');
        Schema::create('nova_type_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('nova_type_resources')->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained('nova_type_permissions')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nova_type_resources');
        Schema::dropIfExists('nova_resources');
        Schema::dropIfExists('nova_type_permissions');
        Schema::dropIfExists('nova_type_permission');

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('resource_id');
        });
    }
};
