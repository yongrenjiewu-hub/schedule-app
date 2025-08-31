<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMDiseaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_disease', function (Blueprint $table) {
            $table->id('disease_id');
            $table->string('disease_name');
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
        Schema::disableForeignKeyConstraints(); // 外部キー制約を無効化
        Schema::dropIfExists('m_disease');
        Schema::enableForeignKeyConstraints();  // 外部キー制約を再度有効化
    }
}
