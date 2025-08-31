<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMedicalRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_medical_record', function (Blueprint $table) {
            $table->id('record_id');
            $table->unsignedBigInteger('pt_id');
            $table->foreign('pt_id')->references('pt_id')->on('m_patient');
            $table->text('pt_record')->nullable();
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
        Schema::dropIfExists('t_medical_record');
    }
}
