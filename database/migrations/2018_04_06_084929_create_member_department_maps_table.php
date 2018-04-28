<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberDepartmentMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_department_maps', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->unsignedInteger('member_id')->comment('Foreign Key: ID of Members Table');
            $table->unsignedInteger('department_id')->comment('Foreign Key: ID of Codes Table');
            $table->unsignedInteger('position_id')->nullable()->comment('Foreign Key: ID of Codes Table');
            $table->boolean('enabled')->default(true)->comment('이 코드가 활성화 되었는지를 식별함'); 
            $table->unsignedInteger('updated_by')->nullable()->comment('Foreign Key: ID of Users Table');
            $table->boolean('manager')->default(false)->comment('부서장인 경우 True롤 지정함'); 

            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('department_id')->references('id')->on('codes');
            $table->foreign('position_id')->references('id')->on('codes');
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
        Schema::dropIfExists('member_department_maps');
    }
}
