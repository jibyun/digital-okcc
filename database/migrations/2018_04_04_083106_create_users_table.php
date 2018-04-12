<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();

            $table->unsignedInteger('member_id')->nullable()->comment('Foreign Key: ID of Members Table');
            $table->unsignedInteger('privilege_id')->nullable()->comment('Foreign Key: ID of Privileges Table');
            // TODO: 명확하게 라라벨 auth와 문제가 없을 경우 사용할 예정임
            // $table->boolean('reset')->default(false)->comment('Password Reset을 위한 스위치, TODO: 테스트 후 사용할 예정임');
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
        Schema::dropIfExists('users');
    }
}
