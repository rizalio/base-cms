<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RangeProductController extends Controller
{
    public function withSlug($slug) {
    	$section = DB::table('sections')->where('namespace', 'product_range')->first();
    	$details = DB::table('section_details')->where('section_id', $section->id)->whereLang(getLangPlease())->where('deleted_at', NULL)->get();
    	foreach($details as $key => $data) {
    		$array = json_decode($data->content, true);

    		if($array['link'] == $slug) {
    			return view('frontend.pages.product-details')->with('data', $array);
    		}
    	}

    	return abort(404);
    }
}
