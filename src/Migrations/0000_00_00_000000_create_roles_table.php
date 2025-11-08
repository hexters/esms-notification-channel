<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Hexters\Rolevel\Helpers\Permission;

use App\Role;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('slug')->unique();
            $table->longText('permissions')->nullable();
            $table->string('state')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        $permission = new Permission;
        $role = app(config('rolevel.models.roles'));
        $role->create([
            'name' => 'Superadmin',
            'slug' => 'superadmin',
            'description' => '',
            'permissions' => $permission->keys()
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
