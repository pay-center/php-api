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
            $table->unsignedTinyInteger('order_type')->default(0)->comment('订单类型：0普遍订单，2补单');
            $table->unsignedInteger('channel_id')->default(0)->comment('渠道来源: 1iOS，2安卓小米市场，2安卓华为市场');

            $table->enum('trade_type', [
                'APP',
                'JSAPI',
                'NATIVE',
                'MWEB',
            ])->comment('交易类型');
            $table->unsignedInteger('currency_id')->default(1)->comment('货币类型');
            $table->unsignedDecimal('currency_amount', 10)->comment('支付数量');
            $table->unsignedInteger('version')->default(1)->comment('每次更新+1');
            $table->enum('pay_status', [
                'NOTPAY',  // 未支付
                'SUCCESS', // 支付成功
                'REFUND',  // 退款
                'CLOSED',  // 未支付就关闭
            ])->default('NOTPAY')->comment('交易状态枚举');
            $table->string('pay_type')->comment('pay_apps@pay_type');
            $table->string('trade_no',64)->comment('第三方的交易号，第三方颁发');

            $table->string('notify_url')->comment('本订单回调地址');
            $table->string('notify_attach')->comment('服务自定义业务参数,支付成功回调时带上');
            $table->unsignedTinyInteger('notify_status')->default(0)->comment('回调是否成功 0、1成功、2失败');
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
