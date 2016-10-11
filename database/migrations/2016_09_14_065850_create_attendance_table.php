<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned()->index();
            $table->bigInteger('employee_id')->unsigned()->index();
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('hours_worked')->unsigned();
            $table->tinyInteger('ot_hours')->unsigned()->nullable();
            $table->tinyInteger('nd_hours')->unsigned()->nullable();
            $table->tinyInteger('RD')->unsigned()->nullable();
            $table->tinyInteger('SH')->unsigned()->nullable();
            $table->tinyInteger('RH')->unsigned()->nullable();
            $table->tinyInteger('DH')->unsigned()->nullable();
            $table->tinyInteger('RH_RD')->unsigned()->nullable();
            $table->tinyInteger('SH_RD')->unsigned()->nullable();
            $table->tinyInteger('DH_RD')->unsigned()->nullable();

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
        Schema::drop('attendance');
    }
}
