<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_meal', function (Blueprint $table) {
            $table->id('t_meal_id');
            $table->unsignedBigInteger('pt_id'); // 患者ID
            $table->unsignedBigInteger('meal_id'); // 食事マスタ
            $table->date('daily_schedule_date'); // 日付
            $table->timestamps();

            // 外部キー
            $table->foreign('pt_id')->references('pt_id')->on('m_patient')->onDelete('cascade');
            $table->foreign('meal_id')->references('meal_id')->on('m_meal')->onDelete('cascade');

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
        //Schema::dropIfExists('t_meal');

        Schema::table('t_meal', function (Blueprint $table) {
            $table->dropForeign(['pt_schedule_id']);
            $table->dropColumn('pt_schedule_id');
        });
    }
}
