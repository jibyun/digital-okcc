<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id')->comment('카테고리 테이블의 메인 키 (자동 증가)');  
            $table->string('txt', 50)->default('')->comment('카테고리의 영어 명칭');
            $table->string('kor_txt', 50)->default('')->comment('카테고리의 한글 명칭');  
            $table->boolean('enabled')->default(true)->comment('카테고리가 활성화 되었는지를 식별함'); 
            $table->text('memo')->nullable()->comment('메모 사항');
            $table->unsignedInteger('order')->comment('콤보박스에서 보여지는 순서');
            $table->string('fieldName', 50)->default('')->comment('다른 테이블에서 해당 category를 참조하는 필드이름'); 
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
        Schema::dropIfExists('code_categories');
    }
}
