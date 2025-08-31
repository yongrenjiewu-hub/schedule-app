<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTreatmentKindTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_treatment_kind', function (Blueprint $table) {
                $table->id('t_treatment_kind_id');
                $table->integer('pt_id');
                $table->integer('treatment_kind_id');
                $table->softDeletes();
                $table->timestamps();
                $table->date('daily_schedule_date')->nullable();
                $table->unsignedBigInteger('pt_schedule_id')->nullable();
                $table->foreign('pt_schedule_id')
                    ->references('pt_schedule_id')
                    ->on('t_pt_schedule')
                    ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_treatment_kind');
    }
}
