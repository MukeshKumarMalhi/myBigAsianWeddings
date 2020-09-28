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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\User;

Route::get('/','WebController@index');


Auth::routes();
Route::get('/show_section/{id}', 'Admin\BusinessController@show_section');
Route::get('/fill_section/{id}', 'Admin\BusinessController@fill_section');
Route::get('/edit_data_submission/{id}/{cat_id}', 'Admin\BusinessController@edit_data_submission');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/signup', 'WebController@signup');
Route::get('/login', 'WebController@login');
Route::get('/logout', 'Auth\LoginController@logout');

// Route::post('/register', 'Auth\LoginController@redirect');
Route::get('/auth/redirect/{provider}', 'Auth\SocialController@redirect');
Route::get('/callback/{provider}', 'Auth\SocialController@callback');

Route::post('/complete_profile', 'HomeController@complete_profile');
Route::post('/update_user_info', 'HomeController@update_user_info');
Route::post('/update_date_ajax', 'HomeController@update_date_ajax');
Route::post('/store_message', 'HomeController@store_message_ajax');
Route::post('/store_feedback', 'HomeController@store_feedback_ajax');
Route::post('/upload_user_image', 'HomeController@upload_user_image');
Route::post('/remove_user_image', 'HomeController@remove_user_image');
Route::post('/change_email_address', 'HomeController@change_email_address');
Route::post('/store_user_url', 'HomeController@store_user_url');
Route::post('/delete_user_url', 'HomeController@delete_user_url');
Route::post('/create_session_variable', 'HomeController@create_session_variable');

Route::get('/happy_wedding/{user_url}', function($user_url){
  $user = DB::table('users')
      ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
      ->select('users.*', 'locations.location_name')
      ->where('users.user_url','like',"%{$user_url}%")
      ->first();
  return view('url_page', compact('user'));
});
// Route::get('/happy_wedding/{user_url}', 'HomeController@show_user_url');

Route::get('/search_venues', 'HomeController@get_venues');
Route::get('/search_location', 'HomeController@get_locations');
Route::get('/search_business', 'HomeController@get_businesses');

Route::get('/settings', 'HomeController@user_settings');
Route::get('/search/{type}/{city}', 'HomeController@search_categories_values');
Route::get('/{type}/{name}', 'HomeController@show_detail_page');

Route::post('/store_shortlist', 'HomeController@store_shortlist');
Route::post('/delete_shortlist', 'HomeController@delete_shortlist');
Route::post('/store_my_info', 'HomeController@store_my_info');



Route::get('/view_countries', 'Admin\BusinessController@view_countries');
Route::post('store_country', 'Admin\BusinessController@store_country');
Route::post('update_country', 'Admin\BusinessController@update_country');
Route::post('delete_country', 'Admin\BusinessController@delete_country');

Route::get('/view_categories', 'Admin\BusinessController@view_categories');
Route::post('store_category', 'Admin\BusinessController@store_category');
Route::post('update_category', 'Admin\BusinessController@update_category');
Route::post('delete_category', 'Admin\BusinessController@delete_category');

Route::get('/view_locations', 'Admin\BusinessController@view_locations');
Route::post('store_location', 'Admin\BusinessController@store_location');
Route::post('update_location', 'Admin\BusinessController@update_location');
Route::post('delete_location', 'Admin\BusinessController@delete_location');

Route::get('/view_features', 'Admin\BusinessController@view_features');
Route::post('store_feature', 'Admin\BusinessController@store_feature');
Route::post('update_feature', 'Admin\BusinessController@update_feature');
Route::post('delete_feature', 'Admin\BusinessController@delete_feature');

Route::get('/view_business', 'Admin\BusinessController@create_new_business');
Route::post('/store_business', 'Admin\BusinessController@store_business');
Route::get('/show_business/{id}', 'Admin\BusinessController@show_business');
Route::post('/delete_business', 'Admin\BusinessController@delete_business');


Route::get('/view_data_section', 'Admin\BusinessController@view_data_section');
Route::post('/store_data_section', 'Admin\BusinessController@store_data_section');
Route::post('/update_data_section', 'Admin\BusinessController@update_data_section');
Route::post('/delete_section_data', 'Admin\BusinessController@delete_section_data');
Route::get('/store_data_type', 'Admin\BusinessController@store_data_type');
Route::post('/store_data_question', 'Admin\BusinessController@store_data_question');
Route::post('/update_data_question', 'Admin\BusinessController@update_data_question');
Route::post('/delete_question_data', 'Admin\BusinessController@delete_question_data');

Route::get('/view_data_submissions', 'Admin\BusinessController@view_data_submissions');

Route::post('/store_fill_section_form', 'Admin\BusinessController@store_fill_section_form');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
