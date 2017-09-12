<?php
namespace App\Http\Controllers\MyOwnAuth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Session;

class MyOwnAuthLoginController extends Controller {
	public function index() {
		if(!Auth::user()) {
			return redirect()->route('moa.login');
		}else{
			return redirect()->route('dashboard');
		}
	}

	public function login() {
		if(Auth::user()) {
			return redirect()->route('dashboard');
		}
		return view('auth.login');
	}

	public function dologin(Request $request) {
		if (Auth::attempt([
			'email' => $request->get('email'),
			'password' => $request->get('password') 
		])) {
			session([ 
				'email' => $request->get('email')
			]);
			return redirect()->back();
		}else{
			Session::flash('message', "Invalid Credentials , Please try again.");
			return redirect()->back();
		}
	}
}