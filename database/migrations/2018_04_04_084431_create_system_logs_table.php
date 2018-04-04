<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->unsignedInteger('code_id')->comment('Foreign Key: ID of Codes Table identifying what kind of log');
            $table->unsignedInteger('user_id')->comment('Foreign Key: ID of Users Table identifying who made the log');
            $table->text('memo')->nullable()->comment('메모 사항');

            $table->timestamp('created_at');

            $table->foreign('code_id')->references('id')->on('codes');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('system_logs');
    }
}
