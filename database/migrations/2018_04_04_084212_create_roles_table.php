<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->string('txt', 50)->default('')->comment('Role 영어 명칭');
            $table->text('memo')->nullable()->comment('메모 사항');
            
            $table->timestamps();

            // TODO: Role을 일반 관리자가 입력, 수정, 삭제하게 할 경우 사용할 예정임
            // $table->unsignedInteger('updated_by')->comment('Foreign Key: 입력 또는 변경한 Users Table의 아이디');
            // $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('roles');
    }
}
