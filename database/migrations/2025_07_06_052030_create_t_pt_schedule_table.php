<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPtScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pt_schedule', function (Blueprint $table) {
            $table->id('pt_schedule_id');
            $table->unsignedBigInteger('pt_id');
            $table->unsignedBigInteger('meal_id')->nullable();
            $table->unsignedBigInteger('care_kind_id')->nullable();
            $table->unsignedBigInteger('treatment_kind_id')->nullable();
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->foreign('pt_id')->references('pt_id')->on('m_patient');
            $table->foreign('meal_id')->references('meal_id')->on('m_meal');
            $table->foreign('care_kind_id')->references('care_kind_id')->on('m_care_kind');
            $table->foreign('treatment_kind_id')->references('treatment_kind_id')->on('m_treatment_kind');
            $table->foreign('medicine_id')->references('medicine_id')->on('m_medicine');
            $table->date('daily_schedule_date');
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
        Schema::dropIfExists('t_pt_schedule');
    }
}
