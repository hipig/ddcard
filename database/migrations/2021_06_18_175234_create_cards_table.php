<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->comment('卡组ID');
            $table->string('zh_name')->comment('中文名称');
            $table->string('en_name')->comment('英文名称');
            $table->string('zh_spell')->nullable()->comment('中文发音');
            $table->string('en_spell')->nullable()->comment('英文发音（美式）');
            $table->string('uk_spell')->nullable()->comment('英文发音（英式）');
            $table->string('zh_audio_path')->nullable()->comment('中文名称音频路径');
            $table->string('en_audio_path')->nullable()->comment('英文名称音频路径');
            $table->string('cover')->comment('封面');
            $table->char('color', 50)->comment('样式');
            $table->boolean('status')->default(true)->comment('状态');
            $table->unsignedInteger('index')->default(99)->comment('排序');
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
        Schema::dropIfExists('cards');
    }
}
