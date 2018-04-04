<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->unsignedInteger('id')->primary()->comment('복합 코드 테이블의 메인 키 (code_category_id * 10000 + sequential number)');  
            $table->unsignedInteger('code_category_id')->comment('카테고리 아이디');
            $table->string('txt', 50)->default('')->comment('코드의 영어 명칭');
            $table->string('kor_txt', 50)->default('')->comment('코드의 한글 명칭');  
            $table->boolean('enabled')->default(true)->comment('이 코드가 활성화 되었는지를 식별함'); 
            $table->boolean('sysmetic')->default(false)->comment('이 코드가 활성화 되면 시스템 권한을 가진 사용자를 제외한 모든 사용자가 이 코드에 접근할 수 없음');
            $table->text('memo')->nullable()->comment('메모 사항');
            $table->unsignedInteger('order')->unique()->comment('콤보박스에서 보여지는 순서');

            $table->foreign('code_category_id')->references('id')->on('code_categories');
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
        Schema::dropIfExists('codes');
    }
}
