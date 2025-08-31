<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPtDialysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pt_dialysis', function (Blueprint $table) {
            $table->id('pt_dialysis_id');
            $table->integer('pt_id');
            $table->integer('t_pt_dialysis_part')->nullable();
            $table->unsignedBigInteger('dialysis_id')->nullable();
            $table->foreign('dialysis_id')->references('dialysis_id')->on('m_dialysis');
            //$table->integer('dialysis_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->date('daily_schedule_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pt_dialysis');
    }
}
