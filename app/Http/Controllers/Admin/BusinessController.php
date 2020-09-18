<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
use Excel;
use App\Country;
use App\Location;
use App\Category;
use App\Feature;
use App\Business;
use App\BusinessGallery;
use App\BusinessHour;
use App\BusinessFeature;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function view_countries()
    {
        $countries = Country::orderBy('updated_at','DESC')->paginate(10);
        if (request()->ajax()) {
          $view = view('admins.countries_listing', ['countries' => $countries]);
          return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
        }
        return view('admins.view_countries', compact('countries'));
    }
    public function store_country(Request $request)
    {
      $rules = array(
        'country_name' => 'required',
        'country_flag_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        if($request->hasFile('country_flag_image')){
          $file=$request->file('country_flag_image')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
        }
        else{
          $image_path="";
        }
        $form_data = array(
          'id' => $id,
          'country_name' => $request->country_name,
          'country_flag_image' => $image_path
        );
        $country = Country::create($form_data);
        return response()->json($country, 200);
      }
    }

    public function update_country(Request $request)
    {
      $rules = array(
        'edit_country_name' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        if($request->hasFile('edit_country_flag_image')){
          $file=$request->file('edit_country_flag_image')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
          $country_image = Country::find($request->edit_fid);
          $country_image->country_flag_image = $image_path;
          $country_image->save();
        }

        $country = Country::find($request->edit_fid);
        $country->country_name = $request->edit_country_name;
        $country->save();

        return response()->json($country, 200);
      }
    }

    public function delete_country(Request $request)
    {
      $country = Country::find($request->id)->delete();
      return response()->json("Country Deleted Succssfully", 200);
    }

    public function view_locations()
    {
        $locations = DB::table('locations')
        ->leftJoin('countries', 'countries.id', '=', 'locations.country_id')
        ->select('locations.*', 'countries.country_name')
        ->orderBy('updated_at', 'DESC')
        ->paginate(10);
        if (request()->ajax()) {
          $view = view('admins.locations_listing', ['locations' => $locations]);
          return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
        }
        $countries = Country::all();
        return view('admins.view_locations', compact('locations', 'countries'));
    }
    public function store_location(Request $request)
    {
      $rules = array(
        'location_name' => 'required',
        'location_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        if($request->hasFile('location_icon')){
          $file=$request->file('location_icon')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
        }
        else{
          $image_path="";
        }
        $form_data = array(
          'id' => $id,
          'country_id' => $request->country_id,
          'location_name' => $request->location_name,
          'location_icon' => $image_path
        );
        $location_id = Location::create($form_data);
        $location = DB::table('locations')
        ->leftJoin('countries', 'countries.id', '=', 'locations.country_id')
        ->select('locations.*', 'countries.country_name')
        ->where('locations.id', $location_id->id)
        ->first();
        return response()->json($location, 200);
      }
    }

    public function update_location(Request $request){
      $rules = array(
        'edit_location_name' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        if($request->hasFile('edit_location_icon')){
          $file=$request->file('edit_location_icon')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
          $location = Location::find($request->edit_fid);
          $location->location_icon = $image_path;
          $location->save();
        }
        $location_id = Location::find($request->edit_fid);
        $location_id->country_id = $request->edit_country_id;
        $location_id->location_name = $request->edit_location_name;
        $location_id->save();

        $location = DB::table('locations')
        ->leftJoin('countries', 'countries.id', '=', 'locations.country_id')
        ->select('locations.*', 'countries.country_name')
        ->where('locations.id', $location_id->id)
        ->first();

        return response()->json($location, 200);
      }
    }

    public function delete_location(Request $request)
    {
      $location = Location::find($request->id)->delete();
      return response()->json("Location Deleted Succssfully", 200);
    }

    public function view_categories()
    {
        $categories = DB::table('categories')
        ->leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_category_id')
        ->select('categories.*', 'parents.category_name as parent_category_name')
        ->orderBy('updated_at', 'DESC')
        ->paginate(10);

        $cats = Category::all();
        if (request()->ajax()) {
          $view = view('admins.categories_listing', ['categories' => $categories]);
          return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
        }
        return view('admins.view_categories', compact('categories', 'cats'));
    }

    public function store_category(Request $request)
    {
      $rules = array(
        'category_name' => 'required',
        'category_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        if($request->hasFile('category_icon')){
          $file=$request->file('category_icon')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
        }
        else{
          $image_path="";
        }
        $form_data = array(
          'id' => $id,
          'parent_category_id' => $request->parent_category_id,
          'category_name' => $request->category_name,
          'category_icon' => $image_path
        );
        $category_id = Category::create($form_data);
        $category = DB::table('categories')
        ->leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_category_id')
        ->select('categories.*', 'parents.category_name as parent_category_name')
        ->where('categories.id', $category_id->id)
        ->first();
        return response()->json($category, 200);
      }
    }

    public function update_category(Request $request)
    {
      $rules = array(
        'edit_category_name' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        if($request->hasFile('edit_category_icon')){
          $file=$request->file('edit_category_icon')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
          $category = Category::find($request->edit_fid);
          $category->category_icon = $image_path;
          $category->save();
        }
        $category_id = Category::find($request->edit_fid);
        $category_id->parent_category_id = $request->edit_parent_category_id;
        $category_id->category_name = $request->edit_category_name;
        $category_id->save();

        $category = DB::table('categories')
        ->leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_category_id')
        ->select('categories.*', 'parents.category_name as parent_category_name')
        ->where('categories.id', $category_id->id)
        ->first();

        return response()->json($category, 200);
      }
    }

    public function delete_category(Request $request)
    {
      $category = Category::find($request->id)->delete();
      return response()->json("Category Deleted Succssfully", 200);
    }

    public function view_features()
    {
        $features = DB::table('features')
        ->leftjoin('features as parents', 'parents.id', '=', 'features.parent_feature_id')
        ->select('features.*', 'parents.feature_name as parent_feature_name')
        ->orderBy('updated_at', 'DESC')
        ->paginate(10);

        $feats = Feature::all();
        if (request()->ajax()) {
          $view = view('admins.features_listing', ['features' => $features]);
          return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
        }
        return view('admins.view_features', compact('features', 'feats'));
    }

    public function store_feature(Request $request)
    {
      $rules = array(
        'feature_name' => 'required',
        'feature_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        if($request->hasFile('feature_icon')){
          $file=$request->file('feature_icon')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
        }
        else{
          $image_path="";
        }
        $form_data = array(
          'id' => $id,
          'parent_feature_id' => $request->parent_feature_id,
          'feature_name' => $request->feature_name,
          'feature_icon' => $image_path
        );
        $feature_id = Feature::create($form_data);

        $feature = DB::table('features')
        ->leftjoin('features as parents', 'parents.id', '=', 'features.parent_feature_id')
        ->select('features.*', 'parents.feature_name as parent_feature_name')
        ->where('features.id', $feature_id->id)
        ->first();

        return response()->json($feature, 200);
      }
    }

    public function update_feature(Request $request)
    {
      $rules = array(
        'edit_feature_name' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        if($request->hasFile('edit_feature_icon')){
          $file=$request->file('edit_feature_icon')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];

          $feature = Feature::find($request->edit_fid);
          $feature->feature_icon = $image_path;
          $feature->save();
        }

        $feature_id = Feature::find($request->edit_fid);
        $feature_id->parent_feature_id = $request->edit_parent_feature_id;
        $feature_id->feature_name = $request->edit_feature_name;
        $feature_id->save();

        $feature = DB::table('features')
        ->leftjoin('features as parents', 'parents.id', '=', 'features.parent_feature_id')
        ->select('features.*', 'parents.feature_name as parent_feature_name')
        ->where('features.id', $feature_id->id)
        ->first();

        return response()->json($feature, 200);
      }
    }

    public function delete_feature(Request $request)
    {
      $feature = Feature::find($request->id)->delete();
      return response()->json("Feature Deleted Succssfully", 200);
    }

    public function create_new_business()
    {
      $businesses = DB::table('businesses')
      ->leftjoin('locations', 'locations.id', '=', 'businesses.location_id')
      ->leftjoin('categories', 'categories.id', '=', 'businesses.category_id')
      ->select('businesses.*', 'locations.location_name', 'categories.category_name')
      ->orderBy('updated_at', 'DESC')
      ->paginate(10);

      if (request()->ajax()) {
        $view = view('admins.businesses_listing', ['businesses' => $businesses]);
        return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
      }

      $categories = Category::all();
      $locations = Location::all();
      $features = Feature::all();
      return view('admins.view_businesses', compact('businesses', 'categories', 'locations', 'features'));
    }

    public function store_business(Request $request)
    {
      $rules = array(
        'name' => 'required',
        'category_id' => 'required',
        'location_id' => 'required',
        'business_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        if($request->hasFile('business_logo')){
          $file=$request->file('business_logo')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
        }
        else{
          $image_path="";
        }


        $form_data = array(
          'id' => $id,
          'category_id' => $request->category_id,
          'location_id' => $request->location_id,
          'name' => $request->name,
          'tagline' => $request->tagline,
          'description' => $request->description,
          'email' => $request->email,
          'mobile' => $request->mobile,
          'phone' => $request->phone,
          'whatsapp' => $request->whatsapp,
          'website_url' => $request->website_url,
          'facebook_url' => $request->facebook_url,
          'instagram_url' => $request->instagram_url,
          'linkedIn_url' => $request->linkedIn_url,
          'twitter_url' => $request->twitter_url,
          'youtube_channel_url' => $request->youtube_channel_url,
          'address' => $request->address,
          'geo_latitude' => $request->geo_latitude,
          'geo_longitude' => $request->geo_longitude,
          'geo_longitude' => $request->geo_longitude,
          'business_logo' => $image_path
        );
        $business = Business::create($form_data);
        $business_id = $business->id;

        if($request->hasFile('business_gallery')){
          $array = array();
          foreach($request->file('business_gallery') as $file)
          {
            array_push($array, $file->getClientOriginalName());

            $gallery_id = uniqid();
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $filename  = 'business-logo-' . time() . '.' . $extension;
            $size = $file->getSize();
            $size_kb = floor($size/1024);
            // $image=Storage::get($file);
            // Storage::put($file,$image);
            // $image_path=explode('/', $file);
            // $image_path=$image_path[1];
            $image_path = $file->store('public');

            $business_galley = new BusinessGallery();
            $business_galley->id = $gallery_id;
            $business_galley->business_id = $business_id;
            $business_galley->gallery_url = $image_path;
            $business_galley->gallery_name = $filename;
            $business_galley->gallery_type = $extension;
            $business_galley->gallery_size = $size_kb." KB";
            $business_galley->save();

          }
        }

        if(isset($request->features) && count($request->features) > 0){
          foreach ($request->features as $key => $value) {
            $feature_id = uniqid();
            $business_feature = new BusinessFeature();
            $business_feature->id = $feature_id;
            $business_feature->business_id = $business_id;
            $business_feature->feature_id = $value;
            $business_feature->save();
          }
        }

        if(isset($request->business_hours_data)){
          $hours_array = json_decode($request->business_hours_data);
          $BusinessHour_id = uniqid();
          $BusinessHour = new BusinessHour();
          $BusinessHour->id = $BusinessHour_id;
          $BusinessHour->business_id = $business_id;
          $BusinessHour->business_hours_json = $request->business_hours_data;
          $BusinessHour->from_monday = $hours_array[0]->timeFrom;
          $BusinessHour->to_monday = $hours_array[0]->timeTill;
          $BusinessHour->from_tuesday = $hours_array[1]->timeFrom;
          $BusinessHour->to_tuesday = $hours_array[1]->timeTill;
          $BusinessHour->from_wednesday = $hours_array[2]->timeFrom;
          $BusinessHour->to_wednesday = $hours_array[2]->timeTill;
          $BusinessHour->from_thursday = $hours_array[3]->timeFrom;
          $BusinessHour->to_thursday = $hours_array[3]->timeTill;
          $BusinessHour->from_friday = $hours_array[4]->timeFrom;
          $BusinessHour->to_friday = $hours_array[4]->timeTill;
          $BusinessHour->from_saturday = $hours_array[5]->timeFrom;
          $BusinessHour->to_saturday = $hours_array[5]->timeTill;
          $BusinessHour->from_sunday = $hours_array[6]->timeFrom;
          $BusinessHour->to_sunday = $hours_array[6]->timeTill;
          $BusinessHour->save();
        }

        return response()->json($business, 200);
      }
    }

    public function show_business($id){
      $business = DB::table('businesses')
      ->leftjoin('locations', 'locations.id', '=', 'businesses.location_id')
      ->leftjoin('categories', 'categories.id', '=', 'businesses.category_id')
      ->select('businesses.*', 'locations.location_name', 'locations.location_icon', 'categories.category_name',
       'categories.category_icon')
      ->where('businesses.id', $id)
      ->first();

      $business_features = DB::table('features')
      ->join('business_features', 'features.id', 'business_features.feature_id')
      ->select('features.*')
      ->where('business_features.business_id', $id)
      ->get()->toArray();

      $business_galleries = DB::table('business_galleries')
      ->select('business_galleries.*')
      ->where('business_id', $id)
      ->get()->toArray();

      $business_hours = DB::table('business_hours')
      ->select('business_hours.*')
      ->where('business_id', $id)
      ->get()->toArray();

      $business->business_galleries = $business_galleries;
      $business->business_features = $business_features;
      $business->business_hours = $business_hours;

      $categories = Category::all();
      $locations = Location::all();
      $features = Feature::all();

      return view('admins.show_business', compact('business', 'categories', 'locations', 'features'));
    }

    public function delete_business(Request $request)
    {
      $business = Business::find($request->id)->delete();
      return response()->json("Business Deleted Succssfully", 200);
    }
}
