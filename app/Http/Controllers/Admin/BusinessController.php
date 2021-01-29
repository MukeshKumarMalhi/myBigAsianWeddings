<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use DB;
use Excel;
use App\Country;
use App\Location;
use App\Category;
use App\Ethnicity;
use App\Feature;
use App\Business;
use App\BusinessGallery;
use App\BusinessHour;
use App\BusinessFeature;
use App\BusinessListing;
use App\BusinessListingAttribute;
use App\BusinessListingDetail;
use App\DataQuestion;
use App\DataAnswer;
use App\DataSection;
use App\SectionBusinessCategory;
use App\DataType;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function view_admin_dashboard()
    {
      return view('admins.admin_dashboard');
    }

    public function get_locations_admin(Request $request)
    {
      try {
          $locations = DB::table('locations')
              ->leftJoin('countries', 'countries.id', '=', 'locations.country_id')
              ->select('locations.id as location_id', 'locations.location_name', 'countries.id as country_id', 'countries.country_name')
              ->where('locations.location_name','like',"%{$request->input('query')}%")
              ->orderBy('locations.location_name', 'asc')
              ->take(5)
              ->get();

            return response()->json($locations, 200);
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Something is wrong'], 500);
        }
    }

    public function show_section($id)
    {
      $section = DB::table('data_sections')
      ->select('data_sections.*')
      ->where('data_sections.id', $id)
      ->first();

      $data_types = DataType::all();
      $questions = DB::table('data_questions')
      ->leftjoin('data_types', 'data_types.id', '=', 'data_questions.data_type_id')
      ->leftjoin('data_sections', 'data_sections.id', '=', 'data_questions.data_section_id')
      ->select('data_questions.*', 'data_types.type', 'data_sections.section_name')
      ->where('data_questions.data_section_id', '=', $id)
      ->orderBy('updated_at', 'desc')
      ->get();

      foreach ($questions as $key => $value) {
        $answers = DB::table('data_answers')
        ->select('data_answers.id as answer_id', 'data_answers.answer_name')
        ->where('data_answers.data_question_id', '=', $value->id)
        ->get()->toArray();
        $value->answers = $answers;
      }

      return view('admins.show_data_section', ['section' => $section, 'questions' => $questions, 'data_types' => $data_types]);
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

    public function view_ethnicities()
    {
        $ethnicities = DB::table('ethnicities')
        ->select('ethnicities.*')
        ->orderBy('updated_at', 'DESC')
        ->paginate(10);

        if (request()->ajax()) {
          $view = view('admins.ethnicities_listing', ['ethnicities' => $ethnicities]);
          return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
        }
        return view('admins.view_ethnicities', compact('ethnicities'));
    }

    public function store_ethnicity(Request $request)
    {
      $rules = array(
        'ethnicity_name' => 'required',
        'ethnicity_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        if($request->hasFile('ethnicity_icon')){
          $file=$request->file('ethnicity_icon')->store('public');
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
          'ethnicity_name' => $request->ethnicity_name,
          'ethnicity_icon' => $image_path
        );
        $ethnicity = Ethnicity::create($form_data);
        // $category = DB::table('ethnicities')
        // ->leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_category_id')
        // ->select('categories.*', 'parents.category_name as parent_category_name')
        // ->where('categories.id', $category_id->id)
        // ->first();
        return response()->json($ethnicity, 200);
      }
    }

    public function update_ethnicity(Request $request)
    {
      $rules = array(
        'edit_ethnicity_name' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        if($request->hasFile('edit_ethnicity_icon')){
          $file=$request->file('edit_ethnicity_icon')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
          $ethnicity = Ethnicity::find($request->edit_fid);
          $ethnicity->ethnicity_icon = $image_path;
          $ethnicity->save();
        }
        $ethnicity = Ethnicity::find($request->edit_fid);
        $ethnicity->ethnicity_name = $request->edit_ethnicity_name;
        $ethnicity->save();

        // $category = DB::table('categories')
        // ->leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_category_id')
        // ->select('categories.*', 'parents.category_name as parent_category_name')
        // ->where('categories.id', $category_id->id)
        // ->first();

        return response()->json($ethnicity, 200);
      }
    }

    public function delete_ethnicity(Request $request)
    {
      $ethnicity = Ethnicity::find($request->id)->delete();
      return response()->json("Ethnicity Deleted Succssfully", 200);
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

    public function view_data_section(){
      $cats = Category::where('parent_category_id', '=', null)->get();
      $sections = DB::table('data_sections')
      ->select('data_sections.*')
      ->orderBy('updated_at', 'DESC')
      ->get();

      foreach ($sections as $key => $value) {
        $categories = DB::table('section_business_categories')
        ->leftjoin('categories', 'categories.id', '=', 'section_business_categories.category_id')
        ->select('categories.id as category_id', 'categories.category_name')
        ->where('section_business_categories.data_section_id', '=', $value->id)
        ->get()->toArray();
        $value->categories = $categories;
      }
      return view('admins.data_section', ['cats' => $cats, 'sections' => $sections]);
    }

    public function store_data_section(Request $request){
      $rules = array(
        'section_name' => 'required',
        'categories' => 'required',
        'section_order' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        if(isset($request->section_basic_search)){
          $section_basic_search = true;
        }else {
          $section_basic_search = false;
        }

        if(isset($request->section_is_common)){
          $section_is_common = true;
        }else {
          $section_is_common = false;
        }

        if(isset($request->section_advance_search)){
          $section_advance_search = true;
        }else {
          $section_advance_search = false;
        }

        $id = uniqid();
        $form_data = array(
          'id' => $id,
          'section_name' => $request->section_name,
          'section_sub_heading' => $request->section_sub_heading,
          'section_order' => $request->section_order,
          'section_status' => true,
          'section_basic_search' => $section_basic_search,
          'section_advance_search' => $section_advance_search,
          'section_is_common' => $section_is_common
        );
        $section_id = DataSection::create($form_data);
        foreach ($request->categories as $key => $cate) {
          if($cate != null){
            $u_id = uniqid();
            $section_category_data = array(
              'id' => $u_id,
              'data_section_id' => $id,
              'category_id' => $cate
            );
            $section_cat = SectionBusinessCategory::create($section_category_data);
          }
        }
        return response()->json(['success' => 'Data section added successfully'], 200);
      }
    }

    public function store_data_question(Request $request){
      $rules = array(
        'question_name' => 'required',
        'data_type_id' => 'required',
        'question_order' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        if(isset($request->question_basic_search)){
          $question_basic_search = true;
        }else {
          $question_basic_search = false;
        }

        if(isset($request->question_is_common)){
          $question_is_common = true;
        }else {
          $question_is_common = false;
        }

        if(isset($request->question_advance_search)){
          $question_advance_search = true;
        }else {
          $question_advance_search = false;
        }

        if(isset($request->question_mandatory)){
          $question_mandatory = true;
        }else {
          $question_mandatory = false;
        }

        $id = uniqid();
        $form_data = array(
          'id' => $id,
          'data_type_id' => $request->data_type_id,
          'data_section_id' => $request->data_section_id,
          'question_name' => $request->question_name,
          'question_label' => $request->question_label,
          'question_placeholder' => $request->question_placeholder,
          'question_icon' => $request->question_icon,
          'question_mandatory' => $question_mandatory,
          'question_order' => $request->question_order,
          'question_status' => true,
          'question_basic_search' => $question_basic_search,
          'question_advance_search' => $question_advance_search,
          'question_is_common' => $question_is_common
        );
        $data_question_id = DataQuestion::create($form_data);
        foreach ($request->answer_name as $key => $cate) {
          if($cate != null){
            $u_id = uniqid();
            $data_answer = array(
              'id' => $u_id,
              'data_question_id' => $id,
              'answer_name' => $cate
            );
            $section_cat = DataAnswer::create($data_answer);
          }
        }
        return response()->json(['success' => 'Data question added successfully'], 200);
      }
    }

    public function update_data_section(Request $request){
      $rules = array(
        'edit_section_name' => 'required',
        'categories' => 'required',
        'edit_section_order' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        if(isset($request->edit_section_basic_search)){
          $edit_section_basic_search = true;
        }else {
          $edit_section_basic_search = false;
        }

        if(isset($request->edit_section_is_common)){
          $edit_section_is_common = true;
        }else {
          $edit_section_is_common = false;
        }

        if(isset($request->edit_section_status)){
          $edit_section_status = true;
        }else {
          $edit_section_status = false;
        }

        if(isset($request->edit_section_advance_search)){
          $edit_section_advance_search = true;
        }else {
          $edit_section_advance_search = false;
        }

        $data_section_id = DataSection::find($request->edit_fid);
        $data_section_id->section_name = $request->edit_section_name;
        $data_section_id->section_sub_heading = $request->edit_section_sub_heading;
        $data_section_id->section_order = $request->edit_section_order;
        $data_section_id->section_status = $edit_section_status;
        $data_section_id->section_basic_search = $edit_section_basic_search;
        $data_section_id->section_advance_search = $edit_section_advance_search;
        $data_section_id->section_is_common = $edit_section_is_common;
        $data_section_id->save();

        $deleted = SectionBusinessCategory::where('data_section_id',$request->edit_fid)->delete();

        foreach ($request->categories as $key => $cate) {
          if($cate != null){
            $u_id = uniqid();
            $section_category_data = array(
              'id' => $u_id,
              'data_section_id' => $request->edit_fid,
              'category_id' => $cate
            );
            $section_cat = SectionBusinessCategory::create($section_category_data);
          }
        }
        return response()->json(['success' => 'Data section updated successfully'], 200);
      }
    }

    public function update_data_question(Request $request){
      // dd($request->all());
      $rules = array(
        'edit_question_name' => 'required',
        'edit_question_order' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        if(isset($request->edit_question_basic_search)){
          $edit_question_basic_search = true;
        }else {
          $edit_question_basic_search = false;
        }

        if(isset($request->edit_question_is_common)){
          $edit_question_is_common = true;
        }else {
          $edit_question_is_common = false;
        }

        if(isset($request->edit_question_status)){
          $edit_question_status = true;
        }else {
          $edit_question_status = false;
        }

        if(isset($request->edit_question_mandatory)){
          $edit_question_mandatory = true;
        }else {
          $edit_question_mandatory = false;
        }

        if(isset($request->edit_question_advance_search)){
          $edit_question_advance_search = true;
        }else {
          $edit_question_advance_search = false;
        }

        $data_question_id = DataQuestion::find($request->edit_fid);
        $data_question_id->data_type_id = $request->edit_data_type_id;
        $data_question_id->question_name = $request->edit_question_name;
        $data_question_id->question_label = $request->edit_question_label;
        $data_question_id->question_placeholder = $request->edit_question_placeholder;
        $data_question_id->question_icon = $request->edit_question_icon;
        $data_question_id->question_mandatory = $edit_question_mandatory;
        $data_question_id->question_order = $request->edit_question_order;
        $data_question_id->question_status = $edit_question_status;
        $data_question_id->question_basic_search = $edit_question_basic_search;
        $data_question_id->question_advance_search = $edit_question_advance_search;
        $data_question_id->question_is_common = $edit_question_is_common;
        $data_question_id->save();


        if(isset($request->answer_id)){
          $refNumbers = $request->answer_name;
          $partIds    = $request->answer_id;
          $combined = array();
          foreach($refNumbers as $index => $refNumber) {
              if(!array_key_exists($index, $partIds)) {
                $partIds[$index] = null;
              }
              $combined[] = array(
                  'answer_name'  => $refNumber,
                  'answer_id' => $partIds[$index]
              );
          }

          foreach ($combined as $key => $value) {
            if($value['answer_name'] == null && $value['answer_id'] != null){
              $data_answer_delete = DataAnswer::find($value['answer_id'])->delete();
            }elseif ($value['answer_id'] == null && $value['answer_name'] != null) {
              $u_id = uniqid();
              $new_answer = array(
                'id' => $u_id,
                'data_question_id' => $request->edit_fid,
                'answer_name' => $value['answer_name']
              );
              $new_answer_data = DataAnswer::create($new_answer);
            }elseif ($value['answer_id'] != null && $value['answer_name'] != null) {
              $update_answer = DataAnswer::find($value['answer_id']);
              $update_answer->answer_name = $value['answer_name'];
              $update_answer->save();
            }
          }
        }

        return response()->json(['success' => 'Data question updated successfully'], 200);
      }
    }

    public function delete_section_data(Request $request)
    {
      $data_section_delete = DataSection::find($request->id)->delete();
      return response()->json("Data Section Deleted Succssfully", 200);
    }

    public function delete_question_data(Request $request)
    {
      $data_question_delete = DataQuestion::find($request->id)->delete();
      return response()->json("Data Question Deleted Succssfully", 200);
    }

    public function delete_business_listing(Request $request)
    {
      $data_question_delete = BusinessListing::find($request->id)->delete();
      return response()->json("Business Listing Deleted Succssfully", 200);
    }

    public function check_question_name_exists(Request $request)
    {
      $data_question_exists = DB::table('data_questions')->where('question_name', '=', $request->question_name)->get();
      if(count($data_question_exists) > 0){
        return response()->json('taken', 200);
      }else {
        return response()->json('not taken', 200);
      }
    }

    public function check_business_name_exists(Request $request)
    {
      $data_question_exists = DB::table('business_listings')->where('business_listings.name', '=', $request->question_name)->get();
      if(count($data_question_exists) > 0){
        return response()->json('taken', 200);
      }else {
        return response()->json('not taken', 200);
      }
    }



    public function store_data_type(){
      $id = uniqid();
      $form_data = array(
        'id' => $id,
        'type' => "password",
        'html_tag' => "<input type='password' class='form-control'>"
      );
      $data_type_id = DataType::create($form_data);
      return "done";
    }

    public function fill_section($id){
      $sections = DB::table('section_business_categories')
      ->leftJoin('data_sections', 'data_sections.id', '=', 'section_business_categories.data_section_id')
      ->leftJoin('categories', 'categories.id', '=', 'section_business_categories.category_id')
      ->select('section_business_categories.*', 'categories.category_name', 'data_sections.section_name', 'data_sections.section_sub_heading')
      ->where('categories.id', '=', $id)
      ->orderBy('data_sections.section_order', 'asc')
      ->get();

      foreach ($sections as $key => $value) {
        $questions = DB::table('data_questions')
        ->leftJoin('data_sections', 'data_sections.id', '=', 'data_questions.data_section_id')
        ->leftJoin('data_types', 'data_types.id', '=', 'data_questions.data_type_id')
        ->select('data_questions.*', 'data_types.type', 'data_types.html_tag')
        ->where('data_questions.data_section_id', '=', $value->data_section_id)
        ->orderBy('data_questions.question_order', 'asc')
        ->get()->toArray();

        foreach ($questions as $key => $val) {
          $answers = DB::table('data_answers')
          ->select('data_answers.id as answer_id', 'data_answers.answer_name')
          ->where('data_answers.data_question_id', '=', $val->id)
          ->get()->toArray();
          $val->answers = $answers;
        }

        $value->questions = $questions;
      }
      // dd($sections);
      return view('admins.fill_data_section', ['sections' => $sections]);
    }

    public function edit_data_submission($id, $cat_id){

      $category_id = DB::table('categories')->where('id', '=', $cat_id)->first();

      $form_category = "";
      $sub_category = "";
      if($category_id->parent_category_id != "" || $category_id->parent_category_id != null){
        $form_category = $category_id->parent_category_id;
        $sub_category = $category_id->id;
      }else {
        $form_category = $category_id->id;
      }

      $sections = DB::table('section_business_categories')
      ->leftJoin('data_sections', 'data_sections.id', '=', 'section_business_categories.data_section_id')
      ->leftJoin('categories', 'categories.id', '=', 'section_business_categories.category_id')
      ->select('section_business_categories.*', 'categories.category_name', 'data_sections.section_name', 'data_sections.section_sub_heading')
      ->where('categories.id', '=', $form_category)
      ->orderBy('data_sections.section_order', 'asc')
      ->get();

      foreach ($sections as $key => $value) {
        $questions = DB::table('data_questions')
        ->leftJoin('data_sections', 'data_sections.id', '=', 'data_questions.data_section_id')
        ->leftJoin('data_types', 'data_types.id', '=', 'data_questions.data_type_id')
        ->select('data_questions.*', 'data_types.type', 'data_types.html_tag')
        ->where('data_questions.data_section_id', '=', $value->data_section_id)
        ->orderBy('data_questions.question_order', 'asc')
        ->get()->toArray();

        foreach ($questions as $key => $val) {
          $answers = DB::table('data_answers')
          ->select('data_answers.id as answer_id', 'data_answers.answer_name')
          ->where('data_answers.data_question_id', '=', $val->id)
          ->get()->toArray();
          $val->answers = $answers;
        }

        foreach ($questions as $key => $valu) {
          $listings = DB::table('business_listing_attributes')
          ->select('business_listing_attributes.id as business_listing_attribute_id', 'business_listing_attributes.business_listing_id as business_listing_attribute_business_listing_id', 'business_listing_attributes.data_question_id as business_listing_attribute_data_question_id', 'business_listing_attributes.data_answer_id as business_listing_attribute_data_answer_id', 'business_listing_attributes.data_answer_text as business_listing_attribute_data_answer_text')
          ->where('business_listing_attributes.data_question_id', '=', $valu->id)
          ->where('business_listing_attributes.business_listing_id', '=', $id)
          ->get()->toArray();
          $valu->listings = $listings;
        }

        $business_listing = BusinessListing::find($id);
        $value->location_id = $business_listing->location_id;
        $value->questions = $questions;

      }
      $sub_categories = DB::table('categories')->where('parent_category_id', '=', $category_id->parent_category_id)->get()->toArray();
      return view('admins.edit_data_submission', ['sections' => $sections, 'business_listing_id' => $id, 'sub_category' => $sub_category, 'sub_categories' => $sub_categories]);
    }

    public function store_fill_section_form(Request $request){
      $rules = array(
        'business_name_answer_text' => 'required',
        'category_id' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{

        $id = uniqid();
        $form_data = array(
          'id' => $id,
          'category_id' => $request->category_id,
          'location_id' => $request->location_id,
          'name' => $request->business_name_answer_text,
        );

        $business_liting = BusinessListing::create($form_data);

        foreach ($request->all_names as $key => $name) {
          $items = $this->preg_array_key_exists('/^'.$name.'/i',$request->all());
          $u_id = uniqid();
          $data_attributes = array(
            'id' => $u_id,
            'business_listing_id' => $id
          );
          foreach ($items as $key => $item) {
            if(array_key_exists($item, $request->all())){
              // if(preg_match("/checkbox$/i", $item)){
              //   $data_attributes['data_question_id'] = $request->all()[$item];
              // }
              if(preg_match("/question_id$/i", $item)){
                $data_attributes['data_question_id'] = $request->all()[$item];
              }
              if(preg_match("/answer_id$/i", $item)){
                $data_attributes['data_answer_id'] = $request->all()[$item];
              }
              if(preg_match("/answer_text$/i", $item)){
                $data_attributes['data_answer_text'] = $request->all()[$item];
              }
            }
          }
          if(isset($data_attributes['data_question_id'])){
            if((isset($data_attributes['data_answer_text']) && $data_attributes['data_answer_text'] != null) || (isset($data_attributes['data_answer_id']) && $data_attributes['data_answer_id'] != null)){
              if(is_array($data_attributes['data_answer_id'])){
                foreach ($data_attributes['data_answer_id'] as $value) {
                  $uc_id = uniqid();
                  $data_attributes_checks = array(
                    'id' => $uc_id,
                    'business_listing_id' => $id,
                    'data_question_id' => $data_attributes['data_question_id'],
                    'data_answer_id' => $value,
                    'data_answer_text' => $data_attributes['data_answer_text']
                  );
                  $business_liting_attributes = BusinessListingAttribute::create($data_attributes_checks);
                }
              }
              elseif(is_array($data_attributes['data_answer_text'])) {
                foreach ($data_attributes['data_answer_text'] as $file) {
                  $file1=$file->store('public');
                  $image=Storage::get($file1);
                  Storage::put($file1,$image);
                  $image_path=explode('/', $file1);
                  $image_path=$image_path[1];
                  $up_id = uniqid();
                  $data_attributes_photos = array(
                    'id' => $up_id,
                    'business_listing_id' => $id,
                    'data_question_id' => $data_attributes['data_question_id'],
                    'data_answer_id' => $data_attributes['data_answer_id'],
                    'data_answer_text' => $image_path
                  );
                  $business_liting_attributes = BusinessListingAttribute::create($data_attributes_photos);
                }
              }
              else {
                $business_liting_attributes = BusinessListingAttribute::create($data_attributes);
              }
            }
          }
        }
        $details_id = uniqid();
        $details_form_data = array(
          'id' => $details_id,
          'business_listing_id' => $id,
          'created_user_id' => Auth::user()->id,
          'updated_user_id' => null,
          'created_by_user' => Auth::user()->name,
          'updated_by_user' => null
        );

        $business_listing_details = BusinessListingDetail::create($details_form_data);
        return response()->json(['success' => 'Business listing attributes added successfully'], 200);
      }
    }

    public function update_fill_section_form(Request $request){
      $rules = array(
        'business_listing_id' => 'required',
        'category_id' => 'required'
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{

        $business_liting_update = BusinessListing::find($request->business_listing_id);
        $business_liting_update->name = $request->updated_business_name_answer_text_updated;
        $business_liting_update->location_id = $request->location_id;
        $business_liting_update->save();

        foreach ($request->all_names as $key => $name) {
          $items = $this->preg_array_key_exists('/^'.$name.'/i',$request->all());
          $u_id = uniqid();
          $data_attributes = array(
            'id' => $u_id,
            'business_listing_id' => $request->business_listing_id
          );
          foreach ($items as $key => $item) {
            if(array_key_exists($item, $request->all())){
              // if(preg_match("/checkbox$/i", $item)){
              //   $data_attributes['data_question_id'] = $request->all()[$item];
              // }
              if(preg_match("/question_id$/i", $item)){
                $data_attributes['data_question_id'] = $request->all()[$item];
              }
              if(preg_match("/answer_id$/i", $item)){
                $data_attributes['data_answer_id'] = $request->all()[$item];
              }
              if(preg_match("/answer_text$/i", $item)){
                $data_attributes['data_answer_text'] = $request->all()[$item];
              }
            }
          }
          if(isset($data_attributes['data_question_id'])){
            if((isset($data_attributes['data_answer_text']) && $data_attributes['data_answer_text'] != null) || (isset($data_attributes['data_answer_id']) && $data_attributes['data_answer_id'] != null)){
              if(is_array($data_attributes['data_answer_id'])){
                foreach ($data_attributes['data_answer_id'] as $value) {
                  $uc_id = uniqid();
                  $data_attributes_checks = array(
                    'id' => $uc_id,
                    'business_listing_id' => $request->business_listing_id,
                    'data_question_id' => $data_attributes['data_question_id'],
                    'data_answer_id' => $value,
                    'data_answer_text' => $data_attributes['data_answer_text']
                  );
                  $business_liting_attributes = BusinessListingAttribute::create($data_attributes_checks);
                }
              }
              elseif(is_array($data_attributes['data_answer_text'])) {
                foreach ($data_attributes['data_answer_text'] as $file) {
                  $file1=$file->store('public');
                  $image=Storage::get($file1);
                  Storage::put($file1,$image);
                  $image_path=explode('/', $file1);
                  $image_path=$image_path[1];
                  $up_id = uniqid();
                  $data_attributes_photos = array(
                    'id' => $up_id,
                    'business_listing_id' => $request->business_listing_id,
                    'data_question_id' => $data_attributes['data_question_id'],
                    'data_answer_id' => $data_attributes['data_answer_id'],
                    'data_answer_text' => $image_path
                  );
                  $business_liting_attributes = BusinessListingAttribute::create($data_attributes_photos);
                }
              }
              else {
                $business_liting_attributes = BusinessListingAttribute::create($data_attributes);
              }
            }
          }
        }

        foreach ($request->all_names_updated as $key => $name) {
          $items = $this->preg_array_key_exists('/^'.$name.'/i',$request->all());
          $data_attributes = array();
          foreach ($items as $key => $item) {
            if(array_key_exists($item, $request->all())){
              // if(preg_match("/checkbox$/i", $item)){
              //   $data_attributes['data_question_id'] = $request->all()[$item];
              // }
              if(preg_match("/question_id_updated$/i", $item)){
                $data_attributes['data_question_id'] = $request->all()[$item];
              }
              if(preg_match("/answer_id_updated$/i", $item)){
                $data_attributes['data_answer_id'] = $request->all()[$item];
              }
              if(preg_match("/answer_text_updated$/i", $item)){
                $data_attributes['data_answer_text'] = $request->all()[$item];
              }
              if(preg_match("/business_listing_id_updated/i", $item)){
                $data_attributes['business_listing_id'] = $request->all()[$item];
              }
              if(preg_match("/business_listing_attribute_id_updated/i", $item)){
                $data_attributes['id'] = $request->all()[$item];
              }
            }
          }
          if(isset($data_attributes['data_question_id'])){
            if((isset($data_attributes['data_answer_text']) && $data_attributes['data_answer_text'] != null) || (isset($data_attributes['data_answer_id']) && $data_attributes['data_answer_id'] != null)){
              if(is_array($data_attributes['data_answer_id']) && count($data_attributes['data_answer_id']) == 1){
                foreach ($data_attributes['data_answer_id'] as $value) {
                  $data_attributes_checks = array(
                    'id' => $data_attributes['id'],
                    'business_listing_id' => $request->business_listing_id,
                    'data_question_id' => $data_attributes['data_question_id'],
                    'data_answer_id' => $value,
                    'data_answer_text' => $data_attributes['data_answer_text']
                  );
                  $business_liting_attributes_checks = BusinessListingAttribute::find($data_attributes_checks['id']);
                  $business_liting_attributes_checks->data_answer_id = $data_attributes_checks['data_answer_id'];
                  $business_liting_attributes_checks->save();
                  // $business_liting_attributes = BusinessListingAttribute::create($data_attributes_checks);
                }
              }
              elseif(is_array($data_attributes['data_answer_id']) && count($data_attributes['data_answer_id']) > 1){
                $deleted = BusinessListingAttribute::where('data_question_id', '=', $data_attributes['data_question_id'])->delete();
                foreach ($data_attributes['data_answer_id'] as $value) {
                  $uc2_id = uniqid();
                  $data_attributes_checks = array(
                    'id' => $uc2_id,
                    'business_listing_id' => $request->business_listing_id,
                    'data_question_id' => $data_attributes['data_question_id'],
                    'data_answer_id' => $value,
                    'data_answer_text' => $data_attributes['data_answer_text']
                  );
                  $business_liting_attributes = BusinessListingAttribute::create($data_attributes_checks);
                }
              }
              else {
                $business_liting_attributes = BusinessListingAttribute::find($data_attributes['id']);
                $business_liting_attributes->data_answer_text = $data_attributes['data_answer_text'];
                $business_liting_attributes->save();
              }
            }
          }
        }

        $update_details_check = DB::table('business_listing_details')->where('business_listing_id', $request->business_listing_id)->first();
        if($update_details_check != null){
          $update_details = DB::table('business_listing_details')->where('business_listing_id', $request->business_listing_id)->update(['updated_user_id' => Auth::user()->id, 'updated_by_user' => Auth::user()->name]);
        }else {
          $details_id = uniqid();
          $details_form_data = array(
            'id' => $details_id,
            'business_listing_id' => $request->business_listing_id,
            'created_user_id' => null,
            'updated_user_id' => Auth::user()->id,
            'created_by_user' => null,
            'updated_by_user' => Auth::user()->name
          );

          $business_listing_details = BusinessListingDetail::create($details_form_data);
        }


        return response()->json(['success' => 'Business listing attributes updated successfully'], 200);
      }
    }

    public function delete_single_submission_image(Request $request){
      $delete_image = BusinessListingAttribute::find($request->id)->delete();
      return response()->json("Photo Deleted Succssfully", 200);
    }

    public function view_data_submissions(Request $request, $slug = null){

      $values = explode("/", $slug);
      $get_cats = explode("-", $values[0]);

      $got_cat = "";
      foreach ($get_cats as $key => $cat) {
        if($key > 0){
          if($cat == "and"){
            $got_cat .= $cat." ";
          }else {
            $got_cat .= ucfirst($cat." ");
          }
        }
      }

      $loc_for_search = "";
      $eth_for_search = "";
      if(count($values) > 1){
        $loc_for_search = preg_replace('/(?<!\s)-(?!\s)/', ' ', $values[1]);
      }

      if(count($values) == 3){
        $eth_for_search = preg_replace('/(?<!\s)-(?!\s)/', ' ', $values[2]);
      }
      $cat_for_search = trim($got_cat);

      $category_id = DB::table('categories')->where('category_name', '=', $cat_for_search)->first();
      $location_id = DB::table('locations')->where('location_name', '=', $loc_for_search)->first();
      $ethnicity_id = DB::table('ethnicities')->where('ethnicity_name', '=', $eth_for_search)->first();

      $array_values = array();
      foreach ($values as $key => $value) {
        $result = preg_replace('/(?<!\s)-(?!\s)/', ' ', $value);
        array_push($array_values, $result);
      }

      $keyword_for_search = "";
      $keyword_for_search = preg_replace('/(?<!\s)-(?!\s)/', ' ', $request->search_by_keyword);

      $sorttype = $request->get('sort_type');
      $date = new DateTime();
      unset($array_values[0]);
      $array_values = array_values($array_values);

      $business_is_null = "";
      $location_is_null = "";
      $category_is_null = "";
      $ethnicity_is_null = "";
      $postcode_is_null = "";

      if(isset($request->postcode) && $request->postcode == "is_null"){
        $postcode_is_null = $request->postcode;
      }
      if(isset($request->name) && $request->name == "is_null"){
        $business_is_null = $request->name;
      }
      if(isset($request->location) && $request->location == "is_null"){
        $location_is_null = $request->location;
      }
      if(isset($request->category) && $request->category == "is_null"){
        $category_is_null = $request->category;
      }
      if(isset($request->ethnicity) && $request->ethnicity == "is_null"){
        $ethnicity_is_null = $request->ethnicity;
      }

      $submissions = DB::table('business_listings')
      ->leftJoin('categories', 'categories.id', '=', 'business_listings.category_id')
      ->leftJoin('locations', 'locations.id', '=', 'business_listings.location_id')
      ->leftJoin('ethnicities', 'ethnicities.id', '=', 'business_listings.ethnicity_id')
      ->leftJoin('business_listing_details', 'business_listing_details.business_listing_id', '=', 'business_listings.id')
      ->select('business_listings.*', 'categories.category_name', 'locations.location_name', 'ethnicities.ethnicity_name', 'business_listing_details.created_by_user', 'business_listing_details.updated_by_user');

      $diff = DB::table('business_listings')
      ->leftJoin('categories', 'categories.id', '=', 'business_listings.category_id')
      ->leftJoin('locations', 'locations.id', '=', 'business_listings.location_id')
      ->leftJoin('ethnicities', 'ethnicities.id', '=', 'business_listings.ethnicity_id')
      ->leftJoin('business_listing_details', 'business_listing_details.business_listing_id', '=', 'business_listings.id')
      ->select('business_listings.*', 'categories.category_name', 'locations.location_name', 'ethnicities.ethnicity_name', 'business_listing_details.created_by_user', 'business_listing_details.updated_by_user')
      ->orderBy('business_listings.updated_at', 'asc')->get()->toArray();

      if($category_id != null){
        $submissions->where('business_listings.category_id', '=', $category_id->id);
      }
      if($location_id != null){
        $submissions->where('business_listings.location_id', '=', $location_id->id);
      }
      if($ethnicity_id != null){
        $submissions->where('business_listings.ethnicity_id', '=', $ethnicity_id->id);
      }
      if($keyword_for_search != ""){
        $submissions->leftJoin('business_listing_attributes', 'business_listing_attributes.business_listing_id', '=', 'business_listings.id')
        ->where('business_listing_attributes.data_answer_text', 'LIKE', '%'.$keyword_for_search.'%');
      }
      if($postcode_is_null != ""){
        $submissions = $submissions->leftJoin('business_listing_attributes', 'business_listing_attributes.business_listing_id', '=', 'business_listings.id')
        ->where('business_listing_attributes.data_question_id', '=', '5f84645f4edda')
        ->orderBy('business_listings.updated_at', 'asc')
        ->get()->toArray();
        // $arr1 =  (array) $diff;
        // $arr2 =  (array) $submissions;
        $submissions = array_diff_key($diff, $submissions);
        // dd($submissions);
        // $big_array = array();
        // foreach ($diff as $key => $value) {
        //   foreach ($submissions as $key => $value2) {
        //     if($value->id == $value2->id){
        //       continue;
        //     }else {
        //       array_push($big_array, $value);
        //     }
        //   }
        // }
        // dd($big_array);
        // $submissions = $big_array;
      }
      if($business_is_null != ""){
        $submissions->where('business_listings.name', '=', null);
      }
      if($category_is_null != ""){
        $submissions->where('business_listings.category_id', '=', null);
      }
      if($location_is_null != ""){
        $submissions->where('business_listings.location_id', '=', null);
      }
      if($ethnicity_is_null != ""){
        $submissions->where('business_listings.ethnicity_id', '=', null);
      }
      if($postcode_is_null == ""){
        $submissions = $submissions->orderBy('business_listings.updated_at', 'desc')->get();
      }

      $cats = DB::table('categories')->where('parent_category_id', null)->get();
      $ethnicities = Ethnicity::all();

      $count = count($submissions);

      $paginator="false";
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $itemCollection = collect($submissions);
      $perPage = 30;
      $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
      $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
      $paginatedItems->setPath($request->url());

      return view('admins.data_submission', [
        'cats' => $cats,
        'count' => $count,
        'ethnicities' => $ethnicities,
        'submissions' => $paginatedItems,
        'search_location' => $loc_for_search,
        'category_search' => $cat_for_search,
        'ethnicity_search' => $eth_for_search,
        'keyword_search' => $keyword_for_search,
        'postcode_is_null' => $postcode_is_null,
        'category_is_null' => $category_is_null,
        'location_is_null' => $location_is_null,
        'ethnicity_is_null' => $ethnicity_is_null,
        'business_is_null' => $business_is_null
      ]);
    }

    public function update_category_data_submission(Request $request){
      $update_category_business_listing = BusinessListing::find($request->business_listing_id);
      $update_category_business_listing->category_id = $request->category_id;
      $update_category_business_listing->save();
      return response()->json("Category Updated Succssfully", 200);
    }

    public function update_ethnicity_data_submission(Request $request){
      $update_ethnicity_business_listing = BusinessListing::find($request->business_listing_id);
      $update_ethnicity_business_listing->ethnicity_id = $request->ethnicity_id;
      $update_ethnicity_business_listing->save();
      return response()->json("Ethnicity Updated Succssfully", 200);
    }
}
