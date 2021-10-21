<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contest_id')->constrained();
            $table->foreignId('people_id')->constrained();
            $table->string('processo')->nullable();
            $table->double('nota',18,2)->nullable();
            $table->string('conceito')->nullable();
            $table->integer('sim')->nullable()->default(0);
            $table->integer('nao')->nullable()->default(0);
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
        Schema::dropIfExists('subscriptions');
    }
}
