<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned()->index();
            $table->bigInteger('employee_id')->unsigned()->index();
            $table->string('payment_type', 50);
            $table->string('marital_status',20);
            $table->string('schedule',50);
            $table->decimal('basic_pay',10,2)->unsigned();
            $table->decimal('taxable_allowance',10,2)->unsigned();
            $table->decimal('non_taxable_allowance',10,2)->unsigned();
            $table->decimal('daily_rate',14,10)->unsigned();
            $table->decimal('hourly_rate',14,10)->unsigned();
            $table->decimal('sss_d', 6,2)->unsigned();
            $table->decimal('hdmf_d', 6,2)->unsigned();
            $table->decimal('phic_d', 6,2)->unsigned();
            $table->tinyInteger('dependents')->unsigned();
            $table->tinyInteger('leave_eligibility')->default(0)->nullable();

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
        Schema::drop('payroll_infos');
    }
}
