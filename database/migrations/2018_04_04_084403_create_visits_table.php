<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('Foreign Key: ID of Users Table');
            $table->unsignedInteger('member_id')->comment('Foreign Key: ID of Members Table');
            $table->date('visited_at')->default(Carbon::now())->comment('Date of Visit');
            $table->string('title')->default('')->comment('심방 제목');
            $table->text('memo')->nullable()->comment('메모 사항');
            $table->unsignedInteger('updated_by')->comment('Foreign Key: ID of Users Table');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('visits');
    }
}
