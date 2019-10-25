<?php

namespace App\Http\Controllers;

class WebAppController extends Controller {
	public function __construct() {

	}

	public function index() {
		return view('home');
	}

	public function login() {
		return view('login');
	}
}
