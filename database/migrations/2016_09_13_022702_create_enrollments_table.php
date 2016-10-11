<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('company_id')->unsigned()->index();
            $table->bigInteger('employee_id')->unsigned()->index();
            $table->string('sss_n',50);
            $table->string('hdmf_n',50);
            $table->string('phic_n',50);
            $table->string('bank_account_n',100);

            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('enrollments');
    }
}
