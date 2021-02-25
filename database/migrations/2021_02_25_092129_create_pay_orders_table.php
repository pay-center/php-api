<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_sn', 32)->unique()->comment('对外订单号');
            $table->bigIncrements('server_id')->comment('下单服务id');
            $table->bigIncrements('pay_id')->comment('支付平台应用pay_id');
            $table->bigIncrements('user_id')->comment('下单用户标识');
            $table->unsignedInteger('currency_id')->default(1)->comment('货币类型');
            $table->unsignedDecimal('currency_num', 10)->comment('支付数量');
            $table->unsignedInteger('version')->default(1)->comment('每次更新+1');
            $table->unsignedTinyInteger('is_pay')->default(0)->comment('只要支付成功=1,不支持退款的服务,可以直接使用这个字段');
            $table->enum('pay_status', [
                'SUCCESS',
                'REFUND',
                'NOTPAY',
                'CLOSED',
                'REVOKED',
                'USERPAYING',
                'PAYERROR',
                'ACCEPT'
            ])->comment('按微信交易状态枚举');

            $table->string('notify_url')->comment('本订单回调地址');
            $table->string('notify_ext')->comment('服务自定义业务参数,支付成功回调时带上');
            $table->unsignedTinyInteger('notify_status')->default(0)->comment('回调是否成功');
            $table->unsignedInteger('notify_num')->default(0)->comment('回调次数');
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
        Schema::dropIfExists('pay_orders');
    }
}
