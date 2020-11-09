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

use Illuminate\Support\Str;
use App\User;

// Route::get('/','WebController@index');
Route::get('/','WebController@index');
Route::get('/business-register','WebController@business_register_page');
Route::get('/business-register-step2/{category}/{slug}/{id}','WebController@business_register_page_two');
Route::get('/business-register-step1/{category}/{slug}/{id}','WebController@business_register_page_one_back');
Route::get('/congratulations','WebController@business_congratulations_page');
Route::post('store_business_register_data','WebController@store_business_register_data');
Route::post('update_business_register_data','WebController@update_business_register_data');
Route::post('store_business_register_data_step_two','WebController@store_business_register_data_step_two');
Route::get('/send_test_email','WebController@send_test_email');
Route::post('store_subscription','WebController@store_subscription_send_mail');
Route::post('store_intrested_in_graphics_desgin','WebController@store_intrested_in_graphics_desgin_send_mail');
Route::post('check_business_name_exists_step1', 'WebController@check_business_name_exists_step1');
Route::post('serach_sub_category', 'WebController@serach_sub_category_exists');
// Route::get('/mazy', function ()
// {
//   $string = " hello moto moto";
//   $newString = Str::random(40);
//   dd($newString);
// });


Route::get('/show_section/{id}', 'Admin\BusinessController@show_section');

Route::get('/fill_section/{id}', 'Admin\BusinessController@fill_section');
Route::get('/edit_data_submission/{id}/{cat_id}', 'Admin\BusinessController@edit_data_submission');
Route::post('check_question_name_exists', 'Admin\BusinessController@check_question_name_exists');
Route::post('check_business_name_exists', 'Admin\BusinessController@check_business_name_exists');
Route::post('check_business_slug_exists', 'Admin\BusinessController@check_business_slug_exists');
Route::post('/delete_business_listing', 'Admin\BusinessController@delete_business_listing');

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
Route::get('/search_location', 'WebController@get_locations');
Route::get('/search_location_admin', 'Admin\BusinessController@get_locations_admin');
Route::get('/search_business', 'HomeController@get_businesses');

Route::get('/settings', 'HomeController@user_settings');
// Route::get('/search/{type}/{city}', 'HomeController@search_categories_values');
Route::get('/search/{slug?}', 'WebController@search_categories_values_listing')->where('slug', '(.*)');
Route::get('/{type}/{name}', 'WebController@show_detail_page');

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

Route::get('/admin_dashboard', 'Admin\BusinessController@view_admin_dashboard');
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

Route::get('/view_data_submissions/{slug?}', 'Admin\BusinessController@view_data_submissions')->where('slug', '(.*)');
Route::post('/update_category_data_submission', 'Admin\BusinessController@update_category_data_submission');

Route::post('/store_fill_section_form', 'Admin\BusinessController@store_fill_section_form');
Route::post('/update_fill_section_form', 'Admin\BusinessController@update_fill_section_form');
Route::post('/delete_single_submission_image', 'Admin\BusinessController@delete_single_submission_image');
Route::post('/delete_single_submission_image_step_one', 'WebController@delete_single_submission_image_step_one');
Route::post('get_lat_long', 'Controller@get_lat_long');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
