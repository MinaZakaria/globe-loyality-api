<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration    // @codingStandardsIgnoreLine
{
    /**
     * Run the migrations.
     * @table employee_roles
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->tinyIncrements('id');
            $table->string('name', 50)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
