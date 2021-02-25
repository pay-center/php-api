<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_config', function (Blueprint $table) {
            $table->id();
            $table->bigIncrements('server_id')->comment('服务id');
            $table->bigIncrements('pay_id')->comment('支付配置id');
            $table->unsignedTinyInteger('pay_type')->comment('支付平台类型');
            $table->string('fallback_url')->comment('如果下单没有自定义回调参数,默认按这个推送');
            $table->unique(['server_id', 'pay_id']);
            $table->unique(['server_id', 'pay_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_config');
    }
}
