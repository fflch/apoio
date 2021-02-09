<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurrogatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surrogates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->constrained();
            $table->foreignId('holder_id')->constrained();
            $table->foreignId('departament_id')->constrained();
            $table->string('pertence');
            $table->date('inicio');
            $table->date('termino');
            $table->string('observacao')->nullable();
            $table->char('status', 1)->default('A');
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
        Schema::dropIfExists('surrogates');
    }
}
