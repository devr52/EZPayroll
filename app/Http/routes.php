<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();


/*--------------------------------------------------------------------------
	PAGES CONTROLLER
--------------------------------------------------------------------------*/
Route::get('/','PagesController@get_index');
Route::get('home','PagesController@get_index')->name('home');
Route::get('how-it-works', 'PagesController@get_howitworks')->name('howitworks');
Route::get('pricing','PagesController@get_pricing')->name('pricing');
Route::get('contact-us','PagesController@get_contact')->name('contact-us');

/*--------------------------------------------------------------------------
	COMPANY REGISTRATION CONTROLLER
--------------------------------------------------------------------------*/

Route::get('register','CompanyRegistration@get_index')->name('register');
Route::post('register','CompanyRegistration@post_register')->name('signup');

Route::group(['prefix' => 'verify'], function () { //ROUTE FOR EMAIL VERIFICATION
Route::get('{cc}','CompanyRegistration@get_verification')->name('verification');
});

/*--------------------------------------------------------------------------
	DASHBOARD CONTROLLER
--------------------------------------------------------------------------*/


Route::get('dashboard/{company}','DashboardController@get_demo')->name('getdemo');
Route::get('dashboard', 'DashboardController@index')->name('dashboard');


/*-------------------------------------------------------------------------
	EMPLOYEE CONTROLLER
--------------------------------------------------------------------------*/

	Route::resource('employee', 'EmployeeController');

	Route::post('employee/{company}', 'EmployeeController@addEmployee')->name('addEmp');
	Route::get('multi-insert','DashboardController@get_multi_insert')->name('multi-insert')->middleware('admin');

/*--------------------------------------------------------------------------
	PAY DETAILS CONTROLLER
--------------------------------------------------------------------------*/
	Route::resource('salary', 'PayDetailsController');
	Route::get('salary/set-sal/{employee}', 'PayDetailsController@set_sal')->name('set-sal');
	Route::post('salary/store/{employee}', 'PayDetailsController@store_sal')->name('salary.store');


/*
--------------------------------------------------------------------------
 PAYROLL CONTROLLER
--------------------------------------------------------------------------
*/

	Route::get('view-payroll', 'DashboardController@get_view_payroll')->name('view-payroll');
	Route::get('send-payroll','DashboardController@get_send_payroll')->name('send-payroll');

/*

--------------------------------------------------------------------------
 ATTENDANCE CONTROLLER
--------------------------------------------------------------------------
*/

	Route::get('attendance/resolve-attendance', 'AttendanceController@index')->name('attendance');
	Route::post('a-download', 'AttendanceController@download')->name('a-download');
	Route::post('a-upload/{company}', 'AttendanceController@upload')->name('a-upload');

/*

--------------------------------------------------------------------------
 EMPLOYEE PAYMENTS CONTROLLER
--------------------------------------------------------------------------
*/
	Route::get('payroll/employee-payments', 'PaymentSpecificController@index')->name('emp-payments');
	Route::post('ep-download', 'PaymentSpecificController@download')->name('ep-download');
	Route::post('ep-upload/{company}', 'PaymentSpecificController@upload')->name('ep-upload');

/*
--------------------------------------------------------------------------
 PAYMENTS CONTROLLER
--------------------------------------------------------------------------
*/
	Route::get('payroll','PayrollController@index')->name('payroll');
	Route::get('payroll/all/{sd}/{ed}','PayrollController@view_all')->name('view-all');
	Route::post('payroll/generate/{sd}/{ed}', 'PayrollController@generate_payroll')->name('generate-payroll');
	Route::get('payroll/generation-report/{sd}/{ed}','PayrollController@generation_report')->name('gen-rep');
	Route::get('payroll/choose-pay-period', 'PayrollController@chooseperiod')->name('choose-period');
	Route::post('payroll/redirect', 'PayrollController@redirect')->name('redirect');
	Route::get('payroll/send-email-payslip/{sd}/{ed}', 'PayrollController@send_payslip')->name('send-payslip');
/*
--------------------------------------------------------------------------
 SEARCH CONTROLLER
--------------------------------------------------------------------------
*/

	Route::post('employee', 'SearchController@edit_search')->name('edit_search');
	Route::post('salary', 'SearchController@setSal_search')->name('setSal_search');
	Route::post('payroll/{sd}/{ed}', 'SearchController@payroll_search')->name('payroll_search');
	Route::post('payslip/{sd}/{ed}', 'SearchController@payslip_search')->name('payslip_search');



/*
------------------------------------------------------------------------
 ERROR
--------------------------------------------------------------------------
*/
	Route::get('401', function(){
		return view('errors.401');
	});

	Route::get('404',function(){
		return view('errors.404');
	});


/*--------------------------------------------------------------------------
	EXCEL CONTROLLER
--------------------------------------------------------------------------*/

	Route::post('download', 'ExcelController@postExport')->name('download');
	Route::post('upload/{company}', 'ExcelController@postInsert')->name('upload');

	Route::get('compute-sal', 'DashboardController@get_compute_sal')->name('compute-sal');

/*--------------------------------------------------------------------------
	PDF CONTROLLER
--------------------------------------------------------------------------*/

	Route::get('pdf/{payment}', 'PDFController@stream')->name('pdf-view');



