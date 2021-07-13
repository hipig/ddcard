<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscription_records', function (Blueprint $table) {
            $table->id();
            $table->string('no')->unique()->comment('订单流水号');
            $table->unsignedBigInteger('user_id')->comment('用户ID');
            $table->unsignedBigInteger('plan_id')->comment('方案ID');
            $table->decimal('amount')->comment('金额');
            $table->smallInteger('period')->default(0)->comment('时长');
            $table->string('interval')->default('day')->comment('周期');
            $table->dateTime('paid_at')->nullable()->comment('支付时间');
            $table->string('payment_no')->nullable()->comment('支付平台订单号');
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
        Schema::dropIfExists('user_subscription_records');
    }
}
