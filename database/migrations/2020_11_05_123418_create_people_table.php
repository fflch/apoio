<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('nusp')->nullable();
            $table->string('nome');
            $table->string('unidade');
            $table->string('endereco')->nullable();
            $table->string('complemento');
            $table->string('cidade');
            $table->string('estado');
            $table->string('cep');
            $table->string('instituicao');
            $table->string('identidade');
            $table->string('pispasep');
            $table->string('cpf');
            $table->string('passaport');
            $table->text('observacao');
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
        Schema::dropIfExists('people');
    }
}
