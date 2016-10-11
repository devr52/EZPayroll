<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned()->index();
            $table->string('emp_num',50);
            $table->string('last_name',50);
            $table->string('first_name',50);
            $table->string('gender', 10);
            $table->string('email', 50)->nullable();
            $table->string('contact_num',50)->nullable();
            $table->string('position',50)->nullable();
            $table->string('employee_type',50)->nullable();
            $table->date('employment_date')->nullable();
            $table->string('emergency_number',50)->nullable();
            $table->string('system_permission',50);

            $table->timestamps();


            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Employees');
    }
}
