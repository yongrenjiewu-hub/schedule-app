<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMDialysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_dialysis', function (Blueprint $table) {
            $table->id('dialysis_id');
            $table->string('part')->nullable();
            $table->string('dialysis_day');
            $table->time('dialysis_date')->nullable();
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
        Schema::dropIfExists('m_dialysis');
        Schema::enableForeignKeyConstraints();  // 外部キー制約を再度有効化
    }
}
