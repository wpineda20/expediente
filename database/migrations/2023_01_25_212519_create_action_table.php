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
        Schema::create('action', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained()->references('id')->on('employee');
            // $table->string('employee_name')->nullable();
            $table->foreignId('employee_status_id')->nullable()->constrained()->references('id')->on('employee_status')->comment('1=Registrado 2=Digitado 3=Finalizado');
            $table->integer('id_section')->nullable();
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
        Schema::dropIfExists('action');
    }
};
