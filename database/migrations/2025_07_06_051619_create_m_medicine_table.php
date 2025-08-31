<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_medicine', function (Blueprint $table) {
            $table->id('medicine_id');
            $table->string('kinds');
            $table->string('drug_name');
            $table->string('usage');
            $table->string('dose');
            $table->time('medicine_time')->nullable();
            $table->string('medicine_time_label')->nullable();
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
        Schema::dropIfExists('m_medicine');
    }
}
