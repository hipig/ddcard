<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_groups', function (Blueprint $table) {
            $table->id();
            $table->string('zh_name')->comment('中文名称');
            $table->string('en_name')->comment('英文名称');
            $table->string('cover')->nullable()->comment('封面');
            $table->char('color', 50)->comment('样式');
            $table->unsignedTinyInteger('is_lock')->default(\App\Models\CardGroup::LOCK_STATUS_UNLOCK)->comment('是否锁定');
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
        Schema::dropIfExists('card_groups');
    }
}
