<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('company_id')->unsigned()->index();
            $table->bigInteger('employee_id')->unsigned()->index();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('basic_pay',10,2)->unsigned()->nullable();
            $table->decimal('overtime_pay',10,2)->unsigned()->nullable();
            $table->decimal('nightdiff_pay',10,2)->unsigned()->nullable();
            $table->decimal('restday_pay',10,2)->unsigned()->nullable();
            $table->decimal('holiday_pay',10,2)->unsigned()->nullable();
            $table->decimal('taxable_allowance',10,2)->unsigned()->nullable();
            $table->decimal('non_taxable_allowance',10,2)->unsigned()->nullable();
            $table->decimal('one_time_allowance',10,2)->unsigned()->nullable();
            $table->decimal('bonus',10,2)->unsigned()->nullable();
            $table->decimal('cash_advance',10,2)->unsigned()->nullable();
            $table->decimal('payroll_adjustments',10,2)->unsigned()->nullable();
            $table->decimal('sss_deduction', 6,2)->unsigned()->nullable();
            $table->decimal('hdmf_deduction', 6,2)->unsigned()->nullable();
            $table->decimal('phic_deduction', 6,2)->unsigned()->nullable();
            $table->decimal('loan_deduction', 6,2)->unsigned()->nullable();
            $table->decimal('other_deduction', 6,2)->unsigned()->nullable();
            $table->decimal('taxable_income', 10,2)->unsigned();
            $table->decimal('withholding_tax', 10,2)->unsigned()->nullable();
            $table->decimal('gross_pay', 10,2)->unsigned();
            $table->decimal('net_pay', 10,2)->unsigned();


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
        Schema::drop('payments');
    }
}
