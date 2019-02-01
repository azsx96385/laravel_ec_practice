<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchandiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandise', function (Blueprint $table) {
            $table->increments('id'); //商品編號-increments-具備pk
            $table->string('status',1)->default('C'); //標記商品-以上價商品才可被看到- C 建立中  S 可銷售
            $table->string('name',80)->nullable();
            $table->string('name_en',80)->nullable();
            $table->text('introduction');
            $table->text('introduction_en');
            $table->string('photo',50)->nullable();
            $table->integer('price')->default(0);
            $table->integer('remain_count')->default(0);
            $table->timestamps();


            //索引設定
            $table->index(['status'],'merchandise_status_idx');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandise');
    }
}
