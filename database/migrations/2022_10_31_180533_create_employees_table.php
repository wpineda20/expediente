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
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->comment('Usuarios');
            $table->string('full_name')->nullable();
            $table->foreignId('family_status_id')->nullable()->constrained()->references('id')->on('family_status')->comment('Estado Familiar');
            $table->foreignId('profession_id')->nullable()->constrained()->references('id')->on('profession')->comment('Profesiones');
            $table->string('current_address', 500)->nullable();
            $table->foreignId('municipality_id')->nullable()->constrained()->references('id')->on('municipalities')->comment('Municipio');
            $table->tinyInteger('vulnerable_area')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('cell_phone')->nullable();
            $table->foreignId('direction_id')->nullable()->constrained()->references('id')->on('direction')->comment('Dirección');
            $table->foreignId('unit_id')->nullable()->constrained()->references('id')->on('dependence')->comment('Dependencia');
            $table->string('nominal_fee')->nullable();
            $table->string('functional_position')->nullable();
            $table->string('immediate_superior')->nullable();
            $table->string('email_institutional')->nullable();
            $table->integer('municipality_assigned_id')->nullable();
            $table->string('dui_file', 500)->nullable();
            $table->string('title_file', 500)->nullable();
            $table->foreignId('employee_status_id')->nullable()->constrained()->references('id')->on('employee_status')->comment('1=Registrado 2=Digitado 3=Finalizado');
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
