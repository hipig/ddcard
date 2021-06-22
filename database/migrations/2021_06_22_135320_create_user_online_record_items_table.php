<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOnlineRecordItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_online_record_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id')->comment('在线记录ID');
            $table->timestamp('started_at')->nullable()->comment('开始时间');
            $table->timestamp('ended_at')->nullable()->comment('结束时间');
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
        Schema::dropIfExists('user_online_record_items');
    }
}
