<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAssignedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_assigned', function (Blueprint $table) {
            $table->id('assigned_id');
            $table->unsignedBigInteger('pt_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('pt_id')->references('pt_id')->on('m_patient');
            $table->foreign('user_id')->references('user_id')->on('m_user');
            $table->date('assigned_date')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Schema::create('t_assigned', function (Blueprint $table) {
            //     $table->id();
            //     $table->unsignedBigInteger('user_id');
            //     $table->unsignedBigInteger('pt_id');
            //     $table->timestamps();
        
            //     $table->unique(['user_id', 'pt_id']); // 同じ組み合わせを2回登録しないようにする
        
            //     $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            //     $table->foreign('pt_id')->references('pt_id')->on('m_patient')->onDelete('cascade');
            // });

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('t_assigned');
        Schema::table('t_assigned', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
