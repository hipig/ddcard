<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名称');
            $table->decimal('price')->default(0)->comment('价格');
            $table->smallInteger('period')->default(0)->comment('时长');
            $table->string('interval')->default('day')->comment('周期');
            $table->text('description')->nullable()->comment('描述');
            $table->string('tag')->nullable()->comment('标签');
            $table->boolean('status')->default(true)->comment('状态');
            $table->unsignedInteger('index')->default(0)->comment('排序');
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
        Schema::dropIfExists('plans');
    }
}
