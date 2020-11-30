<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get_lat_long(Request $request)
    {
      $start_address=urlencode($request->address_value);
      $url = "https://maps.google.com/maps/api/geocode/json?address=$start_address&sensor=false&region=Pakistan&key=AIzaSyAkL2flU33S8jROpNNokvWzYJ67CtXqHqs";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      $response = curl_exec($ch);
      curl_close($ch);
      $response_a = json_decode($response);
      // $status = $response_a->status;
      // if ( $status == 'ZERO_RESULTS' )
      // {
      //   $result = false;
      // }
      // else
      // {
      //   $coordinates1 = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
      //   $result =$coordinates1;
      // }

      return response()->json($response_a, 200);
    }

    public function categories_anywhere(){
      $categories = DB::table('categories')->where('parent_category_id', null)->get();
      return $categories;
    }

    public function preg_array_key_exists($pattern, $array) {
      $keys = array_keys($array);
      $item = preg_grep($pattern,$keys);
      return $item;
    }

    public function sayHello($value)
    {
      return $value;
    }
}
