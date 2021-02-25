<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_apps', function (Blueprint $table) {
            $table->id('pay_id');
            $table->unsignedTinyInteger('type')->comment('平台类型');
            $table->string('name')->comment('服务名称');
            $table->text('config')->comment('json 配置');
            $table->integer('version')->comment('配置版本,每次更新+1');
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
        Schema::dropIfExists('pay_apps');
    }
}
