<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Posts;
use App\Models\Contact;
use App\Models\Sections;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Users::count();
        $posts = Posts::count();
        $contacts = Contact::count();
        $sections = Sections::count();
        return view('home.index')
        ->with('users',$users)
        ->with('contacts',$contacts)
        ->with('sections',$sections)
        ->with('posts',$posts);
    }
}
