<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->string('first_name', 50)->nullable()->default('')->comment('English First Name');
            $table->string('middle_name', 50)->nullable()->default('')->comment('English Moddle Name');
            $table->string('last_name', 50)->nullable()->default('')->comment('English Last Name');
            $table->string('kor_name', 50)->nullable()->default('')->comment('Korean Name');
            $table->date('dob')->nullable()->default('1990-01-01')->comment('Date of Birth');
            $table->char('gender', 1)->default('F')->comment('Gender: M)ale, F)emale');
            $table->string('email', 100)->nullable()->default('')->comment('Email Address');
            $table->string('tel_home', 50)->nullable()->default('')->comment('Home Phone Number');
            $table->string('tel_office', 50)->nullable()->default('')->comment('Office Phone Number');
            $table->string('tel_cell', 50)->nullable()->default('')->comment('Cell Phone Number');
            $table->string('address', 100)->nullable()->default('')->comment('Mail Address');
            $table->char('postal_code', 50)->nullable()->default('')->comment('Postal Code');
            $table->string('photo')->nullable()->default('')->comment('Photo Image file Path');
            $table->boolean('primary')->default(false)->comment('Householder:세대주');
            $table->unsignedInteger('city_id')->comment('Foreign Key: ID of Codes Table identifying City');
            $table->unsignedInteger('province_id')->comment('Foreign Key: ID of Codes Table identifying Province');
            $table->unsignedInteger('country_id')->comment('Foreign Key: ID of Codes Table identifying Country');
            $table->unsignedInteger('status_id')->comment('Foreign Key: ID of Codes Table identifying Member Status(교인상태)');
            $table->unsignedInteger('level_id')->comment('Foreign Key: ID of Codes Table identifying Baptism Status(신급)');
            $table->unsignedInteger('duty_id')->comment('Foreign Key: ID of Codes Table identifying Duty(직분)');
            $table->date('register_at')->nullable()->default(Carbon::now())->comment('Date of Registration');
            $table->date('baptism_at')->nullable()->default('1990-01-01')->comment('Date of Baptism');

            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('codes');
            $table->foreign('province_id')->references('id')->on('codes');
            $table->foreign('country_id')->references('id')->on('codes');
            $table->foreign('status_id')->references('id')->on('codes');
            $table->foreign('level_id')->references('id')->on('codes');
            $table->foreign('duty_id')->references('id')->on('codes');
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
        Schema::dropIfExists('members');
    }
}
