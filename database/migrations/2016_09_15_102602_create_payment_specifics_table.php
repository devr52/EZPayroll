<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSpecificsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_specifics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned()->index();
            $table->bigInteger('employee_id')->unsigned()->index();
            $table->decimal('bonus', 10,2)->unsigned()->nullable();
            $table->decimal('cash_advance', 10,2)->unsigned()->nullable();
            $table->decimal('loan_deduction', 10,2)->unsigned()->nullable();
            $table->decimal('payroll_adjustments', 10,2)->unsigned()->nullable();
            $table->decimal('one_time_allowance', 10,2)->unsigned()->nullable();
            $table->decimal('other_deductions', 10,2)->unsigned()->nullable();
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::drop('payment_specifics');
    }
}
