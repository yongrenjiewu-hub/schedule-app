<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('t_medicine', function (Blueprint $table) {
        $table->id('t_medicine_id');

        // pt_schedule_id の外部キー。まずカラムを作る
        $table->unsignedBigInteger('pt_schedule_id')->nullable();
        // 外部キー制約
        $table->foreign('pt_schedule_id')
              ->references('pt_schedule_id')->on('t_pt_schedule')
              ->onDelete('cascade');

        // medicine_id の外部キー。foreignId()でカラム作成と外部キー作成を一括で
        // ただし m_medicineの主キー名がidでないため第二引数にmdicine_idを指定
        $table->foreignId('medicine_id')->nullable()->constrained('m_medicine', 'medicine_id')->onDelete('cascade');
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
        Schema::dropIfExists('t_medicine');
    }
}
