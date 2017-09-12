<?php

function to_image($path) {
    if(!File::exists($path)) return view('errors.404');

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
}

function availSection() {
	$table = DB::table('sections')->where('type', 'loop')->get();
	$sec = [];
	foreach($table as $item) {
		$sec[$item->id] = $item;
	}
	return $sec;
}

function getSectionName($id) {
	$table = DB::table('section_details')->find($id);
	return json_decode($table->content)->display_name;
}

function getSectionList($id) {
	$table = DB::table('section_details')->whereSectionId($id)->groupBy('gen_id')->get();
	$l = [];
	foreach($table as $it) {
		$l[$it->id] = json_decode($it->content);
		$l[$it->id]->id = $it->id;
	}
	return $l;
}

function section($section, $field=false,$where=false,$lang=false) {
	$query = DB::table('sections')->where('namespace', $section)->where('deleted_at', NULL)->first();
	if($query->type == 'single') {
		$get_details = DB::table('section_details')->where('section_id', $query->id)->whereLang(getLangPlease())->where('deleted_at', NULL)->first();
		return json_decode($get_details->content)->{$field};
	}elseif($query->type == 'loop'){
		$new_arr = [];
		$get_details = DB::table('section_details')->where('section_id', $query->id)->whereLang(getLangPlease())->where('deleted_at', NULL);
		if(isset($field) && is_numeric($field)) {
			$get_details = $get_details->limit($field);
		}
		$get_details = $get_details->get();
		foreach ($get_details as $key => $value) {
			$new_arr[] = json_decode($value->content);
		}
		if(is_array($where)) {
			$new_arr = findArrayBy($new_arr, $where);
		}
		return (object) $new_arr;
	}
}

function findSectionItemBy($field, $section) {
	$find = DB::table('sections')->whereNamespace($section)->first();
	$finditem = DB::table('section_details')->whereSectionId($find->id)->groupBy('gen_id')->get();
	$content = [];
	foreach($finditem as $i=>$item) {
		$content[$i] = json_decode($item->content);
		$content[$i]->id = $item->id;
	}
	return findObjectBy($content, $field);
}

function findArrayBy($array, $value) {
	$_arr = [];
	$i = 0;
	foreach($array as $item) {
		if($item->{$value[0]} == $value[1]) {
			$_arr[$i] = $item;
			$i++;
		}
	}
	return $_arr;
}

function findObjectBy($array, $value) {
	$_arr = [];
	foreach($array as $i=>$item) {
		if($item->{$value[0]} == $value[1]) {
			$_arr = $item;
		}
	}
	return $_arr;
}

function setting($name) {
	$query = DB::table('settings')->where('name', $name)->first();
	return $query->value;
}

function fieldtype($item, $value, $locale, $col = "col-md-6") {
		switch ($item->type) {
			case 'text':
				echo "<div class='form-group {$col}'>";
				echo "<label>".$item->display_name."</label>";
				echo "<input type='text' data-" . $item->name . "  name='content[".$locale->id."][".$item->name."]' class='form-control' value='".(@$value[$locale->id]->{$item->name} ? @$value[$locale->id]->{$item->name} : '')."'>";
				echo "</div>";
				break;
			case 'textarea':
				echo "<div class='form-group col-md-12'>";
				echo "<label>".$item->display_name."</label>";
				echo "<textarea name='content[".$locale->id."][".$item->name."]' class='form-control'>".(@$value[$locale->id]->{$item->name} ? @$value[$locale->id]->{$item->name} :'')."</textarea>";
				echo "</div>";
				break;
			case 'textarea_rich':
				echo "<div class='form-group col-md-12'>";
				echo "<label>".$item->display_name."</label>";
				echo "<textarea name='content[".$locale->id."][".$item->name."]' class='tinymce'>".(@$value[$locale->id]->{$item->name} ? @$value[$locale->id]->{$item->name} :'')."</textarea>";
				echo "</div>";
				break;
			case 'files_all':
				echo "<div class='form-group {$col}'>";
				echo "<label>".$item->display_name."</label>";
				echo "<div class='input-group'>";
				echo "<input type='text' name='content[".$locale->id."][".$item->name."]' class='form-control' value='".(@$value[$locale->id]->{$item->name} ? @$value[$locale->id]->{$item->name} :'')."' id='files".$item->name.$locale->namespace."'>";
				echo "<div class='input-group-btn'><a class='btn btn-primary' data-fm-files='true' data-input='files".$item->name.$locale->namespace."'>Pick File</a></div>";
				echo "</div>";
				echo "</div>";
				break;
			case 'files_images':
				echo "<div class='form-group {$col}'>";
				echo "<label>".$item->display_name."</label>";
				echo "<div class='input-group'>";
					echo "<input type='text' name='content[".$locale->id."][".$item->name."]' class='form-control' value='".(@$value[$locale->id]->{$item->name} ? @$value[$locale->id]->{$item->name} :'')."' id='files".$item->name.$locale->namespace."'>";
				echo "<div class='input-group-btn'><a class='btn btn-primary' data-fm='true' data-input='files".$item->name.$locale->namespace."'>Pick Image</a></div>";
				echo "</div>";
				echo "</div>";
				break;
			case 'date':
				echo "<div class='form-group {$col}'>";
				echo "<label>".$item->display_name."</label>";
				echo "<div class='input-group'>";
				echo "<div class='input-group-addon'><i class='ion-calendar'></i></div>";
				echo "<input type='text' name='content[".$locale->id."][".$item->name."]' class='form-control datepicker' value='".(@$value[$locale->id]->{$item->name} ? @$value[$locale->id]->{$item->name} : date('Y-m-d'))."'>";
				echo "</div>";
				echo "</div>";
				break;
			case strpos($item->type, 'section_') >= 0:
				echo "<div class='form-group {$col}'>";
				echo "<label>".$item->display_name."</label>";
				echo "<select class='form-control' name='content[".$locale->id."][".$item->name."]'>";
					echo "<option value='0'>None</option>";
				foreach(getSectionList(str_replace("section_", "", $item->type)) as $sec) {				
					echo "<option value='".$sec->id."' ".($sec->id == @$value[$locale->id]->{$item->name} ? "selected":'').">".$sec->display_name."</option>";
				}
				echo "</select>";
				echo "</div>";
				break;
			default:
				echo "<div class='form-group col-sm-12'><span style='color: #FF0000'>Type field is not recognized</span></div>";
				break;
		}
}

function setting_fieldtype($item, $value, $col = "col-md-6") {
		switch ($item->type) {
			case 'text':
				echo "<div class='form-group {$col}'>";
				echo "<label>".$item->display_name."</label>";
				echo "<input type='text' name='content[".$item->name."]' class='form-control' value='".(@$value->{$item->name} ? @$value->{$item->name} : '')."'>";
				echo "</div>";
				break;
			case 'textarea':
				echo "<div class='form-group col-md-12'>";
				echo "<label>".$item->display_name."</label>";
				echo "<textarea name='content[".$item->name."]' class='form-control'>".(@$value->{$item->name} ? @$value->{$item->name} :'')."</textarea>";
				echo "</div>";
				break;
			case 'textarea_rich':
				echo "<div class='form-group col-md-12'>";
				echo "<label>".$item->display_name."</label>";
				echo "<textarea name='content[".$item->name."]' class='tinymce'>".(@$value->{$item->name} ? @$value->{$item->name} :'')."</textarea>";
				echo "</div>";
				break;
			case 'files_all':
				echo "<div class='form-group {$col}'>";
				echo "<label>".$item->display_name."</label>";
				echo "<div class='input-group'>";
				echo "<input type='text' name='content[".$item->name."]' class='form-control' value='".(@$value->{$item->name} ? @$value->{$item->name} :'')."' id='files".$item->name."'>";
				echo "<div class='input-group-btn'><a class='btn btn-primary' data-fm-files='true' data-input='files".$item->name."'>Pick File</a></div>";
				echo "</div>";
				echo "</div>";
				break;
			case 'files_images':
				echo "<div class='form-group {$col}'>";
				echo "<label>".$item->display_name."</label>";
				echo "<div class='input-group'>";
					echo "<input type='text' name='content[".$item->name."]' class='form-control' value='".(@$value->{$item->name} ? @$value->{$item->name} :'')."' id='files".$item->name."'>";
				echo "<div class='input-group-btn'><a class='btn btn-primary' data-fm='true' data-input='files".$item->name."'>Pick Image</a></div>";
				echo "</div>";
				echo "</div>";
				break;
			case 'date':
				echo "<div class='form-group {$col}'>";
				echo "<label>".$item->display_name."</label>";
				echo "<div class='input-group'>";
				echo "<div class='input-group-addon'><i class='ion-calendar'></i></div>";
				echo "<input type='text' name='content[".$item->name."]' class='form-control datepicker' value='".(@$value->{$item->name} ? @$value->{$item->name} : date('Y-m-d'))."'>";
				echo "</div>";
				echo "</div>";
				break;
			
			default:
				echo "<div class='form-group col-sm-12'><span style='color: #FF0000'>Type field is not recognized</span></div>";
				break;
		}
}

function human_string($str) {
	$str = ucwords($str);
	$str = str_replace("_", " ", $str);
	return $str;
}

function seo( $string, $separator = '-' )
{
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array( '&' => 'and', "'" => '');
    $string = mb_strtolower( trim( $string ), 'UTF-8' );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
}

function localization() {
	$table = DB::table("lang")->whereNull('deleted_at')->get();
	return $table;
}

function locale() {
	$table = DB::table("lang")->whereNull('deleted_at')->get();
	$locale = [];
	foreach($table as $l) {
		$locale[$l->namespace] = $l->name;
	}
	return $locale;
}

function getLangPlease() {
	$lang = DB::table('lang')->whereNamespace(App::getLocale())->first();
	return $lang->id;
}

function showSocialMedia($social) {
	if(filter_var($social->link, FILTER_VALIDATE_URL)) {
		return '<li><a target="_blank" href="' . $social->link . '"><i class="' . $social->icon . '"></i></a></li>';
	}

	return '';
}

function flag() {
	$locale = app()->getLocale();

	switch ($locale) {
		case 'id':
			return '<span class="flag-icon flag-icon-id"></span>';
			break;

		case 'en':
			return '<span class="flag-icon flag-icon-us"></span>';
			break;
				
		default:
			return '';
			break;
	}
}

function truncate($text, $max) {
	if(strlen($text) > $max) {
		return substr($text, 0, $max) . '...';
	}

	return $text;
}

function getDefaultLanguage() {
	$langs = DB::table('lang')->where('deleted_at', NULL)->where('default_lang', true)->first();
	return $langs->namespace;
}