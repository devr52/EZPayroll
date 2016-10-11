<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_count')->unsigned();
            $table->string('company_name',50);
            $table->string('full_name',100);
            $table->string('company_position', 100);
            $table->string('email',50)->unique();
            $table->string('info_source',20);
            $table->boolean('confirmed');
            $table->integer('confirm_code');
            $table->string('subscription',20);
            $table->string('sub_expire');

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
        Schema::drop('Companies');
    }
}
