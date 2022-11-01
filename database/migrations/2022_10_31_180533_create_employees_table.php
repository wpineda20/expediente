<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->foreignId('family_status_id')->references('id')->on('family_status')->comment('Estado Familiar');
            $table->foreignId('profession_id')->references('id')->on('profession')->comment('Profesiones');
            $table->string('current_address', 500);
            $table->integer('municipality_id');
            $table->tinyInteger('vulnerable_area');
            $table->string('personal_email');
            $table->string('phone');
            $table->string('cell_phone');
            $table->string('dui_file', 500);
            $table->softDeletes();
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
        Schema::dropIfExists('employee');
    }
};
