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
        Schema::create('work_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->references('id')->on('employee')->comment('Empleado');
            $table->foreignId('direction_id')->references('id')->on('direction')->comment('Dirección');
            $table->foreignId('subdirection_id')->references('id')->on('subdirection')->comment('Subdirección');
            $table->foreignId('unit_id')->references('id')->on('unit')->comment('Unidad');
            $table->string('nominal_fee');
            $table->string('functional_position');
            $table->string('immediate_superior');
            $table->string('email_institutional');
            $table->string('phone');
            $table->string('cell_phone');
            $table->foreignId('municipality_id')->references('id')->on('municipalities')->comment('Municipio');
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
        Schema::dropIfExists('work_data');
    }
};
