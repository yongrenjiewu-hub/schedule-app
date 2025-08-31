<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMCareKindTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_care_kind', function (Blueprint $table) {
            $table->id('care_kind_id');
            $table->string('category');
            $table->string('key');
            $table->string('value');
            $table->time('Fcare_date')->nullable();
            $table->time('Scare_date')->nullable();
            $table->time('Tcare_date')->nullable();
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
        Schema::dropIfExists('m_care_kind');
    }
}
