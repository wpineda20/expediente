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
            $table->foreignId('subdirection_id')->nullable()->constrained()->references('id')->on('subdirection')->comment('Subdirección');
            $table->foreignId('unit_id')->nullable()->constrained()->references('id')->on('unit')->comment('Unidad');
            $table->string('nominal_fee')->nullable();
            $table->string('functional_position')->nullable();
            $table->string('immediate_superior')->nullable();
            $table->string('email_institutional')->nullable();
            $table->integer('municipality_assigned_id')->nullable();
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