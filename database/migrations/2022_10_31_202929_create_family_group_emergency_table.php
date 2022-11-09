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
        Schema::create('family_group_emergency', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('cell_phone')->nullable();
            $table->foreignId('kinship_id')->nullable()->constrained()->references('id')->on('kinship')->comment('Parentesco');
            $table->foreignId('employee_id')->nullable()->constrained()->references('id')->on('employee')->comment('Empleado');
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
        Schema::dropIfExists('family_group_emergency');
    }
};
