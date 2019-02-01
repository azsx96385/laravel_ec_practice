<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
         
            //columns-schema 設定
            $table->increments('id'); //increments 自動給號
            $table->string('email',150);  // datatype-string("欄位名",字數)
            $table->string('password',60);
            $table->string('type',1)->default('G'); // 修飾字 ->default('')
            $table->string('nickname',50);
            $table->timestamps(); // timestamps() 快速建立 created_at updated_at 兩個欄位
            $table->rememberToken();


            //唯一鍵值索引
            // $table->primary(['id'],'user_id_pk');  - increments() 也有PK 效果 所以不需要特別建立
            $table->unique(['email'],'user_email_uk');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
