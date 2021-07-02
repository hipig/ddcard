<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLearnRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_learn_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('用户ID');
            $table->unsignedBigInteger('group_id')->comment('卡片分组ID');
            $table->unsignedBigInteger('card_id')->comment('卡片ID');
            $table->string('lang', 20)->default('zh')->comment('语言');
            $table->timestamps();
            $table->unique(['user_id', 'card_id', 'lang']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_learn_records');
    }
}
