<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->longText('description');
            $table->string('image_url', 255)->nullable();
            $table->unsignedSmallInteger('program_id')->index();
            $table->unsignedBigInteger('created_by')->index();
            $table->tinyInteger('is_active')->default(1);

            $table->timestamps();

            $table->foreign('program_id')
                ->references('id')->on('programs')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
