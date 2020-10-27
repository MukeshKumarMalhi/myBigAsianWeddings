@extends('layouts.app')
@section('title','Details')

@section('content')
</div>
<!-- breadcrumbs -->
<div class="bg-light">
    <div class="container py-3">
        <div class="breadcrumbs">
            <span class="breadcrumb-item">Weddings</span>
            <span class="breadcrumb-item">Wedding Venues</span>
            <span class="breadcrumb-item">Landmark Wedding Venues</span>
            <span class="breadcrumb-item">Salomons Estate</span>
        </div>
    </div>
</div>
<!-- header-title-content -->
<div class="bg-white border-top border-bottom py-4">
    <div class="container">
        <!-- title and heart and book -->
        <div class="row no-gutters-5">
            <div class="col-8 col-md-8 col-lg-9">
                <h1><?php $echo_business_name = (isset($business_listing_details->business_name) && $business_listing_details->business_name != "") ? ($business_listing_details->business_name) : ''; echo $echo_business_name; ?> <i class="fas fa-badge-check text-success"></i></h1>
            </div>
            <div class="col-4 col-md-4 col-lg-3 text-right">
                <div class="form-group btn-group-sm">
                    <a href="#" class="btn btn-warning rounded text-center mr-1 mb-2">Booked?</a>
                    <div class="btn btn-outline-dark save-to-shortlist mr-1 mb-2" id="short_5efdb4b9d2d292">
                        <input type="checkbox" id="short-5efdb4b9d2d292" value="">
                        <label for="short-5efdb4b9d2d292" style="cursor: pointer;">
                            <i class="far fa-heart text-purple-d2"></i> Save
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- button, stars, guest, Menus, website, phone, location and cols -->
        <div class="row">
            <div class="col-lg-7">
                <div class="row no-gutters-10 mb-3">
                    <div class="col-12 col-md-3 col-lg-3">
                        <a href="#" class="btn btn-warning rounded text-center" data-toggle="modal" data-target="#request-pricing-popup">Request pricing</a>
                    </div>
                    <div class="col-4 col-md-3 col-lg-4 border-right">
                        <div class="small">
                            <div class="star-rating" title="50%" style="display: inline-block;margin:0px;padding:0px">
                                <div class="back-stars">
                                    <i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i>
                                    <!-- <div class="front-stars" style="width: 50%">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i>
                                    </div> -->
                                </div>
                            </div>
                            0 Reviews<br/> <strong class="h5">0.0 out of 5.0</strong>
                        </div>
                    </div>
                    <div class="col-4 col-md-3 col-lg-3 border-right">
                        <div class="small">
                        <p class="mb-0">Number of Guest<br/><span class="h5"><i class="fal fa-user-friends"></i> <strong>0-0</strong></span></p>
                        </div>
                    </div>
                    <div class="col-4 col-md-2 col-lg-2 small">
                        <div class="">
                            <p class="mb-0"></i> Menus from<br/><span class="h5"><i class="fas fa-coins"></i><strong>£0</strong></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-center text-md-right">
                <div>
                    <p class="mb-2 d-inline-block">
                        <?php
                         $echo_address = (isset($business_listing_details->location) && $business_listing_details->address != "") ? ('<i class="fas fa-map-marker-alt text-warning"></i> '.$business_listing_details->address) : '';
                         $echo_address = "";
                         if((isset($business_listing_details->location) && $business_listing_details->location != "") && (isset($business_listing_details->postcode) && $business_listing_details->postcode != "")){
                           $echo_address = $business_listing_details->postcode.", ".$business_listing_details->location;
                         }
                         elseif((isset($business_listing_details->location_name) && $business_listing_details->location_name != "") && (isset($business_listing_details->postcode) && $business_listing_details->postcode != "")){
                           $echo_address = $business_listing_details->postcode.", ".$business_listing_details->location_name;
                         }else {
                           $echo_address = $business_listing_details->location_name;
                         }
                         echo '<i class="fas fa-map-marker-alt text-warning"></i> '.$echo_address; ?>&nbsp; &nbsp;
                        <?php $echo_website_url = (isset($business_listing_details->website_url) && $business_listing_details->website_url != "") ? ($business_listing_details->website_url) : ''; echo '<a href='.$echo_website_url.' target="_blank"><i class="fas fa-globe text-warning"></i> Website</a>'; ?> &nbsp; &nbsp;
                        <?php $echo_phone_number = (isset($business_listing_details->phone_number) && $business_listing_details->phone_number != "") ? ('<i class="fas fa-phone text-warning"></i> '.$business_listing_details->phone_number) : ''; echo $echo_phone_number; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Results -->
<!-- <div class="border-bottom bg-light">
    <div class="container pt-3">
        <div class="media">
            <div class="pr-2"><h3 class="d-inline-block">Results:</h3></div>
            <div class="media-body small bs-tags">
                <p class="bs-tag-item"><a href="#">Wedding Suppliers <span class="ml-2"><i class="fal fa-times"></i></span></a></p>
                <p class="bs-tag-item">Cars and Travel <span class="ml-2"><i class="fal fa-times"></i></span></p>
                <p class="bs-tag-item">Cars and Travel <span class="ml-2"><i class="fal fa-times"></i></span></p>
                <a href="#">Clear All</a>
            </div>
        </div>
    </div>
</div> -->

<div class="bg-white">
    <div class="container">
        <!-- columns 2 -->
        <div class="row no-gutters-10 py-5">
            <div class="col-md-8 col-lg-9">
              <?php
              $photos_array = array();
                if(isset($business_listing_details->photos)){
                  foreach ($business_listing_details->photos as $key => $value) {
                    if (strpos($value, 'http') === 0) {
                      $featured_image = $value;
                      array_push($photos_array, $featured_image);
                    }else{
                      $featured_image = asset('/storage/'.$value);
                      array_push($photos_array, $featured_image);
                    }
                  }
                }else {
                  $featured_image = asset('web_asset/images/products/venues-home-block.jpg');
                }
                $count_photos = count($photos_array);
              ?>
              @if($count_photos > 0)
                <div class="bs-gallery-box bs-g{{ $count_photos }} mb-4 pt-2">
                  @foreach($photos_array as $photo_s)
                    <span style="background-image: url('{{ $photo_s }}');" data-src="{{ $photo_s }}" data-thumb="{{ $photo_s }}" data-fancybox="gallery"></span>
                  @endforeach
                </div>
                @else
                  <div class="bs-gallery-box bs-g1 mb-4 pt-2">
                    <span style="background-image: url('{{ $featured_image }}');" data-src="{{ $featured_image }}" data-thumb="{{ $featured_image }}" data-fancybox="gallery"></span>
                  </div>
              @endif
                <h3 class="font-weight-bold text-purple-d2-d2">About This Vendor</h3>
                <div>
                  <?php
                    if(isset($business_listing_details->brief_description) && $business_listing_details->brief_description != ""){
                      $desc1 =strip_tags($business_listing_details->brief_description, '<p>');
                      echo "$desc1";
                    }
                  ?>
                </div>

	            <hr>
	            <h3 class="font-weight-bold text-purple-d2">Entertainment</h3>
                <div class="row no-gutters-10">
                    <div class="col-sm-6">
                        <ul class="fa-ul list-unstyled h5 bs-wv-ul">
                            <li><i class="fa-li far fa-check text-warning"></i> Dressing Room</li>
                            <li><i class="fa-li far fa-check text-warning"></i> Handicap Accessible</li>
                            <li><i class="fa-li far fa-check text-warning"></i> Indoor Event Space</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="fa-ul list-unstyled h5 bs-wv-ul">
                            <li><i class="fa-li far fa-check text-warning"></i> Reception Area</li>
                            <li><i class="fa-li far fa-check text-warning"></i> Wireless Internet</li>
                            <li><i class="fa-li far fa-check text-warning"></i> Liability Insurance</li>
                        </ul>
                    </div>
                </div>
                <br/>
	            <h3 class="font-weight-bold text-purple-d2">Venue</h3>
                <div class="row no-gutters-10">
                    <div class="col-sm-6">
                        <ul class="fa-ul list-unstyled h5 bs-wv-ul">
                            <li><i class="fa-li far fa-check text-warning"></i> Dressing Room</li>
                            <li><i class="fa-li far fa-check text-warning"></i> Handicap Accessible</li>
                            <li><i class="fa-li far fa-check text-warning"></i> Indoor Event Space</li>
                            <li><i class="fa-li far fa-check text-warning"></i> On-Site Accommodations</li>
                                <li><i class="fa-li far fa-check text-warning"></i> Outdoor Event Space</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="fa-ul list-unstyled h5 bs-wv-ul">
                            <li><i class="fa-li far fa-check text-warning"></i> Reception Area</li>
                            <li><i class="fa-li far fa-check text-warning"></i> Wireless Internet</li>
                            <li><i class="fa-li far fa-check text-warning"></i> Liability Insurance</li>
                            <li><i class="fa-li far fa-times text-danger"></i> Outdoor - Covered</li>
                        </ul>
                    </div>
                </div>

	            <hr>
                <!-- cols review -->
                <div class="clearfix mb-3">
                    <button class="btn btn-outline-warning float-right" data-toggle="modal" data-target="#review-popup">Write a review</button>
                    <h3 class="font-weight-bold text-purple-d2 mb-3">19 Reviews for The Devonshire Fell Hotel</h3>
                </div>
                <!-- cols review -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-4 mb-3">
                        <div class="border rounded pt-3 px-3 h-100">
                            <div class="clearfix">
                                <div class="star-rating" title="50%" style="display: inline-block;margin:0px;padding:0px">
                                    <div class="back-stars">
                                        <i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i>
                                        <div class="front-stars" style="width: 60%">
                                            <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="font-weight-bold text-purple-d2">Perfect Venue for Art Lovers</h5>
                            </div>
                            <p>For anyone that enjoys architecture and art this is a must see wedding venue. The mural in the Great
                            Room and the painted staircase are show stoppingly s architecture and art this is a must see wedding venue. The mural in the Great
                            Room and the painted staircase are show stoppinglybeautiful and the ...</p>
                            <div class="media mb-3">
                                <div class="pr-2"><div class="review-img" style="background-image: url('web_asset/images/how-it-works-img.png');"></div></div>
                                <div class="media-body align-self-center"><p>Chris & Lorna Married in September 2014</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-4 mb-3">
                        <div class="border rounded pt-3 px-3 h-100">
                            <div class="clearfix">
                                <div class="star-rating" title="50%" style="display: inline-block;margin:0px;padding:0px">
                                    <div class="back-stars">
                                        <i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i>
                                        <div class="front-stars" style="width: 60%">
                                            <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="font-weight-bold text-purple-d2">Perfect Venue for Art Lovers</h5>
                            </div>
                            <p>For anyone that enjoys architecture and art this is a must see wedding venue. The mural in the Great
                            Room and the painted staircase are show stoppingly beautiful and the ...</p>
                            <div class="media mb-3">
                                <div class="pr-2"><div class="review-img" style="background-image: url('web_asset/images/how-it-works-img.png');"></div></div>
                                <div class="media-body align-self-center"><p>Chris & Lorna Married in September 2014</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-4 mb-3">
                        <div class="border rounded pt-3 px-3 h-100">
                            <div class="clearfix">
                                <div class="star-rating" title="50%" style="display: inline-block;margin:0px;padding:0px">
                                    <div class="back-stars">
                                        <i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i>
                                        <div class="front-stars" style="width: 60%">
                                            <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="font-weight-bold text-purple-d2">Perfect Venue for Art Lovers</h5>
                            </div>
                            <p>For anyone that enjoys architecture and art this is a must see wedding venue. The mural in the Great
                            Room and the painted staircase are show stoppingly beautiful and the ...</p>
                            <div class="media mb-3">
                                <div class="pr-2"><div class="review-img" style="background-image: url('web_asset/images/how-it-works-img.png');"></div></div>
                                <div class="media-body align-self-center"><p>Chris & Lorna Married in September 2014</p></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center py-4">
                    <button class="btn btn-outline-warning">See more reviews</button>
                </div>

                <hr>
                <h3 class="font-weight-bold text-purple-d2 mb-3">FAQ</h3>
                <div class="text-purple-d2">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="bs-fa-chevron-collapse mb-0 gotham-medium">
                            <a data-toggle="bs-collapse" class="collapsed" href="#faq-count1">
                               <span class="float-right"><i class="far text-warning" aria-hidden="true"></i></span> What is your No. 1 wedding planning tip for couples?</a>
                            </h4>
                            <div id="faq-count1" class="collapse" aria-expanded="false">
                                <div class="pt-3">
                                    Don't try to please every single one of your guests - it's YOUR special day!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="bs-fa-chevron-collapse mb-0 gotham-medium">
                            <a data-toggle="bs-collapse" class="collapsed" href="#faq-count2">
                               <span class="float-right"><i class="far text-warning" aria-hidden="true"></i></span> What is your No. 1 wedding planning tip for couples?</a>
                            </h4>
                            <div id="faq-count2" class="collapse" aria-expanded="false">
                                <div class="pt-3">
                                    Don't try to please every single one of your guests - it's YOUR special day!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="bs-fa-chevron-collapse mb-0 gotham-medium">
                                <a data-toggle="bs-collapse" class="collapsed" href="#faq-count3">
                               <span class="float-right"><i class="far text-warning" aria-hidden="true"></i></span> What is your No. 1 wedding planning tip for couples?</a>
                            </h4>
                            <div id="faq-count3" class="collapse" aria-expanded="false">
                                <div class="pt-3">
                                    Don't try to please every single one of your guests - it's YOUR special day!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="pt-2">
                    <div class="card mb-4 border-purple-d2 rounded-0">
                    	<div class="bg-purple-d2 card-header rounded-0 text-light link-light pt-3">
                    		<h4>Message Supplier</h4>
                    	</div>
                    	<div class="card-body">
                            <div class="form-group">
                                <label>Name and Surname</label>
                                <div class="input-group">
                                    <input type="text" name="name_and_surname" class="form-control border-right-0" placeholder="Enter your name">
                                    <div class="input-group-append"><span class="input-group-text bg-white pl-1"><i class="fal fa-user text-warning"></i></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <input type="email" name="email-address" class="form-control border-right-0" placeholder="Enter your email">
                                    <div class="input-group-append"><span class="input-group-text bg-white pl-1"><i class="fal fa-envelope text-warning"></i></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Telephone</label>
                                <div class="input-group">
                                    <input type="tel" name="telephone" class="form-control border-right-0" placeholder="Enter your phone number">
                                    <div class="input-group-append"><span class="input-group-text bg-white pl-1"><i class="fal fa-phone text-warning"></i></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <div class="input-group">
                                    <input type="tel" name="date" class="form-control datepicker border-right-0" placeholder="DD/MM/YYYY">
                                    <div class="input-group-append"><span class="input-group-text bg-white pl-1"><i class="fal fa-calendar-alt text-warning"></i></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Guest</label>
                                <div class="input-group">
                                    <input type="tel" name="guest" class="form-control border-right-0" placeholder="Number of guest">
                                    <div class="input-group-append"><span class="input-group-text bg-white pl-1"><i class="fal fa-user-friends text-warning"></i></span></div>
                                </div>
                            </div>
    						<div class="form-group pt-3">
    							<button class="btn btn-block btn-warning">Request Pricing</button>
    						</div>
                    	</div>
                    </div>
                    <div class="mb-3">
                        <?php
                          // if((isset($business_listing_details->business_name) && $business_listing_details->business_name != "") && (isset($business_listing_details->address) && $business_listing_details->address != "")){
                          //   $address_map = $business_listing_details->business_name.",".$business_listing_details->address;
                          // }
                          // if(isset($business_listing_details->address) && $business_listing_details->address != ""){
                          //   $address_map = $business_listing_details->address;
                          // }else {
                          //   $address_map = $business_listing_details->business_name;
                          // }
                          // echo "$address_map";
                          // $new_address = str_replace(' ','%20', $address_map);
                          // $another_Address = "https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=".$new_address."&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed";
                        ?>
                        <!-- <iframe
                        width="100%" height="400" frameborder="0" style="border:0" allowfullscreen
                        src="<?php //echo $another_Address; ?>"></iframe> -->
                        <?php $source = "https://maps.google.com/maps?q=".$business_listing_details->latitude.",".$business_listing_details->longitude."&hl=en&z=14&amp;output=embed"; ?>
                        <iframe
                        width="100%" height="400" frameborder="0" style="border:0" allowfullscreen
                        src="<?php echo $source; ?>"
                       >
                       </iframe>
                    </div>
                    <div class="border p-3">
                        <h5 class="font-weight-bold text-purple-d2">Follow {{ $echo_business_name }} on</h5>
                        <div class="h2">
                          <?php $echo_facebook = (isset($business_listing_details->facebook) && $business_listing_details->facebook != "") ? ($business_listing_details->facebook) : '#'; ?>
                          <?php $echo_twitter = (isset($business_listing_details->twitter) && $business_listing_details->twitter != "") ? ($business_listing_details->twitter) : '#'; ?>
                          <?php $echo_instagram = (isset($business_listing_details->instagram) && $business_listing_details->instagram != "") ? ($business_listing_details->instagram) : '#'; ?>
                          <?php $echo_pinterest = (isset($business_listing_details->pinterest) && $business_listing_details->pinterest != "") ? ($business_listing_details->pinterest) : '#'; ?>
                          <?php $echo_google = (isset($business_listing_details->google) && $business_listing_details->google != "") ? ($business_listing_details->google) : '#'; ?>
                          <?php $echo_linkedin = (isset($business_listing_details->linkedin) && $business_listing_details->linkedin != "") ? ($business_listing_details->linkedin) : '#'; ?>
                            <a href="<?php echo $echo_facebook; ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="<?php echo $echo_twitter; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="<?php echo $echo_instagram; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="<?php echo $echo_pinterest; ?>" target="_blank"><i class="fab fa-pinterest"></i></a>
                            <a href="<?php echo $echo_google; ?>" target="_blank"><i class="fab fa-google"></i></a>
                            <a href="<?php echo $echo_linkedin; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  function spaceByhyphen(myStr){
    myStr=myStr.toLowerCase();
    myStr=myStr.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");
    myStr=myStr.replace(/\s+/g, "-");
    return myStr;
  }

  function spaceByhyphenOnly(myStr){
    // myStr=myStr.toLowerCase();
    // myStr=myStr.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");
    myStr=myStr.replace(/\s+/g, "-");
    return myStr;
  }

  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var path_l = "{{ url('/search_location') }}";
    var locations = $('.areaofuk').typeahead({
      source: function (query, process)
      {
        return $.get(path_l, {query: query}, function(locations){
          return process(locations);
        });
      },
      displayText: function (location)
      {
        return location['location_name']+', '+location['country_name'];
      }
    });

    $(".areaofuk").change(function()
    {
      var location_id = $(".areaofuk").typeahead("getActive");
      // $("#location_id").val(location_id.location_id);
      $(".areaofuk").val(location_id.location_name);
    });

    $("#form_submit").click(function(){
      $(".filters").trigger("change");
    });

    $('.filters').on('change', function (e) {
        var req_arr = [],
            box = {};
            arr = [],
            fdata = [],
            loc = $('<a>', { href: window.location })[0];

        $('input').each(function (i){
          if(this.checked && this.type == 'checkbox'){
            arr.push(this.value);
          }
          else if(this.type == "text" && this.value != "" && this.name != "location_name_searched"){
            box[this.name] = this.value;
          }
        });
        $('select').each(function (i){
          if(this.value != "" && this.name != "category_id_searched"){
            arr.push(this.value);
          }
        });

        req_arr.push(box);
        var size = Object.keys(box).length;

        var req_data = req_arr.filter(v=>v!='');
        var data = arr.filter(v=>v!='');
        var fdata = "";
        var qdata = "";
        data.forEach(function(key,i){
          fdata += "/"+data[i].replace(/\s+/g, '-');
        });

        $.each(req_data, function(key,i){
          if(size == 1){
            $.each(i, function(key, value){
              if(value != ""){
                qdata += "?"+key+"="+value.replace(/\s+/g, '-');
              }
            })
          }else if(size > 1){
            var j = 0;
            $.each(i, function(key, value){
              if(value != "" && j == 0){
                qdata += "?"+key+"="+value.replace(/\s+/g, '-');
              }else {
                qdata += "&"+key+"="+value.replace(/\s+/g, '-');
              }
              j++
            })
          }
        });

        var selected_category = $(".category_search_form option:selected").val();
        var selected_location = $("input[name=location_name_searched]").val();
        var sel_cat = spaceByhyphen(selected_category);

        if(selected_location == ""){
          selected_location = "UK"
        }
        var sel_loc = spaceByhyphenOnly(selected_location);
        // console.log(sel_loc);
        // console.log(qdata);
        // console.log(fdata);
        // return false;
        var url = 'http://127.0.0.1:8000/search/wedding-'+sel_cat+'/'+sel_loc+fdata+qdata;
        window.location = url;
    });
  });
  </script>
@endsection
