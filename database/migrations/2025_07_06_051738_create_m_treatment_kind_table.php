<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMTreatmentKindTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_treatment_kind', function (Blueprint $table) {
            $table->id('treatment_kind_id');
            $table->string('category');
            $table->string('key');
            $table->string('value');
            $table->time('Ftreatment_date')->nullable();
            $table->time('Streatment_date')->nullable();
            $table->time('Ttreatment_date')->nullable();
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
        Schema::dropIfExists('m_treatment_kind');
    }
}
