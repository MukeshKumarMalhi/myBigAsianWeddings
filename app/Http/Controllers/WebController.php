<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Category;
use App\Location;
use App\Business;
use App\Shortlist;
use App\Message;
use App\MessageFile;
use App\BusinessListing;
use App\BusinessListingAttribute;
use App\BusinessListingDetail;
use App\DataQuestion;
use App\DataAnswer;
use App\DataSection;
use App\SectionBusinessCategory;
use App\DataType;
use App\Feedback;
use App\Mail\TestEmail;
use App\Mail\SubscribeEmail;
use App\Mail\IntrestedInGraphicsDesignEmail;
use DB;
use Validator;
use DateTime;
use Session;
use Redirect;
use File;
use Illuminate\Pagination\LengthAwarePaginator;

class WebController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function file_existance()
  {
    // $images_array = BusinessListingAttribute::where('data_question_id', '5f8d3be32c273')->get()->toArray();
    $images_array = BusinessListingAttribute::where('data_question_id', '5f8d3be32c273')->orWhere('data_question_id', '5f8466a7bd776')->pluck('data_answer_text')->toArray();
    foreach ($images_array as $key => $image) {
      if(substr( $image, 0, 4 ) === "http"){
        $exploded_image = explode('/',$image);
        $exploded_image_year = $exploded_image[5];
        $exploded_image_month = $exploded_image[6];
        $exploded_image_name = $exploded_image[7];

        $image_name_with_directory = 'wp-content/uploads/'.$exploded_image_year.'/'.$exploded_image_month.'/'.$exploded_image_name;
        $image_name_with_new_directory = 'wp-content/uploads/'.$exploded_image_year.'/'.$exploded_image_month.'/'.'new/'.$exploded_image_name;
        if(file_exists(public_path($image_name_with_directory))){
          File::move(public_path($image_name_with_directory), public_path($image_name_with_new_directory));
        }
      }
    }
    dd('moved');
    // dd(30801+10229);
    // if(file_exists(public_path('wp-content/uploads/2020/01/3.jpg'))){
    //   File::move(public_path('wp-content/uploads/2020/01/3.jpg'), public_path('wp-content/uploads/2020/01/new/3.jpg'));
    //   // unlink(public_path('upload/bio.png'));
    //   dd('Yes, File exists');
    // }else{
    //   dd('File does not exists.');
    // }
  }

  public function send_test_email()
  {
    $data = ['message' => '2nd Testing Email Sending', 'useremail' => 'mukeshkumarmalhi7731@gmail.com', 'username' => 'Qadir Khan', 'subject' => 'MyBigAsianWedding'];

    Mail::to('shahzebmehmood99@gmail.com')->queue(new TestEmail($data));
    // Mail::send('emails.test', ['data' => $data], function ($message) use ($data) {
    //     $message->from($data['useremail'], $data['username']);
    //     $message->to('fayyaz@cospace.pk' , 'Autohaven Motors')->subject($data['subject']);
    // });

    return "mail send successfully";
  }

  public function store_subscription_send_mail(Request $request)
  {
    $rules = array(
      'full_name' => 'required|max:255|string',
      'email' => 'required|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^|email'
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{
      Mail::to('omar@mybigasianwedding.co.uk')->queue(new SubscribeEmail($request->all()));
      if( count(Mail::failures()) > 0 ) {
        $failures_array = array();
        foreach(Mail::failures as $email_subscribe) {
          $failures_array[] = $email_subscribe;
          return response()->json(['failure' => $failures_array], 500);
        }
      } else {
        return response()->json(['success' => 'Subscribed Successfully'], 200);
      }
    }
  }

  public function privacy_policy(){
    view('website.privacy_policy');
  }

  public function terms_conditions(){
    view('website.terms_conditions');
  }

  public function store_intrested_in_graphics_desgin_send_mail(Request $request)
  {
    $rules = array(
      'full_name' => 'required|max:255|string',
      'email' => 'required|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^|email',
      'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|numeric',
      'intrested_in' => 'required',
      'intrested_in.*' => 'in:Logo Design,Brand Identity Design,Leaflet / Flyer Design'
    );
    ///^([0-9\s\-\+\(\)]*)$/

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{
      Mail::to('omar@mybigasianwedding.co.uk')->queue(new IntrestedInGraphicsDesignEmail($request->all()));
      if( count(Mail::failures()) > 0 ) {
        $failures_array = array();
        foreach(Mail::failures as $email_subscribe) {
          $failures_array[] = $email_subscribe;
          return response()->json(['failure' => $failures_array], 500);
        }
      } else {
        return response()->json(['success' => 'Data Stored Successfully'], 200);
      }
    }
  }

  public function index()
  {
    $total_listings = BusinessListing::count();

    $featured_listings = DB::table('business_listings')
    ->leftJoin('categories', 'business_listings.category_id', '=', 'categories.id')
    ->leftJoin('locations', 'business_listings.location_id', '=', 'locations.id')
    ->leftJoin('business_listing_attributes', 'business_listing_attributes.business_listing_id', '=', 'business_listings.id')
    ->select('business_listings.*', 'categories.category_name', 'locations.location_name')
    ->where('business_listing_attributes.data_question_id', '=', '6019367f6c9df')
    ->orderBy('business_listings.updated_at', 'desc')
    ->groupBy('business_listings.id')
    ->get()
    ->toArray();

    foreach ($featured_listings as $key => $listing) {
      $business_listing_attributes = DB::table('business_listing_attributes')
      ->select('business_listing_attributes.*')
      ->where('business_listing_attributes.business_listing_id', '=', $listing->id)
      ->get();

      foreach ($business_listing_attributes as $key => $value) {
        $listing_attribute = DB::table('business_listing_attributes')
        ->leftJoin('data_answers', 'data_answers.id', 'business_listing_attributes.data_answer_id')
        ->leftJoin('data_questions', 'data_questions.id', 'business_listing_attributes.data_question_id')
        ->select('business_listing_attributes.*', 'data_answers.answer_name', 'data_questions.question_name')
        ->where('business_listing_attributes.business_listing_id', '=', $listing->id)
        ->where('business_listing_attributes.data_question_id', '=', $value->data_question_id)
        ->get()
        ->toArray();
        if($value->data_answer_text == null && $value->data_answer_id != null){
          $attribute_id = $listing_attribute[0]->question_name;
          $array_answers = array();
          foreach ($listing_attribute as $key => $value_attribute) {
            $answer = DataAnswer::find($value_attribute->data_answer_id);
            array_push($array_answers, $answer->answer_name);
          }
          $listing->$attribute_id = $array_answers;

        }else {
          $attribute_text = $listing_attribute[0]->question_name;
          $listing->$attribute_text = $value->data_answer_text;
        }
      }
    }
    $categories = DB::table('categories')->where('parent_category_id', null)->orderBy('category_name','asc')->pluck('category_name')->toArray();
    // return view('landing.index', ['total_listings' => $total_listings]);
    return view('website.index', ['total_listings' => $total_listings, 'featured_listings' => $featured_listings, 'categories' => $categories]);

  }
  public function business_congratulations_page()
  {
    return view('landing.congratulation');
  }

  public function business_register_page()
  {
    $sections = DB::table('data_sections')
    ->select('data_sections.*')
    ->where('data_sections.section_is_common', '=', true)
    ->where('data_sections.section_is_common', '!=', false)
    ->orderBy('data_sections.section_order', 'asc')
    ->get();

    foreach ($sections as $key => $value) {
      $questions = DB::table('data_questions')
      ->leftJoin('data_sections', 'data_sections.id', '=', 'data_questions.data_section_id')
      ->leftJoin('data_types', 'data_types.id', '=', 'data_questions.data_type_id')
      ->select('data_questions.*', 'data_types.type', 'data_types.html_tag')
      ->where('data_questions.data_section_id', '=', $value->id)
      ->where('data_questions.question_is_common', '=', true)
      ->where('data_questions.question_is_common', '!=', false)
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
    $categories = DB::table('categories')->where('parent_category_id', null)->get();
    $sub_categories = DB::table('categories')->where('parent_category_id', '!=', null)->get();
    return view('landing.business_register', ['sections' => $sections, 'categories' => $categories, 'sub_categories' => $sub_categories]);
  }

  public function business_register_page_two($category, $slug, $id)
  {
    $get_cats = explode("-", $category);

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
    $cat_for_search = trim($got_cat);
    $category_id = DB::table('categories')->where('category_name', '=', $cat_for_search)->first();
    $form_category = "";
    if($category_id->parent_category_id != "" || $category_id->parent_category_id != null){
      $form_category = $category_id->parent_category_id;
    }else {
      $form_category = $category_id->id;
    }

    $business_listing_id = DB::table('business_listings')
    ->leftJoin('categories', 'business_listings.category_id', '=', 'categories.id')
    ->leftJoin('business_listing_attributes', 'business_listings.id', '=', 'business_listing_attributes.business_listing_id')
    ->select('business_listings.id as business_listing_id');

    if($category_id != null){
      $business_listing_id->where('business_listings.category_id', '=', $category_id->id);
    }
    if($id != ""){
      $business_listing_id->where('business_listings.id', '=', $id);
    }
    if($id == "" && $slug != ""){
      $business_listing_id->where('business_listing_attributes.data_answer_text', '=', $slug);
    }

    $business_listing_id = $business_listing_id->first();

    $sections = DB::table('section_business_categories')
    ->leftJoin('data_sections', 'data_sections.id', '=', 'section_business_categories.data_section_id')
    ->leftJoin('categories', 'categories.id', '=', 'section_business_categories.category_id')
    ->select('data_sections.*', 'categories.category_name')
    ->where('section_business_categories.category_id', '=', $form_category)
    ->where('data_sections.section_is_common', '=', false)
    ->where('data_sections.section_is_common', '!=', true)
    ->orderBy('data_sections.section_order', 'asc')
    ->get();


    foreach ($sections as $key => $value) {
      $questions = DB::table('data_questions')
      ->leftJoin('data_sections', 'data_sections.id', '=', 'data_questions.data_section_id')
      ->leftJoin('data_types', 'data_types.id', '=', 'data_questions.data_type_id')
      ->select('data_questions.*', 'data_types.type', 'data_types.html_tag')
      ->where('data_questions.data_section_id', '=', $value->id)
      ->where('data_questions.question_is_common', '=', false)
      ->where('data_questions.question_is_common', '!=', true)
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
    return view('landing.business_register_page_two', ['sections' => $sections, 'category_set' => $category, 'slug' => $slug, 'business_listing_id' => $business_listing_id->business_listing_id]);
  }

  public function business_register_page_one_back($category, $slug, $id)
  {
    $get_cats = explode("-", $category);

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
    $cat_for_search = trim($got_cat);
    $category_id = DB::table('categories')->where('category_name', '=', $cat_for_search)->first();

    $form_category = "";
    $sub_category = "";
    if($category_id->parent_category_id != "" || $category_id->parent_category_id != null){
      $form_category = $category_id->parent_category_id;
      $sub_category = $category_id->id;
    }else {
      $form_category = $category_id->id;
    }

    $business_listing_id = DB::table('business_listings')
    ->leftJoin('categories', 'business_listings.category_id', '=', 'categories.id')
    ->leftJoin('business_listing_attributes', 'business_listings.id', '=', 'business_listing_attributes.business_listing_id')
    ->select('business_listings.id as business_listing_id');

    if($category_id != null){
      $business_listing_id->where('business_listings.category_id', '=', $category_id->id);
    }
    if($id != ""){
      $business_listing_id->where('business_listings.id', '=', $id);
    }
    if($id == "" && $slug != ""){
      $business_listing_id->where('business_listing_attributes.data_answer_text', '=', $slug);
    }

    $business_listing_id = $business_listing_id->first();

    $sections = DB::table('section_business_categories')
    ->leftJoin('data_sections', 'data_sections.id', '=', 'section_business_categories.data_section_id')
    ->leftJoin('categories', 'categories.id', '=', 'section_business_categories.category_id')
    ->select('section_business_categories.*', 'categories.category_name', 'data_sections.section_name', 'data_sections.section_sub_heading')
    ->where('categories.id', '=', $form_category)
    ->where('data_sections.section_is_common', '=', true)
    ->where('data_sections.section_is_common', '!=', false)
    ->orderBy('data_sections.section_order', 'asc')
    ->get();

    foreach ($sections as $key => $value) {
      $questions = DB::table('data_questions')
      ->leftJoin('data_sections', 'data_sections.id', '=', 'data_questions.data_section_id')
      ->leftJoin('data_types', 'data_types.id', '=', 'data_questions.data_type_id')
      ->select('data_questions.*', 'data_types.type', 'data_types.html_tag')
      ->where('data_questions.data_section_id', '=', $value->data_section_id)
      ->where('data_questions.question_is_common', '=', true)
      ->where('data_questions.question_is_common', '!=', false)
      ->orderBy('data_questions.question_order', 'asc')
      ->get()
      ->toArray();

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
        ->where('business_listing_attributes.business_listing_id', '=', $business_listing_id->business_listing_id)
        ->get()
        ->toArray();
        $valu->listings = $listings;
      }

      $business_listing = BusinessListing::find($business_listing_id->business_listing_id);
      $value->location_id = $business_listing->location_id;
      $value->questions = $questions;

    }
    $categories = DB::table('categories')->where('parent_category_id', null)->get();
    $sub_categories = DB::table('categories')->where('parent_category_id', '=', $category_id->parent_category_id)->get()->toArray();
    return view('landing.business_register_page_one_back', ['sections' => $sections, 'business_listing_id' => $business_listing_id->business_listing_id, 'categories' => $categories, 'slug' => $slug, 'category_set' => $category, 'sub_category' => $sub_category, 'sub_categories' => $sub_categories]);
  }

  public function check_business_name_exists_step1(Request $request)
  {
    $data_question_exists = DB::table('business_listings')->where('business_listings.name', '=', $request->question_name)->get();
    if(count($data_question_exists) > 0){
      return response()->json('taken', 200);
    }else {
      return response()->json('not taken', 200);
    }
  }



  // public function preg_array_key_exists($pattern, $array) {
  //   $keys = array_keys($array);
  //   $item = preg_grep($pattern,$keys);
  //   return $item;
  // }

  public function serach_sub_category_exists(Request $request) {
    $sub_categories = DB::table('categories')->where('parent_category_id', '=', $request->category_id)->get()->toArray();
    if(count($sub_categories) > 0){
      $options = '<option value="">Select Sub Category</option>';
      foreach ($sub_categories as $key => $value) {
        $options .= '<option value="'.$value->id.'">'.$value->category_name.'</option>';
      }
      return response()->json(['sub_categories' => $options], 200);
    }else {
      return response()->json(['sub_categories' => 'no_sub_categories_exists'], 200);
    }
  }



  public function store_business_register_data(Request $request)
  {
    $rules = array(
      'business_name_answer_text' => 'required|unique:business_listings,name|max:255',
      'email_answer_text' => 'required|string|email|max:255',
      'password_answer_text' => 'required|min:6'
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{
      $category = $request->category_id;
      if(isset($request->sub_category_id) && $request->sub_category_id != ""){
        $category = $request->sub_category_id;
      }

      $id = uniqid();
      $form_data = array(
        'id' => $id,
        'category_id' => $category,
        'location_id' => $request->location_id,
        'name' => $request->business_name_answer_text,
        'email' => $request->email_answer_text,
        'password' => Hash::make($request->password_answer_text),
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
          'created_user_id' => null,
          'updated_user_id' => null,
          'created_by_user' => 'Website User',
          'updated_by_user' => null
        );

        $business_listing_details = BusinessListingDetail::create($details_form_data);
      return response()->json(['success' => 'Business registered successfully', 'business_listing_id' => $id], 200);
    }
  }

  public function update_business_register_data(Request $request)
  {
    $rules = array(
      'business_listing_id' => 'required',
      'category_id' => 'required'
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{
      $category = $request->category_id;
      if(isset($request->sub_category_id) && $request->sub_category_id != ""){
        $category = $request->sub_category_id;
      }

      $business_liting_update = BusinessListing::find($request->business_listing_id);
      $business_liting_update->name = $request->updated_business_name_answer_text_updated;
      $business_liting_update->location_id = $request->location_id;
      $business_liting_update->category_id = $category;
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

      return response()->json(['success' => 'Business updated successfully'], 200);
    }
  }

  public function store_business_register_data_step_two(Request $request)
  {
    $rules = array(
      'business_listing_id' => 'required'
    );

    $error = Validator::make($request->all(), $rules);
    if($error->fails()){
      return response()->json(['errors' => $error->errors()->all()]);
    }else{

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
      return response()->json(['success' => 'Business registered successfully'], 200);
    }
  }



  // public function index()
  // {
  //   $categories = DB::table('categories')->where('parent_category_id', null)->get();
  //   $locations = DB::table('locations')->get();
  //   return view('auth.index', ['categories' => $categories, 'locations' => $locations]);
  // }

  public function delete_single_submission_image_step_one(Request $request)
  {
    $delete_image = BusinessListingAttribute::find($request->id)->delete();
    return response()->json("Photo Deleted Succssfully", 200);
  }

  public function get_locations(Request $request)
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

  public function show_detail_page(Request $request, $type, $name){
    $get_cats = explode("-", $type);

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
    $cat_for_search = trim($got_cat);

    $category_id = DB::table('categories')->where('category_name', '=', $cat_for_search)->first();

    $business_listing_details = DB::table('business_listings')
    ->leftJoin('categories', 'business_listings.category_id', '=', 'categories.id')
    ->leftJoin('locations', 'business_listings.location_id', '=', 'locations.id')
    ->leftJoin('business_listing_attributes', 'business_listings.id', '=', 'business_listing_attributes.business_listing_id')
    ->leftJoin('data_answers', 'business_listing_attributes.data_answer_id', '=', 'data_answers.id')
    ->select('business_listings.*', 'categories.category_name', 'locations.location_name');


    if($category_id != null){
      $business_listing_details->where('business_listings.category_id', '=', $category_id->id);
    }
    if($name != ""){
      $business_listing_details->where('business_listing_attributes.data_answer_text', '=', $name);
    }

    $business_listing_details = $business_listing_details->orderBy('business_listings.updated_at', 'desc')
    ->first();

    $business_listing_attributes = DB::table('business_listing_attributes')
    ->select('business_listing_attributes.*')
    ->where('business_listing_attributes.business_listing_id', '=', $business_listing_details->id)
    ->get();

    foreach ($business_listing_attributes as $key => $value) {
      $listing_attribute = DB::table('business_listing_attributes')
      ->leftJoin('data_answers', 'data_answers.id', 'business_listing_attributes.data_answer_id')
      ->leftJoin('data_questions', 'data_questions.id', 'business_listing_attributes.data_question_id')
      ->select('business_listing_attributes.*', 'data_answers.answer_name', 'data_questions.question_name', 'data_questions.id as question_id')
      ->where('business_listing_attributes.business_listing_id', '=', $business_listing_details->id)
      ->where('business_listing_attributes.data_question_id', '=', $value->data_question_id)
      ->get()
      ->toArray();

      if($value->data_answer_text == null && $value->data_answer_id != null){
        $attribute_id = $listing_attribute[0]->question_name;
        $array_answers = array();
        foreach ($listing_attribute as $key => $value_attribute) {
          $answer = DataAnswer::find($value_attribute->data_answer_id);
          array_push($array_answers, $answer->answer_name);
        }
        $business_listing_details->$attribute_id = $array_answers;

      }
      elseif($listing_attribute[0]->question_name == "photos" && $value->data_answer_id == null){
        $attribute_id = $listing_attribute[0]->question_name;
        $array_photo_answers = array();
        $answers_photos = BusinessListingAttribute::where('business_listing_id', '=', $business_listing_details->id)->where('data_question_id', '=', $listing_attribute[0]->question_id)->get();
        foreach ($answers_photos as $key => $value_attr) {
          array_push($array_photo_answers, $value_attr->data_answer_text);
        }
        $business_listing_details->$attribute_id = $array_photo_answers;

      }
      else {
        $attribute_text = $listing_attribute[0]->question_name;
        $business_listing_details->$attribute_text = $value->data_answer_text;
      }
    }

    // dd($business_listing_details);

    return view('website.view_details', ['business_listing_details' => $business_listing_details]);
  }

  public function search_categories_values_listing(Request $request, $slug = null)
  {
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
    if(count($values) > 1){
      $loc_for_search = preg_replace('/(?<!\s)-(?!\s)/', ' ', $values[1]);
    }
    $cat_for_search = trim($got_cat);

    $category_id = DB::table('categories')->where('category_name', '=', $cat_for_search)->first();
    $location_id = DB::table('locations')->where('location_name', '=', $loc_for_search)->first();

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

    // $text = preg_replace('/(?<!\s)-(?!\s)/', ' ', $array_values[0]);
    // dd($text);
    // $text2 = preg_replace('/(?<!\s)-(?!\s)/', ' ', $request->venue_type);

    // $business_listings = DB::table(DB::raw('business_listings force index(business_listings_category_id_location_id_index)'))->where('category_id', '=', $category_id->id)->get();
    // $business_listings = DB::table('categories as t1')
    // ->join(
    //     DB::raw('business_listings as t2 FORCE INDEX (business_listings_category_id_location_id_index)'),
    //     't1.id', '=', 't2.category_id'
    // )->select('t2.*', 't1.category_name')->where('category_id', '=', $category_id->id);

    $business_listings = DB::table('business_listings')
    ->leftJoin('categories', 'business_listings.category_id', '=', 'categories.id')
    ->leftJoin('locations', 'business_listings.location_id', '=', 'locations.id')
    ->leftJoin('business_listing_attributes', 'business_listings.id', '=', 'business_listing_attributes.business_listing_id')
    ->leftJoin('data_answers', 'business_listing_attributes.data_answer_id', '=', 'data_answers.id')
    ->select('business_listings.*', 'categories.category_name', 'locations.location_name');


    if($category_id != null){
      $business_listings->where('business_listings.category_id', '=', $category_id->id);
    }
    if($location_id != null){
      $business_listings->where('business_listings.location_id', '=', $location_id->id);
    }
    if($keyword_for_search != ""){
      $business_listings->where('business_listing_attributes.data_answer_text', '=', $keyword_for_search);
    }
    // ->where('business_listing_attributes.data_answer_text', 'LIKE', '%'.$text.'%')
    // ->where('data_answers.answer_name', 'LIKE', '%'.$text2.'%');
    // if(count($array_values) > 0){
    //   // $business_listings->where('data_answers.answer_name', '=', $array_values[0]);
    //   $business_listings->where(function($query) use ($array_values){
    //     foreach($array_values as $item){
    //       $text = preg_replace('/(?<!\s)-(?!\s)/', ' ', $item);
    //       $query->orWhere('data_answers.answer_name','=', $text);
    //     }
    //   });
    // }
    // if(count($request->all()) > 0){
    //   foreach ($request->all() as $key => $req) {
    //     $text = preg_replace('/(?<!\s)-(?!\s)/', ' ', $req);
    //     $business_listings->where('business_listing_attributes.data_answer_text', 'LIKE', '%'.$text.'%');
    //   }
    // }
    $business_listings = $business_listings->orderBy('business_listings.updated_at', 'desc')
    ->groupBy('business_listings.id')
    ->get();

    foreach ($business_listings as $key => $listing) {
      $business_listing_attributes = DB::table('business_listing_attributes')
      ->select('business_listing_attributes.*')
      ->where('business_listing_attributes.business_listing_id', '=', $listing->id)
      ->get();

      foreach ($business_listing_attributes as $key => $value) {
        $listing_attribute = DB::table('business_listing_attributes')
        ->leftJoin('data_answers', 'data_answers.id', 'business_listing_attributes.data_answer_id')
        ->leftJoin('data_questions', 'data_questions.id', 'business_listing_attributes.data_question_id')
        ->select('business_listing_attributes.*', 'data_answers.answer_name', 'data_questions.question_name')
        ->where('business_listing_attributes.business_listing_id', '=', $listing->id)
        ->where('business_listing_attributes.data_question_id', '=', $value->data_question_id)
        ->get()
        ->toArray();
        if($value->data_answer_text == null && $value->data_answer_id != null){
          $attribute_id = $listing_attribute[0]->question_name;
          $array_answers = array();
          foreach ($listing_attribute as $key => $value_attribute) {
            $answer = DataAnswer::find($value_attribute->data_answer_id);
            array_push($array_answers, $answer->answer_name);
          }
          $listing->$attribute_id = $array_answers;

        }else {
          $attribute_text = $listing_attribute[0]->question_name;
          $listing->$attribute_text = $value->data_answer_text;
        }
      }
    }

    // dd($business_listings);

    $sections = DB::table('section_business_categories')
    ->leftJoin('data_sections', 'data_sections.id', '=', 'section_business_categories.data_section_id')
    ->leftJoin('categories', 'categories.id', '=', 'section_business_categories.category_id')
    ->select('section_business_categories.*', 'categories.category_name', 'data_sections.section_name', 'data_sections.section_sub_heading')
    ->where('categories.id', '=', $category_id->id)
    ->where('data_sections.section_advance_search', '=', true)
    ->orderBy('data_sections.section_order', 'asc')
    ->get();

    foreach ($sections as $key => $value) {
      $questions = DB::table('data_questions')
      ->leftJoin('data_sections', 'data_sections.id', '=', 'data_questions.data_section_id')
      ->leftJoin('data_types', 'data_types.id', '=', 'data_questions.data_type_id')
      ->select('data_questions.*', 'data_types.type', 'data_types.html_tag')
      ->where('data_questions.data_section_id', '=', $value->data_section_id)
      ->where('data_questions.question_advance_search', '=', true)
      ->orderBy('data_questions.question_name', 'asc')
      ->get()->toArray();

      foreach ($questions as $key => $val) {
        $answers = DB::table('data_answers')
        ->select('data_answers.id as answer_id', 'data_answers.answer_name')
        ->where('data_answers.data_question_id', '=', $val->id)
        ->get()->toArray();

        $val->answers = $answers;
      }


      foreach ($questions as $que_key => $valu) {
        $valu->listings = array();
        $array_push_items = array();
        foreach ($array_values as $req_key => $val) {
          foreach ($valu->answers as $key => $va) {
            if($va->answer_name == $val){
              array_push($array_push_items, $val);
              $valu->listings = $array_push_items;
            }
          }
        }
      }

      $value->questions = $questions;

      foreach ($questions as $que_key => $valu) {
        foreach ($request->all() as $req_key => $value) {
          $array_push_items = array();
          if($req_key == $valu->question_name){
            array_push($array_push_items, preg_replace('/(?<!\s)-(?!\s)/', ' ', $value));
            $valu->listings = $array_push_items;
          }
        }
      }
    }

    $categories = DB::table('categories')->where('parent_category_id', null)->get();
    $paginator="false";
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $itemCollection = collect($business_listings);
    $perPage = 12;
    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
    $paginatedItems->setPath($request->url());

    return view('website.search_engine',['businesses' => $paginatedItems, 'suppliers_count' => count($business_listings), 'sections' => $sections, 'paginator' => $paginator, 'categories' => $categories, 'category_id' => $category_id, 'search_location' => $loc_for_search, 'category_search' => $cat_for_search, 'keyword_search' => $keyword_for_search]);
  }

  public function signup()
  {
    return view('auth.register');
  }
  public function login()
  {
    return view('auth.login');
  }
}
