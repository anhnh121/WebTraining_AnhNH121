<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Initdb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ACCOUNTS', function (Blueprint $table) {
            $table->increments('acc_id');   //"UNSIGNED INTEGER"
            $table->string('acc_username',250)->unique();
            $table->string('acc_password',250);
            $table->string('acc_fullname',250);
            $table->string('acc_email',250)->nullable();
            $table->string('acc_phone',250)->nullable();
            $table->integer('acc_role');
        });
       
        Schema::create('MSG', function (Blueprint $table) {
            $table->increments('msg_id');   //"UNSIGNED INTEGER"
            $table->string('msg_msg',250)->nullable();
            $table->integer('msg_idsender')->unsigned();
            $table->integer('msg_idrecver')->unsigned();
            $table->string('msg_time',250)->nullable();
            
            $table->foreign('msg_idsender')->references('acc_id')->on('ACCOUNTS');
            $table->foreign('msg_idrecver')->references('acc_id')->on('ACCOUNTS');
            
        });
        
        Schema::create('HOMEWORKS', function (Blueprint $table) {
            $table->increments('hw_id');   //"UNSIGNED INTEGER"
            $table->string('hw_title',250)->unique();
            $table->string('hw_path',250)->unique();
            $table->string('hw_uptime',250)->nullable();
            $table->integer('hw_teacherid')->unsigned();
            
            $table->foreign('hw_teacherid')->references('acc_id')->on('ACCOUNTS');
        });    
        
        Schema::create('RESULTS', function (Blueprint $table) {
            $table->increments('kq_id');   //"UNSIGNED INTEGER"
            $table->string('kq_path',250)->unique();
            $table->string('kq_uptime',250)->nullable();
            $table->integer('kq_studentid')->unsigned();
            $table->integer('kq_homeworkid')->unsigned();
            
            $table->foreign('kq_studentid')->references('acc_id')->on('ACCOUNTS');
            $table->foreign('kq_homeworkid')->references('hw_id')->on('HOMEWORKS');
        }); 
        
        Schema::create('GAME', function (Blueprint $table) {
            $table->increments('game_id');   //"UNSIGNED INTEGER"
            $table->string('game_hint',250)->unique();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('GAME');
        Schema::drop('RESULTS');
        Schema::drop('HOMEWORKS');
        Schema::drop('MSG');
        Schema::drop('ACCOUNTS');
    }
}
