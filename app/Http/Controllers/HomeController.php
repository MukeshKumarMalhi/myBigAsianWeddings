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
use App\Feedback;
use DB;
use Validator;
use DateTime;
use Session;
use Redirect;
use File;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $user = DB::table('users')
          ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
          ->leftJoin('countries', 'countries.id', '=', 'locations.country_id')
          ->select('users.*', 'locations.location_name', 'countries.country_name')
          ->where('users.id', '=', Auth::user()->id)
          ->first();
      return view('website.dashboard', compact('user'));
    }

    public function create_session_variable(Request $request)
    {
      $request->session()->forget('location_id_searched');
      $request->session()->forget('location_name_searched');
      $request->session()->forget('category_id_searched');
      $request->session()->forget('category_name_searched');
      $request->session()->forget('business_id_searched');
      $request->session()->forget('business_name_searched');

      $request->session()->put('location_id_searched', $request->location_id_searched);
      $request->session()->put('location_name_searched', $request->location_name_searched);
      $request->session()->put('category_id_searched', $request->category_id_searched);
      $request->session()->put('category_name_searched', $request->category_name_searched);
      $request->session()->put('business_id_searched', $request->business_id_searched);
      $request->session()->put('business_name_searched', $request->business_name_searched);

      return response()->json('session created',200);
    }

    public function search_categories_values(Request $request, $category, $location)
    {
      $get_cat = explode("-", $category);
      $got_cat = ucfirst($get_cat[1]);
      $get_loc = explode("-", $location);
      $got_loc = ucfirst($get_loc[0]);
      if($got_loc == "St"){
        $got_loc = ucfirst($get_loc[1]);
      }

      $category_id = DB::table('categories')
            ->where('category_name', 'LIKE', '%'.$got_cat.'%')
            ->first();

      $location_id = DB::table('locations')
            ->where('location_name', 'LIKE', '%'.$got_loc.'%')
            ->first();

      $sorttype = $request->get('sort_type');
      $date = new DateTime();

      $query = DB::table('businesses')
          ->leftJoin('locations', 'locations.id', '=', 'businesses.location_id')
          ->leftJoin('categories', 'categories.id', '=', 'businesses.category_id')
          ->select('businesses.*', 'locations.location_name', 'categories.category_name');
          if($category != "")
            $query->where('businesses.category_id','=',$category_id->id)->orderBy('businesses.id', 'desc');
          if($location != "")
            $query->where('businesses.location_id','=',$location_id->id)->orderBy('businesses.id', 'desc');
          if($sorttype != "" && $sorttype == "favourites")
            $businesses->orderBy('businesses.id', 'desc');
          if($sorttype != "" && $sorttype == "recently_added")
            $businesses->orderBy('businesses.created_at', 'desc');
          // ->where('locations.id', '=', $request->location_id_searched)
          // ->orWhere('categories.id', '=', $request->category_id_searched)
          // ->orWhere('businesses.id', '=', $request->business_name_searched)
          // ->orderBy('businesses.updated_at','DESC')
          // ->paginate(18);
      $paginator="false";
      $businesses = $query->get()->toArray();

      $shortlists = DB::table('shortlists')->where('user_id', '=', Auth::user()->id)->get();
      foreach ($businesses as $key => $b) {
        foreach ($shortlists as $key => $s) {
          if($s->business_id == $b->id){
            $b->shortlisted = true;
            $b->shortlisted_id = $s->id;
          }
        }
      }


      $count = count($businesses);

      $categories = DB::table('categories')->where('parent_category_id', null)->get();
      $user = DB::table('users')
          ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
          ->leftJoin('countries', 'countries.id', '=', 'locations.country_id')
          ->select('users.*', 'locations.location_name', 'countries.country_name')
          ->where('users.id', '=', Auth::user()->id)
          ->first();
      $shortlist_count = Shortlist::where('user_id', '=', Auth::user()->id)->count();


      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $itemCollection = collect($businesses);
      $perPage = 6;
      $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
      $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
      $paginatedItems->setPath($request->url());

      if (request()->ajax() && $request->search_listing == "yes") {
        $view = view('website.search', ['businesses' => $paginatedItems]);
        return Response()->json(['status' => 'ok', 'listing' => $view->render()]);
      }

      return view('website.search',['businesses' => $paginatedItems, 'paginator' => $paginator, 'user' => $user, 'categories' => $categories, 'count' => $count, 'shortlist_count' => $shortlist_count, 'category_id' => $category_id, 'location_id' => $location_id]);
    }

    public function show_detail_page(Request $request, $type, $name){
    }

    public function store_shortlist(Request $request)
    {
      try {
        $id = uniqid();
        $form_data = array(
          'id' => $id,
          'user_id' => $request->user_id,
          'business_id' => $request->business_id,
          'category_id' => $request->category_id
        );

        $shortlist = Shortlist::create($form_data);
        $count = Shortlist::where('user_id', '=', $request->user_id)->count();
        return response()->json(['success' => 'Woo! Added to your shortlist.', 'shortlist' => $id, 'count' => $count], 200);
      }
      catch(Exception $e)
      {
        return response()->json(['error' => 'Something is wrong'], 500);
      }
    }
    public function delete_shortlist(Request $request)
    {
      try {
        $user_id = Auth::user()->id;
        $shortlist = Shortlist::find($request->shortlisted_id)->delete();
        $count = Shortlist::where('user_id', '=', $user_id)->count();
        return response()->json(['remove' => 'Remove form shortlist - keep up the good work!', 'count' => $count], 200);
      }
      catch(Exception $e)
      {
        return response()->json(['error' => 'Something is wrong'], 500);
      }
    }

    public function user_settings()
    {
      $user = DB::table('users')
          ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
          ->leftJoin('countries', 'countries.id', '=', 'locations.country_id')
          ->select('users.*', 'locations.location_name', 'countries.country_name')
          ->where('users.id', '=', Auth::user()->id)
          ->first();
      return view('website.settings', compact('user'));
    }

    public function complete_profile(Request $request)
    {
      $rules = array(
       'email' => 'required|exists:users,email'
     );
     $error = Validator::make($request->all(), $rules);
     if($error->fails()){
       return response()->json(['errors' => $error->errors()->all()]);
     }else{
       // $start_date = date('Y-m-d H:i:s', strtotime($request->edit_datepicker));
       // $diffrence_date = date('Y-m-d H:i:s', strtotime("$request->edit_datepicker +$request->edit_batch_month_duration week"));
       // $end_date = date('Y-m-d H:i:s', strtotime("$diffrence_date -1 day"));
       // $duration_detail = date_diff(new DateTime($start_date), new DateTime($diffrence_date));
       //
       // $edit_fees_per_month = "";
       // $edit_fees_after_discount = $request->edit_fees - $request->edit_discount_fees;
       // if($request->edit_discount_fees != "")
       //   $edit_fees_per_month = round($edit_fees_after_discount/$request->edit_batch_month_duration);
       // else
       //   $edit_fees_per_month = round($request->edit_fees/$request->edit_batch_month_duration);
       //
       if($request->hasFile('user_image')){
         $file=$request->file('user_image')->store('public');
         $image=Storage::get($file);
         Storage::put($file,$image);
         $image_path=explode('/', $file);
         $image_path=$image_path[1];
         $user_image = User::find($request->user_id);
         $user_image->user_image = $image_path;
         $user_image->save();
       }

       if(isset($request->planning_done))
       $planning_done = implode(',', $request->planning_done);
       else
       $planning_done = null;

       if($request->weeding_budget == null)
       $weeding_budget = 0;
       else
       $weeding_budget = $request->weeding_budget;

       if($request->weeding_no_guests == null)
       $weeding_no_guests = 0;
       else
       $weeding_no_guests = $request->weeding_no_guests;

       $user = User::find($request->user_id);
       $user->location_id = $request->location_id;
       $user->name = $request->name;
       $user->email = $request->email;
       $user->account_type = $request->account_type;
       $user->weeding_no_guests = $weeding_no_guests;
       $user->weeding_budget = $weeding_budget;
       $user->weeding_location = $request->weeding_location;
       $user->weeding_date = $request->weeding_date;
       $user->partner_email = $request->partner_email;
       $user->partner_name = $request->partner_name;
       $user->planning_done = $planning_done;
       $user->save();

       return response()->json(['success' => 'Congratulations, your profile is updated'],200);
     }
    }

    public function update_user_info(Request $request)
    {
      try {
          $user = User::find($request[0]['user_id']);
          if($request[0]['type'] == 'name'){
            $user->name = $request[0]['value'];
            $user->save();
          }elseif ($request[0]['type'] == 'partner_name') {
            $user->partner_name = $request[0]['value'];
            $user->save();
          }elseif ($request[0]['type'] == 'location') {
            $user->location_id = $request[0]['value'];
            $user->save();
          }
          return response()->json($user, 200);
      }
      catch(Exception $e)
      {
          return response()->json(['error' => 'Something is wrong'], 500);
      }
    }

    public function update_date_ajax(Request $request)
    {
      try {

          $current = (new DateTime())->format("Y-m-d");
          $duration = "";
          if($request->weeding_month_season == "spring"){
            $duration_detail = date_diff(new DateTime(), new DateTime('March 20 '.$request->weeding_year));
            $duration = $duration_detail->days;
          }elseif ($request->weeding_month_season == "summer") {
            $duration_detail = date_diff(new DateTime(), new DateTime('June 20 '.$request->weeding_year));
            $duration = $duration_detail->days;
          }elseif ($request->weeding_month_season == "autumn") {
            $duration_detail = date_diff(new DateTime(), new DateTime('September 22 '.$request->weeding_year));
            $duration = $duration_detail->days;
          }elseif ($request->weeding_month_season == "winter") {
            $duration_detail = date_diff(new DateTime(), new DateTime('December 21 '.$request->weeding_year));
            $duration = $duration_detail->days;
          }else {
            $duration_detail = date_diff(new DateTime(), new DateTime($request->weeding_month_season.' '.$request->weeding_day_date.' '.$request->weeding_year));
            $duration = $duration_detail->days;
          }

          $user = User::find($request->user_id);
          $user->weeding_date = $request->weeding_date;
          $user->weeding_year = $request->weeding_year;
          $user->weeding_month_season = $request->weeding_month_season;
          $user->weeding_day_date = $request->weeding_day_date;
          $user->weeding_days_remaining = $duration;
          $user->save();

          return response()->json($user, 200);
      }
      catch(Exception $e)
      {
          return response()->json(['error' => 'Something is wrong'], 500);
      }
    }

    public function store_my_info(Request $request){
      try {
        $Input = $request->all();
        $id = $Input['user_id'];
        $rules = array(
          'email' => 'required|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^|unique:users,email,'.$id,
          'name' => 'required',
          'partner_name' => 'required',
          'weeding_no_guests' => 'required',
          'weeding_date' => 'required',
          'weeding_location' => 'required',
        );
        $error = Validator::make($Input, $rules);
        if ($error->fails()) {
          return response()->json(['errors' => $error->getMessageBag()->toArray()]);
        }
        else {
          $user = User::find($id);
          $user->location_id = $Input['location_id'];
          $user->email = $Input['email'];
          $user->name = $Input['name'];
          $user->phone = $Input['phone'];
          $user->partner_name = $Input['partner_name'];
          $user->weeding_no_guests = $Input['weeding_no_guests'];
          $user->weeding_date = $Input['weeding_date'];
          $user->weeding_location = $Input['weeding_location'];
          $user->save();
          // $hash1 = $user->password;
          // $hash2 = Hash::make($Input['password']);
          // $password_check = Hash::check($Input['password'], $hash1) && Hash::check($Input['password'], $hash2);
          // if($hash1 == ""){
          //   return response()->json(['errors' => array('password' => array('The password is invalid or the user dose not have a password'))]);
          // }elseif ($password_check === false) {
          //   return response()->json(['errors' => array('password' => array("Oops, looks like that isn't the correct password! Please try again or reset"))]);
          // }else {
          //   $user->email = $Input['email'];
          //   $user->password = Hash::make($Input['password']);
          //   $user->save();
          // }
            return response()->json(['success' => array('Your information has been updated', 'user' => $user)], 200);
        }
      }
      catch(Exception $e)
      {
        return response()->json(['error' => 'Something is wrong'], 500);
      }
    }

    public function get_venues(Request $request)
    {
      try {
          $venues = DB::table('businesses')
              ->leftJoin('locations', 'locations.id', '=', 'businesses.location_id')
              ->select('businesses.id', 'businesses.name', 'locations.id as location_id', 'locations.location_name')
              ->where('businesses.name','like',"%{$request->input('query')}%")
              ->where('businesses.category_id', '=', '5e44098b859ec')
              ->orderBy('businesses.name', 'asc')
              ->take(5)
              ->get();

            return response()->json($venues, 200);
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Something is wrong'], 500);
        }
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

    public function get_businesses(Request $request)
    {
      try {
            $businesses = DB::table('businesses')
            ->leftJoin('locations', 'locations.id', '=', 'businesses.location_id')
            ->leftJoin('categories', 'categories.id', '=', 'businesses.category_id')
            ->select('businesses.id as business_id','businesses.name as business_name', 'locations.location_name', 'categories.category_name')
            ->where('businesses.name','like',"%{$request->input('query')}%")
            ->orderBy('businesses.name', 'asc')
            ->take(5)
            ->get();

            return response()->json($businesses, 200);
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Something is wrong'], 500);
        }
    }

    public function store_message_ajax(Request $request)
    {
      $rules = array(
        'name' => 'required',
        'email' => 'required',
        'message' => 'required'
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        $form_data = array(
          'id' => $id,
          'user_id' => Auth::user()->id,
          'name' => $request->name,
          'email' => $request->email,
          'message' => $request->message,
        );
        $message_id = Message::create($form_data);
        if($request->has('files')){
          $files = $request->file('files');
          foreach ($files as $file) {
            $name=$file->getClientOriginalName();
            $image_path = time().'_'.$name;
            $file->move(public_path('messages'), $image_path);
            $file = new MessageFile();
            $file->id	= uniqid();
            $file->message_id	= $message_id->id;
            $file->file_url=$image_path;
            $file->file_name=$name;
            $file->save();
          }
        }
        return response()->json(['success' => 'Thank you..'],200);
      }
    }

    public function store_feedback_ajax(Request $request)
    {
      $rules = array(
        'feedback_type' => 'required',
        'feedback_about' => 'required',
        'feedback_notes' => 'required'
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails()){
        return response()->json(['errors' => $error->errors()->all()]);
      }else{
        $id = uniqid();
        $form_data = array(
          'id' => $id,
          'user_id' => Auth::user()->id,
          'feedback_type' => $request->feedback_type,
          'feedback_about' => $request->feedback_about,
          'feedback_notes' => $request->feedback_notes,
        );
        $feedback = Feedback::create($form_data);

        return response()->json(['success' => 'Your feedback has been submitted'],200);
      }
    }

    public function upload_user_image(Request $request)
    {
      try {
        if($request->hasFile('file')){
          $file=$request->file('file')->store('public');
          $image=Storage::get($file);
          Storage::put($file,$image);
          $image_path=explode('/', $file);
          $image_path=$image_path[1];
          $user_image = User::find($request->user_id);
          if($user_image->user_image != null){
            Storage::disk('public')->delete($user_image->user_image);
          }
          $user_image->user_image = $image_path;
          $user_image->save();
        }
          return response()->json('Image uploaded successfully', 200);
        }
        catch(Exception $e)
        {
          return response()->json(['error' => 'Something is wrong'], 500);
        }
    }

    public function remove_user_image(Request $request)
    {
      try {
        $user_image = User::find($request->user_id);
        Storage::disk('public')->delete($user_image->user_image);
        $user_image->user_image = null;
        $user_image->save();
        return response()->json('Image removed successfully', 200);
      }
      catch(Exception $e)
      {
        return response()->json(['error' => 'Something is wrong'], 500);
      }
    }

    public function delete_user_url(Request $request)
    {
      try {
        $user_url = User::find($request->user_id);
        $user_url->user_url = null;
        $user_url->save();
        return response()->json('URL deleted successfully', 200);
      }
      catch(Exception $e)
      {
        return response()->json(['error' => 'Something is wrong'], 500);
      }
    }

    public function store_user_url(Request $request)
    {
      try {
        $rules = array(
          'user_id' => 'required',
          'user_url' => 'required|string|unique:users'
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails()){
          return response()->json(['errors' => $error->getMessageBag()->toArray()]);
        }else{
          $user_url = User::find($request->user_id);
          $user_url->user_url = $request->user_url;
          $user_url->save();
          return response()->json(['success' => 'Success! You can now share your personal page with your friends and family.', 'user_url' => $user_url], 200);
        }
      }
      catch(Exception $e)
      {
        return response()->json(['error' => 'Something is wrong'], 500);
      }
    }

    public function change_email_address(Request $request)
    {
      try {
        $id = Auth::user()->id;
        $Input = $request->all();
        $rules = array(
          'email' => 'required|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^|unique:users,email,'.$id,
          'password' => 'required|min:6'
        );
        $error = Validator::make($Input, $rules);
        if ($error->fails()) {
          return response()->json(['errors' => $error->getMessageBag()->toArray()]);
        }
        else {
          $user = User::find(Auth::user()->id);
          $hash1 = $user->password;
          $hash2 = Hash::make($Input['password']);
          $password_check = Hash::check($Input['password'], $hash1) && Hash::check($Input['password'], $hash2);
          if($hash1 == ""){
            return response()->json(['errors' => array('password' => array('The password is invalid or the user dose not have a password'))]);
          }elseif ($password_check === false) {
            return response()->json(['errors' => array('password' => array("Oops, looks like that isn't the correct password! Please try again or reset"))]);
          }else {
            $user->email = $Input['email'];
            $user->password = Hash::make($Input['password']);
            $user->save();
            return response()->json(['success' => array('Your email login has been changed', $user->email)], 200);
          }
        }
      }
      catch(Exception $e)
      {
        return response()->json(['error' => 'Something is wrong'], 500);
      }
    }
}
