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
        Schema::create('academic_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->references('id')->on('employee')->comment('Empleado');
            $table->foreignId('academic_level_id')->references('id')->on('academic_level')->comment('Nivel Academico');
            $table->string('education_center');
            $table->integer('year');
            $table->string('obtained_title');
            $table->boolean('career_status')->nullable()->comment('0/false=Finalizada; 1/true=No Finalizada');
            $table->string('career')->nullable();
            $table->integer('subjects_approved')->nullable();
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
        Schema::dropIfExists('academic_data');
    }
};
