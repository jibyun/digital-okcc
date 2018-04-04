<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivilegeRoleMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privilege_role_maps', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->unsignedInteger('privilege_id')->comment('Foreign Key: ID of Privileges Table');
            $table->unsignedInteger('role_id')->comment('Foreign Key: ID of Roles Table');

            $table->timestamp('created_at');

            $table->foreign('privilege_id')->references('id')->on('privileges');
            $table->foreign('role_id')->references('id')->on('roles');
            
            // TODO: 일반 관리자가 입력, 수정, 삭제하게 할 경우 사용할 예정임
            // $table->unsignedInteger('created_by')->comment('Foreign Key: 입력 또는 변경한 Users Table의 아이디');
            // $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('privilege_role_maps');
    }
}
