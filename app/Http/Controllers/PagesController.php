<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function get_index(){
		return view('/index');
    }

    public function get_howitworks(){
    	return view('pages.howitworks');
    }

    public function get_pricing(){
    	return view('pages.pricing');
    }

    public function get_contact(){
    	return view('pages.contact');
    }



}
