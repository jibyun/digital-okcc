<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_histories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->unsignedInteger('member_id')->comment('Foreign Key: ID of Members Table');
            $table->date('started_at')->nullable()->comment('Start Date');
            $table->date('finished_at')->nullable()->comment('End Date');
            $table->string('title')->default('')->comment('제목');
            $table->text('memo')->nullable()->comment('메모 사항');
            $table->unsignedInteger('updated_by')->comment('Foreign Key: ID of Users Table');

            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('member_histories');
    }
}
