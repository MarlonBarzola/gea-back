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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();

            $table->string('reason'); //motivo de consulta
            $table->text('personal_history'); //antecedentes patológicos personales
            $table->text('family_history'); //antecedentes patológicos familiares
            $table->text('vital_signs'); //signos vitales
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('histories');
    }
};
