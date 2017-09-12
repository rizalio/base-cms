<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'language'], function(){

	Route::get('/', ['as' => 'frontend.home', 'uses' =>'Frontend\HomeFrontendController@index']);
	Route::get('product/{type}',['as' => 'frontend.product', 'uses' => 'Frontend\HomeFrontendController@product']);
	Route::get('service',['as' => 'frontend.service', 'uses' => 'Frontend\HomeFrontendController@service']);
	Route::get('about',['as' => 'frontend.about', 'uses' => 'Frontend\HomeFrontendController@about']);
	Route::get('news',['as' => 'frontend.news', 'uses' => 'Frontend\HomeFrontendController@news']);
	Route::get('single/{slug}',['as' => 'frontend.single', 'uses' => 'Frontend\HomeFrontendController@single']);
	Route::get('contact',['as' => 'frontend.contact', 'uses' => 'Frontend\HomeFrontendController@contact']);
	Route::get('search',['as' => 'frontend.search', 'uses' => 'Frontend\HomeFrontendController@search']);
	Route::get('product-details/{slug}', ['as' => 'product.slug', 'uses' => 'RangeProductController@withSlug']);

	Route::get('locale/{id}', ['as'=>'switchlang','uses' => 'Frontend\LanguageController@switchLang']);;

	Auth::routes();
	Route::get('login', function(){return view('errors.404');});
	Route::post('login', function(){return view('errors.404');});
	Route::get('register', function(){return view('errors.404');});
	Route::post('register', function(){return view('errors.404');});
	Route::get('password', function(){return view('errors.404');});
	Route::get('passwords', function(){return view('errors.404');});
	Route::get('password/reset', function(){return view('errors.404');});
	Route::post('password/reset', function(){return view('errors.404');});
	Route::get('password/email', function(){return view('errors.404');});
	Route::post('password/email', function(){return view('errors.404');});

	Route::group(['prefix' => config('app.backend')], function(){
		Route::get('', 'MyOwnAuth\MyOwnAuthLoginController@index');
		Route::get('login', ['as'=>'moa.login','uses'=>'MyOwnAuth\MyOwnAuthLoginController@login']);
		Route::post('login', ['as'=>'moa.login','uses'=>'MyOwnAuth\MyOwnAuthLoginController@dologin']);
	});


		Route::get('media/images/{filename}', function ($filename) {
			return to_image(storage_path() . '/media/images/' . $filename);
		});


		Route::get('media/images/shares/{filename}', function ($filename) {
			return to_image(storage_path() . '/media/images/shares/' . $filename);
		});

		Route::get('media/images/shares/thumbs/{filename}', function ($filename) {
			return to_image(storage_path() . '/media/images/shares/thumbs/' . $filename);
		});

	Route::group(['middleware' => 'auth', 'prefix' => config('app.backend')], function() {
		Route::get('/', function(){
			return redirect()->route('dashboard');
		});
		Route::get('dashboard', ['as'=>'dashboard', 'uses'=>'HomeController@index']);

		Route::put('settings/changes', ['as'=>'settings.changes', 'uses'=>'SettingsController@changes']);
		Route::get('settings/creator', 'SettingsController@creator');
		Route::resource('settings', 'SettingsController');

		Route::get('sections/manage/{id}/list', ['as'=>'sections.manage.list','uses'=>'SectionsController@manage_list']);
		Route::get('sections/manage/{id}/edit/{id_detail}', ['as'=>'sections.manage.edit','uses'=>'SectionsController@manage_edit']);
		Route::put('sections/manage/{id}/edit/{id_detail}', ['as'=>'sections.manage.update','uses'=>'SectionsController@manage_update']);
		Route::delete('sections/manage/{id}/delete/{id_detail}', ['as'=>'sections.manage.delete','uses'=>'SectionsController@manage_delete']);
		Route::get('sections/creator', ['as'=>'sections.creator','uses'=>'SectionsController@creator']);
		Route::get('sections/manage/{id}', ['as' => 'sections.manage', 'uses'=>'SectionsController@manage']);
		Route::post('sections/manage/{id}', ['as'=>'sections.store_design','uses'=>'SectionsController@store_design']);
		Route::resource('sections', 'SectionsController');

		Route::resource('sectionDetails', 'SectionDetailsController');

		Route::resource('categories', 'CategoriesController');

		Route::resource('posts', 'PostsController');

		Route::resource('users', 'UsersController');

		Route::get('apply', ['as' => 'apply.index', 'uses' => 'ContactController@apply']);
		Route::get('apply/file/{filename}', ['as' => 'apply.file', 'uses' => 'ContactController@file']);
		
		Route::resource('contacts', 'ContactController');
		Route::get('localizations/set_default', 'LocalizationController@set_default')->name('localizations.set_default');
		Route::resource('localizations', 'LocalizationController');
	});

	Route::get('post/detail/{id}', ['as' => 'posts.detail', 'uses' => 'Frontend\HomeFrontendController@postDetail']);
	Route::post('contacts', 'ContactController@store');

});
