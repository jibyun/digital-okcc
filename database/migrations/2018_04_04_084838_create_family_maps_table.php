<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_maps', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->unsignedInteger('member_pri_id')->comment('Foreign Key: ID of Members Table');
            $table->unsignedInteger('member_sub_id')->comment('Foreign Key: ID of Members Table');
            $table->unsignedInteger('relation_id')->comment('Foreign Key: ID of Codes Table to relationship with the head of household');
            
            $table->foreign('member_pri_id')->references('id')->on('members');
            $table->foreign('member_sub_id')->references('id')->on('members');
            $table->foreign('relation_id')->references('id')->on('codes');
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
        Schema::dropIfExists('family_maps');
    }
}
