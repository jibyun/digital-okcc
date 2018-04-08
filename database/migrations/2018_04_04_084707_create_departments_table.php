<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->string('txt', 50)->default('')->comment('부서의 영어 명칭');
            $table->string('kor_txt', 50)->default('')->comment('코드의 한글 명칭');
            $table->text('memo')->nullable()->comment('메모 사항');
            $table->unsignedInteger('code_id')->comment('Foreign Key: ID of Codes Table');
            $table->unsignedInteger('updated_by')->comment('Foreign Key: ID of Users Table');

            $table->timestamps();

            $table->foreign('code_id')->references('id')->on('codes');
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
        Schema::dropIfExists('departments');
    }
}
