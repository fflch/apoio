<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departament_id')->constrained();
            $table->string('titularidade');
            $table->string('descricao');
            $table->string('area')->nullable();
            $table->string('disciplina')->nullable();
            $table->string('edital');
            $table->date('inicio');
            $table->date('termino');
            $table->date('inicio_prova')->nullable();
            $table->date('termino_prova')->nullable();
            $table->date('data_publicacao');
            $table->string('processo');
            $table->string('livro')->nullable();
            $table->integer('qtde_fflch');
            $table->integer('qtde_externo');
            $table->char('status', 1)->default('A');
            $table->string('observacao')->nullable();
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
        Schema::dropIfExists('contests');
    }
}
