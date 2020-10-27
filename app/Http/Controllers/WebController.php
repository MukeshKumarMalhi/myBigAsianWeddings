<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\User;
use App\Category;
use App\Location;
use App\Business;
use App\Shortlist;
use App\Message;
use App\MessageFile;
use App\DataAnswer;
use App\BusinessListingAttribute;
use App\Feedback;
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

  public function index()
  {
    $categories = DB::table('categories')->where('parent_category_id', null)->get();
    return view('auth.index', ['categories' => $categories]);
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
