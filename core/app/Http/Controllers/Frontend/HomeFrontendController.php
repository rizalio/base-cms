<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App;
use DB;

class HomeFrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Posts = Posts::all();
        return view('frontend.pages.home')->with('posts', $Posts);
    }

    public function sections() {
        return 'hello';
    }

    public function postDetail($id) {
        $post = Posts::with('category')->find($id);
        if(!count($post)) {
            return 'failed';
        }
        return $post;
    }

    public function product($type) {
        return view('frontend.pages.product', compact('type'));
    }

    public function service() {
        return view('frontend.pages.service');
    }

    public function about() {
        return view('frontend.pages.about');
    }

    public function news() {
        $blogs = Posts::orderBy('created_at', 'desc')->whereLang(getLangPlease())->groupBy('gen_id')->paginate(setting('post_per_page'));
        $recent = Posts::whereLang(getLangPlease())->groupBy('gen_id')->limit(5)->get();
        $archive1 = DB::select('SELECT YEAR(created_at) AS YEAR, MONTH(created_at) AS MONTH, COUNT(gen_id) AS TOTAL FROM posts GROUP BY YEAR, MONTH');
        $_archive = [];
        foreach($archive1 as $row) {
            $find = Posts::whereRaw("MONTH(created_at) = '".$row->MONTH."'")->groupBy('gen_id')->get();
            $_archive[$row->MONTH] = $find;
        }
        $archive = $_archive;
        return view('frontend.pages.news', compact('blogs', 'recent', 'archive'));
    }

    public function single($slug) {
        $post = Posts::whereSlug($slug)->whereLang(getLangPlease())->first();
        $recent = Posts::whereLang(getLangPlease())->groupBy('gen_id')->limit(5)->get();
        $archive1 = DB::select('SELECT YEAR(created_at) AS YEAR, MONTH(created_at) AS MONTH, COUNT(gen_id) AS TOTAL FROM posts GROUP BY YEAR, MONTH');
        $_archive = [];
        foreach($archive1 as $row) {
            $find = Posts::whereRaw("MONTH(created_at) = '".$row->MONTH."'")->groupBy('gen_id')->get();
            $_archive[$row->MONTH] = $find;
        }
        $archive = $_archive;
        return view('frontend.pages.single', compact('post','archive', 'recent'));
    }

    public function contact() {
        return view('frontend.pages.contact');
    }

    public function lang($id) {
        session(['my_locale' => $id]);
        return redirect()->back();
    }

    public function search() {
        $q = request()->q;
        $blogs = Posts::where('title', 'like', '%'.$q.'%')->where('description', 'like', '%'.$q.'%')->whereLang(getLangPlease())->groupBy('gen_id')->paginate(6);
        return view('frontend.pages.search', compact('q', 'blogs'));
    }
}
