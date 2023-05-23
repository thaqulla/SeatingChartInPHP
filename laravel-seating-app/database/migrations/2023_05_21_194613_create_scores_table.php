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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('studentId')->constrained()->cascadeOnDelete();
            // $table->string('testName');
            $table->integer('fourScore');
            $table->float('fourDeviation');
            $table->integer('mathScore');
            $table->float('mathDeviation');
            $table->integer('japaneseScore');
            $table->float('japaneseDeviation');
            $table->integer('scienceScore');
            $table->float('scienceDeviation');
            $table->integer('societyScore');
            $table->float('societyDeviation');
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
        Schema::dropIfExists('scores');
    }
};
