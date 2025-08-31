<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_patient', function (Blueprint $table) {
            $table->id('pt_id');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('room_id')->on('m_room');
            $table->string('pt_name');
            $table->string('sex');
            $table->string('blood_type');
            $table->date('birthday');
            $table->unsignedBigInteger('disease_id');
            $table->foreign('disease_id')->references('disease_id')->on('m_disease');
            $table->string('tell_number')->nullable();
            $table->string('key_person')->nullable();
            $table->string('Dr_name');
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
        Schema::dropIfExists('m_patient');
    }
}
