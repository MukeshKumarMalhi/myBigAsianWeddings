@extends('layouts.app')
@section('title','Details')

@section('content')

<div class="container pt-80 text-light text-center">
    <div class="text-center link-light text-light">
        <h2 class="mb-4 font-poppins">UK's Free Online <span class="txt-rotate text-warning" data-period="1000" data-rotate='[ "Asian", "Chinese", "Indian", "Pakistani" ]'></span>&nbsp;Wedding Planning Tool</h2>
        <h5 class="mb-4">Let's find the reliable local wedding suppliers nearest to you from <span class="text-warning">{{ number_format($total_listings) }}</span> verified wedding suppliers.</h5>
    </div>
    <div class="bs-search-form py-5 px-5 mx-auto" style="max-width: 800px;">
        <div role="form" class="form-horizontal text-center" id="serach_filter_form">
            <div class="mx-auto" style="max-width: 700px;">
                <div class="row no-gutters form-group m-3">
                    <div class="form-group col-md-5">
                        <input type="text" name="location_name_searched" placeholder="Enter location" class="form-control areaofuk" autocomplete="off">
                    </div>
                    <div class="form-group  col-md-5">
                        <select name='category_id_searched' class="form-control category_search_form filters custom-select rounded">
                            <option value="" checked disabled>Categories</option>
                            <?php foreach ($categories as $key => $value): ?>
                              <option value="{{ $value }}">{{ $value }}</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-warning btn-block" id="form_submit">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters-5 text-center bottom-negative-70">
        <div class="col-4 col-md-3 col-lg mb-3">
            <div class="h-100 bg-danger p-3 rounded">
                <img src="{{ asset('web_asset/images/icons/search.png') }}" class="img-fluid m-auto">
                <p class="mb-0">Search</p>
            </div>
        </div>
        <div class="col-4 col-md-3 col-lg mb-3">
            <div class="h-100 bg-danger p-3 rounded">
                <img src="{{ asset('web_asset/images/icons/planning-tools.png') }}" class="img-fluid m-auto">
                <p class="mb-0">Planning Tools</p>
            </div>
        </div>
        <div class="col-4 col-md-3 col-lg mb-3">
            <div class="h-100 bg-danger p-3 rounded">
                <img src="{{ asset('web_asset/images/icons/guestlist.png') }}" class="img-fluid m-auto">
                <p class="mb-0">Guestlist</p>
            </div>
        </div>
        <div class="col-4 col-md-3 col-lg mb-3">
            <div class="h-100 bg-danger p-3 rounded">
                <img src="{{ asset('web_asset/images/icons/checklist.png') }}" class="img-fluid m-auto">
                <p class="mb-0">Checklist</p>
            </div>
        </div>
        <div class="col-4 col-md-3 col-lg mb-3">
            <div class="h-100 bg-danger p-3 rounded">
                <img src="{{ asset('web_asset/images/icons/budget.png') }}" class="img-fluid m-auto">
                <p class="mb-0">Budget</p>
            </div>
        </div>
        <div class="col-4 col-md-3 col-lg mb-3">
            <div class="h-100 bg-danger p-3 rounded">
                <img src="{{ asset('web_asset/images/icons/shortlist.png') }}" class="img-fluid m-auto">
                <p class="mb-0">Shortlist</p>
            </div>
        </div>
        <div class="col-4 offset-2 offset-md-0 col-md-3 col-lg mb-3">
            <div class="h-100 bg-danger p-3 rounded">
                <img src="{{ asset('web_asset/images/icons/advice.png') }}" class="img-fluid m-auto">
                <p class="mb-0">Advice</p>
            </div>
        </div>
        <div class="col-4 col-md-3 col-lg mb-3">
            <div class="h-100 bg-danger p-3 rounded">
                <img src="{{ asset('web_asset/images/icons/gift-lists.png') }}" class="img-fluid m-auto">
                <p class="mb-0">Gift Lists</p>
            </div>
        </div>
    </div>
</div>
</div>
<!-- section 1 Popular Categories -->
<div class="pt-100 pb-50">
    <div class="container text-center">
        <h2>Popular Categories</h2>
        <p>Just looking around? Let us suggest you something hot & happening!</p>
        <div class="row text-light link-light bs-popular-categories">
            <div class="col-6 col-md-4 col-lg-3 mb-4">
              <a href="{{ url('/search/wedding-bridal-wear/UK') }}" target="_blank">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/Group-319@2x.png') }}');">
                    <p>Bridal Wear</p>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
              <a href="{{ url('/search/wedding-groom-wear/UK') }}" target="_blank">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/Group-335@2x.png') }}');">
                    <p>Groom Wear</p>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4">
              <a href="{{ url('/search/wedding-accessories/UK') }}" target="_blank">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/Group-332@2x.png') }}');">
                    <p>Accessories</p>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4 offset-0 offset-md-2 offset-lg-0">
              <a href="{{ url('/search/wedding-photographer/UK') }}" target="_blank">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/Group-336@2x.png') }}');">
                    <p>Photographer</p>
                </div>
              </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4 offset-3 offset-md-0">
              <a href="{{ url('/search/wedding-beauty/UK') }}" target="_blank">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/Group-334@2x.png') }}');">
                    <p>Beauty</p>
                </div>
              </a>
            </div>
        </div>
        <div class="text-center mb-3">
            <a href="#view-all-categories" data-toggle="collapse" data-target="#view-all-categories">View All Categories <i class="fal fa-chevron-down"></i></a>
        </div>
        <div class="collapse" id="view-all-categories">
            <div class="row no-gutters-5">
              <?php
              $rows = array_chunk($categories,7);
                foreach($rows as $columns){
                  echo '<div class="col-lg-4">';
                    foreach ($columns as $column_items){
              ?>
                      <p><a href="{{ url('/search/wedding') }}-{{ str_replace(' ', '-', strtolower($column_items)) }}/UK" target="_blank">{{ ucfirst($column_items) }}</a></p>
              <?php
                    }
                  echo '</div>';
                }
              ?>
            </div>
        </div>
    </div>
</div>

<!-- section 2 Our Featured Wedding Suppliers-->
<div class="py-50">
    <div class="container">
        <div class="text-center pb-5">
            <h2>Our Featured Wedding Suppliers</h2>
            <p>Check Out Our Verified And Reliable Wedding Suppliers.</p>
        </div>
        <!-- product-section -->
        <div class="row">
          <?php foreach ($featured_listings as $key => $value): ?>
            <div class="col-md-6 col-lg-3">
                <!-- product-box -->
                <div class="card bs-product-box mb-4">
                  <?php
                    if(isset($value->featured_image)){
                      if (strpos($value->featured_image, 'http') === 0) {
                        $featured_image = $value->featured_image;
                      }else{
                        $featured_image = asset('/storage/'.$value->featured_image);
                      }
                    }else {
                      $featured_image = asset('web_asset/images/products/venues-home-block.jpg');
                    }
                  ?>
                    <!-- product image -->
                    <div class="card-img-top bg-center-url" style="background-image: url('<?php echo $featured_image; ?>');">
                        <!-- heart icon -->
                        <div class="bs-product-heart text-white">
                            <div class="save-to-shortlist" id="short_5efdb4b9d2d29">
                                <input type="checkbox" id="short-5efdb4b9d2d29" value="">
                                <label for="short-5efdb4b9d2d29" style="cursor: pointer;">
                                    <i class="far fa-heart fa-2x text-purple"></i>
                                </label>
                            </div>
                        </div>
                        <!-- featured-line -->
                        <div class="featured-line">
                            <p class="bg-danger text-light">FEATURED</p>
                        </div>
                    </div>
                    <?php if(isset($value->slug)){ $url = url('/wedding-'.str_replace(' ', '-', strtolower($value->category_name)).'/'.$value->slug); }?>
                    <div class="card-body p-2 text-purple small">
                        <h5 class="font-weight-bold"><a href="<?php $echo_slug = (isset($value->slug) && $value->slug != "") ? ($url) : '#'; echo $echo_slug; ?>"> <?php $echo_business_name = (isset($value->business_name) && $value->business_name != "") ? ($value->business_name) : ''; echo $echo_business_name; ?> </a></h5>
                        <p class="mb-2"><i class="fas fa-map-marker-alt"></i> <?php $echo_location_name = (isset($value->location_name) && $value->location_name != "") ? ($value->location_name) : 'United Kingdom'; echo $echo_location_name; ?></p>
                        <div class="mb-2">
                            <div class="star-rating" title="50%" style="display: inline-block;margin:0px;padding:0px">
                                <div class="back-stars">
                                    <i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i><i class="far fa-star" aria-hidden="true"></i>
                                    <!-- <div class="front-stars" style="width: 50%">
                                        <i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i><i class="fas fa-star" aria-hidden="true"></i>
                                    </div> -->
                                </div>
                            </div>
                            <!-- 125 Reviews -->
                        </div>
                        <p>Number of Guest:<br/><i class="fal fa-user-friends text-warning"></i> <strong>0-0</strong></p>
                        <div class="btn-group-sm">
                        <a href="#" class="btn btn-warning rounded mb-1">Request pricing</a>
                        @if($echo_slug != "#")
                          <a href="<?php echo $echo_slug; ?>" class="btn btn-danger rounded mb-1">View details</a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
          <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="py-50 bg-bottom-url bs-bg-img-b" style="background-image: url('{{ asset('web_asset/images/bg-white-img-bottom1.png') }}');">
    <div class="container">
        <hr>
        <div class="row text-center py-5">
            <div class="col-md-6 mb-4">
                <p class="mb-1">Plan your wedding on the go</p>
                <h2 class="font-gotham-medium">Download the My Big Asian Wedding Plan Anytime, Anywhere</h2>
                <div class="row mb-4 no-gutters-5 mx-auto" style="max-width: 400px;">
                    <div class="col-6"><a href="#"><img src="{{  asset('web_asset/images/play-store.png') }}" class="img-fluid"></a></div>
                    <div class="col-6"><a href="#"><img src="{{  asset('web_asset/images/app-store.png') }}" class="img-fluid"></a></div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <p class="mb-1">Create your wedding website</p>
                <h2 class="font-gotham-medium">Easily Share All of Your Wedding Details in One Place</h2>
                <a href="#" class="text-underline">Get Website Template More</a>
            </div>
        </div>
    </div>
</div>
<!-- section 3 How it Works -->
<div class="bg-dark text-center pt-5">
    <div class="container">
        <h2 class="font-gotham-medium text-light mb-5">How it Works</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="pb-4 h-100">
                    <div class="card bg-warning h-100">
                        <div class="card-body">
                            <div class="mb-3"><img src="{{ asset('web_asset/images/circle-icon1.png') }}" class="img-fluid"></div>
                            <h4 class="font-gotham-medium">Discover & Shortlist Venues</h4>
                            <p>Input your requirements & see our recommendations & Prices.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pb-4 h-100">
                    <div class="card bg-warning h-100">
                        <div class="card-body">
                            <div class="mb-3"><img src="{{ asset('web_asset/images/circle-icon2.png') }}" class="img-fluid"></div>
                            <h4 class="font-gotham-medium">Book Venue</h4>
                            <p>Get final quotes (upto 30% off) and book your venue.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pb-4 h-100">
                    <div class="card bg-warning h-100">
                        <div class="card-body">
                            <div class="mb-3"><img src="{{ asset('web_asset/images/circle-icon3.png') }}" class="img-fluid"></div>
                            <h4 class="font-gotham-medium">Discover & Shortlist Venues</h4>
                            <p>Input your requirements & see our recommendations & Prices.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="pb-4 h-100">
                    <div class="card bg-warning h-100">
                        <div class="card-body">
                            <div class="mb-3"><img src="{{ asset('web_asset/images/circle-icon4.png') }}" class="img-fluid"></div>
                            <h4 class="font-gotham-medium">Book Vendors</h4>
                            <p>Meet our trusted vendors and book them at your ease.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-negative-140">
            <h2 class="font-gotham-medium text-light mb-5">Why book with My Big Asian Wedding</h2>
            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="pb-4 h-100">
                        <div class="card bg-white h-100  border-warning">
                            <div class="card-body">
                                <div><img src="{{ asset('web_asset/images/delivery-of-commitments.png') }}" class="img-fluid"></div>
                                <h4 class="font-gotham-medium">Delivery of Commitments</h4>
                                <p>Our team ensures that all the services are delivered as committed to ensure a hassle-free experience for you.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pb-4 h-100">
                        <div class="card bg-white h-100  border-warning">
                            <div class="card-body">
                                <div><img src="{{ asset('web_asset/images/our-stop_shop.png') }}" class="img-fluid"></div>
                                <h4 class="font-gotham-medium">Our-Stop Shop</h4>
                                <p>No need to run around for your wedding services - Book our trusted vendors under one roof.</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="pb-4 h-100">
                        <div class="card bg-white h-100  border-warning">
                            <div class="card-body">
                                <div><img src="{{ asset('web_asset/images/guaranteed-best-prices.png') }}" class="img-fluid"></div>
                                <h4 class="font-gotham-medium">Guaranteed Best Prices</h4>
                                <p>We guarantee our prices for venue and non-venue services. Upto 30% off.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section 3 Ideas and Tips -->
<div class="pb-5 pt-100">
    <div class="container text-center pt-5">
        <h2>Ideas and Tips</h2>
        <p class="mb-5">Get inspired with the latest trends and advice from our wedding experts</p>
        <div class="row text-light link-light bs-ideas-and-tips">
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <a href="#">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/real-wedding.png') }}');">
                    <p>Real Wedding</p>
                </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <a href="#">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/planning-essentials.png') }}');">
                    <p>Planning Essentials</p>
                </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <a href="#">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/stationery-and-wording.png') }}');">
                    <p>Stationery and Wording Ideas</p>
                </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <a href="#">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/budget.png') }}');">
                    <p>Budget</p>
                </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <a href="#">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/stag-and-hen.png') }}');">
                    <p>Stag and Hen</p>
                </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <a href="#">
                <div class="bg-center-url d-flex align-items-center justify-content-center rounded bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/ceremony-and-reception.png') }}');">
                    <p>Ceremony and Reception</p>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>


<!-- section 5 Latest Blogs -->
<div class="bg-center-url" style="background-image: url('{{ asset('web_asset/images/bg-hallcandle-img2.png') }}');">
    <div class="container py-80">
        <div class="bg-white p-3 p-sm-4 p-lg-5 bs-latebs-blogs">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <h3 class="font-weight-bold">Latest Blogs</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3">
                        <div class="row no-gutters-5">
                            <div class="col-4 col-md-4">
                                <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="mb-1 small">
                                    <div class="d-inline-block mr-2">January 28,2021 </div>
                                    <div class="d-inline-block font-weight-bold link-danger">
                                        <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3">
                        <div class="row no-gutters-5">
                            <div class="col-4 col-md-4">
                                <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="mb-1 small">
                                    <div class="d-inline-block mr-2">January 28,2021 </div>
                                    <div class="d-inline-block font-weight-bold link-danger">
                                        <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3">
                        <div class="row no-gutters-5">
                            <div class="col-4 col-md-4">
                                <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="mb-1 small">
                                    <div class="d-inline-block mr-2">January 28,2021 </div>
                                    <div class="d-inline-block font-weight-bold link-danger">
                                        <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3">
                        <div class="row no-gutters-5">
                            <div class="col-4 col-md-4">
                                <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="mb-1 small">
                                    <div class="d-inline-block mr-2">January 28,2021 </div>
                                    <div class="d-inline-block font-weight-bold link-danger">
                                        <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3">
                        <div class="row no-gutters-5">
                            <div class="col-4 col-md-4">
                                <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="mb-1 small">
                                    <div class="d-inline-block mr-2">January 28,2021 </div>
                                    <div class="d-inline-block font-weight-bold link-danger">
                                        <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3">
                        <div class="row no-gutters-5">
                            <div class="col-4 col-md-4">
                                <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="mb-1 small">
                                    <div class="d-inline-block mr-2">January 28,2021 </div>
                                    <div class="d-inline-block font-weight-bold link-danger">
                                        <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3">
                        <div class="row no-gutters-5">
                            <div class="col-4 col-md-4">
                                <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="mb-1 small">
                                    <div class="d-inline-block mr-2">January 28,2021 </div>
                                    <div class="d-inline-block font-weight-bold link-danger">
                                        <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                        <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section 6 Start today, it’s fee-->
<div class="py-50 bg-top-url bs-bg-img-t text-center" style="background-image: url('{{ asset('web_asset/images/bg-white-img-top1.png') }}');">
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <div class="pt-80 pb-100">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <br>
                    <a class="btn btn-warning text-light mr-2 mb-2 font-weight-bold" href="{{ url('/signup') }}">Start today, it’s fee <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="pb-5">
            <h2 class="font-weight-bold mb-3">In Seen in</h2>
            <div class="text-center as-seen-in-home pb-2">
                <div class="logo-items">
                    <i class="logo-item nyt"></i>
                    <i class="logo-item bbc"></i>
                    <i class="logo-item mailonline"></i>
                    <i class="logo-item vogue"></i>
                    <i class="logo-item elle"></i>
                    <i class="logo-item metro"></i>
                    <i class="logo-item stylist"></i>
                </div>
            </div>
        </div>
                <div class="text-center mt-5 mb-3">
            <h1>Search by Category to Find Your Wedding Suppliers</h1>
        </div>
        <div class="row my-3">
            <div class="col-md-3">
                <div class="font-gotham-bold mt-3">Wedding Venues</div>
                <div><a href="#">Barn Weddings</a></div>
                <div><a href="#">Country Weddings</a></div>
                <div><a href="#">Bar, Pub and Restaurant</a></div>
                <div><a href="#">Unique Weddings</a></div>
                <div><a href="#">Castle Weddings</a></div>
                <div><a href="#">Historic Weddings</a></div>
                <div><a href="#">Small Hotel Weddings</a></div>
                <div><a href="#">Vineyard Weddings</a></div>
                <div><a href="#">City Weddings</a></div>
                <div><a href="#">Large Hotel Weddings</a></div>
                <div><a href="#">Sporting</a></div>
                <div><a href="#">Woodland and Festival Weddings</a></div>
                <div><a href="#">Coastal and Beach Weddings</a></div>
            </div>
            <div class="col-md-3">
                <div class="font-gotham-bold mt-3">&nbsp;</div>
                <div><a href="#">Marquees and Tents</a></div>
                <div><a href="#">Stately Home</a></div>
                <div><a href="#">Asian Weddings</a></div>
                <div><a href="#">Church Weddings</a></div>
                <div><a href="#">Landmark Weddings</a></div>
                <div><a href="#">Tipis and Yurts</a></div>
                <div><a href="#">Chapel on Premises</a></div>
                <div><a href="#">Civil Ceremony Licence</a></div>
                <div><a href="#">Exclusive Use</a></div>
                <div><a href="#">Outdoor Weddings</a></div>
                <div><a href="#">Pet Friendly Weddings</a></div>
                <div><a href="#">Unusual Weddings</a></div>
            </div>
            <div class="col-md-3">
                <div class="font-gotham-bold mt-3">Wedding Suppliers</div>
                <div><a href="#">Beauty, Hair & Make Up</a></div>
                <div><a href="#">Bridalwear Shops</a></div>
                <div><a href="#">Cakes</a></div>
                <div><a href="#">Florists</a></div>
                <div><a href="#">Marquee & Tipi Hire</a></div>
                <div><a href="#">Groom Attire </a></div>
                <div><a href="#">Confetti and Bubbles</a></div>
                <div><a href="#">Hen and Stag nights</a></div>
                <div><a href="#">Dress Cleaning and Boxes</a></div>
                <div><a href="#">Decorative Hire</a></div>
                <div><a href="#">Entertainment</a></div>
                <div><a href="#">Favours</a></div>
            </div>
            <div class="col-md-3">
                <div class="font-gotham-bold mt-3">&nbsp;</div>
                <div><a href="#">Decorative Hire</a></div>
                <div><a href="#">Entertainment</a></div>
                <div><a href="#">Favours</a></div>
                <div><a href="#">Photographers</a></div>
                <div><a href="#">Photo Booths</a></div>
                <div><a href="#">Honeymoons</a></div>
                <div><a href="#">Destination Weddings</a></div>
                <div><a href="#">Toastmasters</a></div>
                <div><a href="#">Sweets and Treats</a></div>
                <div><a href="#">Mobile Bar Services</a></div>
                <div><a href="#">Music and DJs </a></div>
                <div><a href="#">Stationery</a></div>
            </div>
            <div class="col-md-3">
                <div class="font-gotham-bold mt-3">Delhi NCR</div>
                <div><a href="#">Beauty, Hair & Make Up</a></div>
                <div><a href="#">Bridalwear Shops</a></div>
            </div>

            <div class="col-md-3">
                <div class="font-gotham-bold mt-3">Mumbai</div>
                <div><a href="#">Beauty, Hair & Make Up</a></div>
                <div><a href="#">Bridalwear Shops</a></div>
            </div>
            <div class="col-md-3">
                <div class="font-gotham-bold mt-3">Bangalore</div>
                <div><a href="#">Beauty, Hair & Make Up</a></div>
                <div><a href="#">Bridalwear Shops</a></div>
            </div>
            <div class="col-md-3">
                <div class="font-gotham-bold mt-3">Vendor Categories</div>
                <div><a href="#">Beauty, Hair & Make Up</a></div>
                <div><a href="#">Bridalwear Shops</a></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  var TxtRotate = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
  };
  TxtRotate.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
      this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
      this.txt = fullTxt.substring(0, this.txt.length + 1);
    }
    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

    var that = this;
    var delta = 150 - Math.random() * 100;

    if (this.isDeleting) { delta /= 2; }

    if (!this.isDeleting && this.txt === fullTxt) {
      delta = this.period;
      this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
      this.isDeleting = false;
      this.loopNum++;
      delta = 800;
    }
    setTimeout(function() {
      that.tick();
    }, delta);
  };
  window.onload = function() {
    var elements = document.getElementsByClassName('txt-rotate');
    for (var i=0; i<elements.length; i++) {
      var toRotate = elements[i].getAttribute('data-rotate');
      var period = elements[i].getAttribute('data-period');
      if (toRotate) {
        new TxtRotate(elements[i], JSON.parse(toRotate), period);
      }
    }
    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
    document.body.appendChild(css);
  };
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
        // var url_web = "{{ url('/view_data_submissions') }}";
        // var url = url_web+'/search/wedding-'+sel_cat+'/'+sel_loc+fdata+qdata;
        var url = '/search/wedding-'+sel_cat+'/'+sel_loc+fdata+qdata;
        window.location = url;
    });
  });
  </script>
@endsection
