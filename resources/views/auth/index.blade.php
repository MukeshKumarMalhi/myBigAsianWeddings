@extends('layouts.app')
@section('title','Wedding planner')

@section('content')

<!-- section 1 free wedding planning app-->
<div class="pt-r10 bg-center-url" style="background-image: url('web_asset/images/bg-home.png');">
    <div class="container bs-search-form text-center link-light text-light py-80 mb-5">
        <h2 class="font-weight-bold mb-4 font-playfairdisplay">FREE Wedding Planning App</h2>
        <!-- <h5>Search over 14,000 local professionals with reviews, pricing, availability, and more</h5> -->
        <form class="text-center sub_header_search_form" method="get">
          @csrf
          <div class="mx-auto text-left">
            <div class="row pt-3 no-gutters">
              <div class="col-md-3">
              </div>
              <div class="form-group col-md-4">
                <div class="d-md-table align-middle">
                  <div class="d-md-table-cell pt-1 pr-2 text-white text-nowrap">We’re looking for </div>
                  <div class="d-md-table-cell w-100 disabled_custom">
                    <select name="category_id_searched" class="form-control category_search_form" style="border-radius: 5px;">
                      <?php foreach ($categories as $key => $value): ?>
                        <option value="{{ $value->id }}" <?php if($value->category_name == "Venues") echo "selected"; ?>>{{ $value->category_name }}</option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-1 pl-md-3">
                  <button type="submit" class="btn btn-dark btn-block btn-purple rounded">Search</button>
              </div>
            </div>
            </div>
        </form>
        <!-- <p>Wedding Venues, Wedding Photography, Wedding Music, Wedding Transportation, Wedding Invitations, Wedding Dresses, Wedding Flowers</p> -->
    </div>
    <div class="bg-purple-b">
        <div class="container">
            <div class="row no-gutters-10 text-center">
                <div class="col-6 col-md-4 col-lg">
                    <div class="bs-white-box bg-light p-3 mb-3">
                        <img src="{{ asset('web_asset/images/checklist-icon.png') }}" class="img-fluid m-auto">
                        <h3 class="font-weight-bold font-playfairdisplay">Checklist.</h3>
                        <p>Organise your wedding with a complete step-wise guide for every arrangement.</p>
                        <div class="bs-white-box-button"><a href="#">Learn More <i class="far fa-chevron-double-right"></i></i></a></div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg">
                    <div class="bs-white-box bg-light p-3 mb-3">
                        <img src="{{ asset('web_asset/images/budget-icon.png') }}" class="img-fluid m-auto">
                        <h3 class="font-weight-bold font-playfairdisplay">Budget.</h3>
                        <p>Plan and manage your expenses with the right budgeting.</p>

                        <div class="bs-white-box-button"><a href="#">Learn More <i class="far fa-long-arrow-right"></i></a></div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg">
                    <div class="bs-white-box bg-light p-3 mb-3">
                        <img src="{{ asset('web_asset/images/guest-list-icon.png') }}" class="img-fluid m-auto">
                        <h3 class="font-weight-bold font-playfairdisplay">Guest list.</h3>
                        <p>Easily track your guests for every event.</p>
                        <div class="bs-white-box-button"><a href="#">Learn More <i class="far fa-long-arrow-right"></i></a></div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg offset-md-2 offset-lg-0">
                    <div class="bs-white-box bg-light p-3 mb-3">
                        <img src="{{ asset('web_asset/images/shortlist-icon.png') }}" class="img-fluid m-auto">
                        <h3 class="font-weight-bold font-playfairdisplay">Shortlist.</h3>
                        <p>Bookmark your favorite wedding suppliers to the best deals.</p>
                        <div class="bs-white-box-button"><a href="#">Learn More <i class="far fa-long-arrow-right"></i></a></div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg">
                    <div class="bs-white-box bg-light p-3 mb-3">
                        <img src="{{ asset('web_asset/images/gift-lists-icon.png') }}" class="img-fluid m-auto">
                        <h3 class="font-weight-bold font-playfairdisplay">Gift Lists.</h3>
                        <p>Please everyone with the best gift options at your tips.</p>
                        <div class="bs-white-box-button"><a href="#">Learn More <i class="far fa-long-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-purple pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <div class="link-light text-light">
                    <h2 class="font-weight-bold">The easiest way to plan <span class="font-playfairdisplay">your wedding</span></h2>
                    <p>"When I first started my wedding planning, I had no idea where to begin! But by using Bridebook I have been able to search for all of my suppliers, as well as organise my guestlist, checklist and budget. I now feel so much more relaxed about the wedding!"</p>
                </div>
                <a href="#" class="btn btn-light text-purple">Click Here</a>
            </div>
            <div class="col-md-6 align-self-center">
                <img src="https://via.placeholder.com/700x400" class="img-fluid" alt="" />
            </div>
        </div>
    </div>
    <div class="bg-white-b py-100"></div>
</div>
<!-- section 2 How It Works-->
<div class="pb-80">
    <div class="container text-center ">
        <div class="pb-5">
            <h2 class="text-purple font-weight-bold">How <span class="font-playfairdisplay">It Works</span></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </p>
        </div>
        <img src="{{ asset('web_asset/images/how-it-works-img.png') }}" class="img-fluid" alt="" />
    </div>
</div>
<!-- section 3-->
<div class="py-80 Popular Venue Searches">
    <div class="container text-center pb-5">
        <h2 class="text-purple font-weight-bold">Popular <span class="font-playfairdisplay">Venue Searches</span></h2>
    </div>
    <div class="container pb-5 text-purple link-purple" style="max-width: 800px;">
        <div class="row">
            <div class="col-6 col-md-3">
                <p>Essex</p>
                <p>Kent</p>
                <p>Surrey</p>
                <p>Hampshire</p>
            </div>
            <div class="col-6 col-md-3">
                <p>Hertfordshire</p>
                <p>Yorkshire</p>
                <p>Buckinghamshire</p>
                <p>Lancashire</p>
            </div>
            <div class="col-6 col-md-3">
                <p>West Midlands</p>
                <p>Leicestershire</p>
                <p>Northamtonshire</p>
                <p>Oxfordshire</p>
            </div>
            <div class="col-6 col-md-3">
                <p>London</p>
                <p>Scotland</p>
                <p>Northern Ireland</p>
                <p>Wales</p>
            </div>
        </div>
    </div>
</div>
<!-- section 4 Plan anywhere, anytime-->
<div class="bg-grey py-80 py-md-0">
    <div class="container">
        <div class="row">
            <div class="col-md-6 align-self-center text-center">
                <div class="bs-my-n30-md">
                    <img src="{{ asset('web_asset/images/mobiles.png') }}" class="img-fluid" alt="" />
                </div>
            </div>
            <div class="col-md-6 align-self-center">
                <div class="py-5">
                    <h2 class="text-purple font-weight-bold"><span class="font-playfairdisplay">Plan anywhere, anytime</span></h2>
                    <p>The Weddified app is designed with busy modern couples like you in mind. You can now both simultaneously plan your wedding on the go, wherever that might be! Never lose track of your planning again with Weddified.</p>
                    <div class="pt-2">
                        <img src="{{ asset('web_asset/images/appstore.jpg') }}" class="img-fluid mr-2     mb-3" alt="appstore"> <img src="{{ asset('web_asset/images/icon_bt_googlePlay.jpg') }}" class="img-fluid mr-2 mb-3" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section 5 Latest Blogs -->
<div class="container py-80">
    <div class="bg-purple p-3 p-sm-4 p-lg-5 bs-latebs-blogs">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-light link-light mb-3">
                    <h3 class="font-weight-bold">Latest Blogs</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-light p-3 mb-3">
                    <div class="row no-gutters-5">
                        <div class="col-4 col-md-4">
                            <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="mb-1 text-purple link-purple small">
                                <div class="d-inline-block mr-2">January 28,2019 </div>
                                <div class="d-inline-block font-weight-bold">
                                    <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                </div>
                            </div>
                            <h4 class="font-weight-bold link-purple"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-light p-3 mb-3">
                    <div class="row no-gutters-5">
                        <div class="col-4 col-md-4">
                            <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="mb-1 text-purple link-purple small">
                                <div class="d-inline-block mr-2">January 28,2019 </div>
                                <div class="d-inline-block font-weight-bold">
                                    <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                </div>
                            </div>
                            <h4 class="font-weight-bold link-purple"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-light p-3 mb-3">
                    <div class="row no-gutters-5">
                        <div class="col-4 col-md-4">
                            <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="mb-1 text-purple link-purple small">
                                <div class="d-inline-block mr-2">January 28,2019 </div>
                                <div class="d-inline-block font-weight-bold">
                                    <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                </div>
                            </div>
                            <h4 class="font-weight-bold link-purple"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-light p-3 mb-3">
                    <div class="row no-gutters-5">
                        <div class="col-4 col-md-4">
                            <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="mb-1 text-purple link-purple small">
                                <div class="d-inline-block mr-2">January 28,2019 </div>
                                <div class="d-inline-block font-weight-bold">
                                    <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                </div>
                            </div>
                            <h4 class="font-weight-bold link-purple"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-light p-3 mb-3">
                    <div class="row no-gutters-5">
                        <div class="col-4 col-md-4">
                            <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="mb-1 text-purple link-purple small">
                                <div class="d-inline-block mr-2">January 28,2019 </div>
                                <div class="d-inline-block font-weight-bold">
                                    <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                </div>
                            </div>
                            <h4 class="font-weight-bold link-purple"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-light p-3 mb-3">
                    <div class="row no-gutters-5">
                        <div class="col-4 col-md-4">
                            <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="mb-1 text-purple link-purple small">
                                <div class="d-inline-block mr-2">January 28,2019 </div>
                                <div class="d-inline-block font-weight-bold">
                                    <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                </div>
                            </div>
                            <h4 class="font-weight-bold link-purple"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-light p-3 mb-3">
                    <div class="row no-gutters-5">
                        <div class="col-4 col-md-4">
                            <img src="https://via.placeholder.com/400x400" class="img-fluid w-100">
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="mb-1 text-purple link-purple small">
                                <div class="d-inline-block mr-2">January 28,2019 </div>
                                <div class="d-inline-block font-weight-bold">
                                    <a href="#" class=" mr-2"><i class="fas fa-comment"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-eye"></i> 10</a>
                                    <a href="#" class=" mr-2"><i class="fas fa-thumbs-up"></i> 10</a>
                                </div>
                            </div>
                            <h4 class="font-weight-bold link-purple"><a href="#">How Nick Jonas proposed to Priyanka Chopra</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section 6 Start today, it’s fee-->
<div class="bg-bs-home2 pb-100 text-purple text-center">
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <div class="pt-80 pb-100">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <br>
                    <a class="btn btn-lg btn-dark btn-purple mr-2 mb-2 font-weight-bold" href="#">Start today, it’s fee</a>
                </div>
            </div>
        </div>
        <div class="pb-100">
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
    </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  });
  </script>


@endsection
