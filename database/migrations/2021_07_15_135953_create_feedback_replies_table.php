<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('to_user_id')->comment('关联用户ID');
            $table->unsignedBigInteger('feedback_id')->comment('反馈ID');
            $table->text('content')->comment('主要内容');
            $table->timestamp('viewed_at')->nullable()->comment('查看时间');
            $table->boolean('is_remind')->default(false)->comment('是否提醒');
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
        Schema::dropIfExists('feedback_replies');
    }
}
