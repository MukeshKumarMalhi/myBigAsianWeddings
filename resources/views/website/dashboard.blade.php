@extends('layouts.app')
@section('title','Wedding planner')

@section('content')

  <!-- Page Content -->
  <!-- Navbar links -->
      <div class="shadow">
        <div class="container py-3">
          <h2>Our wedding summary</h2>
          <label class="d-block">
            <div class="underline-on-hover reset_password" style="color: #537cd7; font-weight: 600;"><i class="far fa-play-circle" aria-hidden="true"></i><span> Watch how myBigAsianWedding works</span></div>
          </label>
        </div>
      </div>
      <div class="container py-4">
        <div class="row no-gutters-8">
          <div class="col-md-12 col-lg-7">
            <div class="bs-card-sizer bg-center-url text-center text-white" style="background-image:url('web_asset/images/wedding-venues/venues-home-block.jpg');">
                <div class="p-4"><h2 class="mb-4">Wedding Venues</h2>
                  <a href="{{ url('search') }}/wedding-venues/{{ strtolower($user->location_name) }}" class="btn btn-dark btn-purple rounded">Search</a>
                </div>
            </div>
          </div>
          <div class="col-md-12 col-lg-5">
            <div class="row no-gutters-8">
                <div class="col-md-6">
                  <div class="bs-card-sizer mb-3 bg-center-url text-center text-white" style="background-image:url('web_asset/images/wedding-venues/photographers-home-tile.jpg');">
                      <div class="p-4"><h3 class="mb-2">Wedding Photographers</h3>
                        <a href="{{ url('search') }}/wedding-photographers/{{ strtolower($user->location_name) }}" class="btn btn-dark btn-purple rounded">Search</a>
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bs-card-sizer mb-3 bg-center-url text-center text-white" style="background-image:url('web_asset/images/wedding-venues/caterers-home-tile.jpg');">
                      <div class="p-4"><h3 class="mb-2">Wedding Caterers</h3>
                        <a href="{{ url('search') }}/wedding-catering/{{ strtolower($user->location_name) }}" class="btn btn-dark btn-purple rounded">Search</a>
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bs-card-sizer mb-3 bg-center-url text-center text-white" style="background-image:url('web_asset/images/wedding-venues/florists-home-tile.jpg');">
                      <div class="p-4"><h3 class="mb-2">Wedding Florists</h3>
                        <a href="{{ url('search') }}/wedding-florists/{{ strtolower($user->location_name) }}" class="btn btn-dark btn-purple rounded">Search</a>
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="bs-card-sizer mb-3 bg-center-url text-center text-white" style="background-image:url('web_asset/images/wedding-venues/cakes-home-tile.jpg');">
                      <div class="p-4"><h3 class="mb-2">Wedding Cakes</h3>
                        <a href="{{ url('search') }}/wedding-cakes/{{ strtolower($user->location_name) }}" class="btn btn-dark btn-purple rounded">Search</a>
                      </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="signup-popup" tabindex="-1" role="dialog" aria-labelledby="signup-popupLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" style="max-width: 940px;" role="document">
          <div class="modal-content bg-lightgrey">
             <div class="signup-box p-3">
              <form id="steps-form" role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                @csrf
                  <div class="owl-carousel bs-carousel-steps">
                      <!-- step 1 -->
                      <div class="card mb-3 step1" data-dot='<span></span>'>
                          <div class="row no-gutters">
                              <div class="col-md-4">
                                  <div class="bg-center-left-url h-100 bs-signup-columns-box-img rounded-top rounded-md-left" style="background-image: url('web_asset/images/bg-signup-img7.png');"></div>
                              </div>
                              <div class="col-md-8">
                                  <div class="p-4 bs-steps-height">
                                      <div class="form-group">

                                          <div class="float-right ml-2 my-1"><span class="owl-btn StepPrevBtn"><i class="fal fa-long-arrow-left"></i> Back</span> | <span class="owl-btn StepSkip">Skip <i class="fal fa-long-arrow-right"></i></span></div>
                                          <h3 class="font-weight-bold text-pink">Complete profile</h3>
                                      </div>
                                      <div class="mt-5">
                                          <div class="form-group bs-form-db">
                                              <label class="text-pink font-weight-bold mb-2" for="Profile">Profile</label>
                                              <div class="d-block">
                                              <label class="bg-purple d-inline-block rounded-circle border-bottom p-0 m-0" for="image">
                                                  <img id="blah" src="{{ url('web_asset/images/photos/add-person-icon.png') }}" style="width: 70px; height: 70px;" class="img-fluid rounded-circle">
                                                  <input id="image" type="file" name="user_image" accept="image/*" onchange="readURL(this);" class="form-control d-none" required>
                                              </label>
                                              </div>
                                              <script type="text/javascript">
                                                  function readURL(input) {
                                                      if (input.files && input.files[0]) {
                                                      var reader = new FileReader();
                                                      reader.onload = function (e) {
                                                          $('#blah')
                                                              .attr('src', e.target.result);
                                                      };
                                                      reader.readAsDataURL(input.files[0]);
                                                  }
                                              }
                                              </script>
                                          </div>
                                      </div>
                                      <div class="row mb-5">
                                        <div class="col-sm-8">
                                            <div class="form-group bs-form-db bs-select-pink">
                                                <label class="text-pink font-weight-bold">Account Type</label>
                                                <select class="form-control form-control-sm bs-selectcustom-ul" name="account_type">
                                                    <option data-class="icon-bride bs-option-pink" value="bride">Bride</option>
                                                    <option data-class="icon-groom bs-option-pink" value="groom">Groom</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-8">
                                              <div class="form-group bs-form-db bs-select-pink">
                                                <label class="text-pink font-weight-bold">Full Name</label>
                                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Your full name">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            </div>
                                        </div>

                                      </div>
                                      <div class="row mt-5">
                                          <div class="col-sm-7">
                                          </div>
                                          <div class="col-sm-5">
                                              <div class="form-group">
                                                  <button type="button" class="btn btn-dark btn-block btn-purple StepNextBtn font-weight-bold mb-2">Next Step</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                           <!-- step 2 -->
                      <div class="card mb-3 step2" data-dot='<span></span>'>
                          <div class="row no-gutters">
                              <div class="col-md-4">
                                  <div class="bg-center-url h-100 bs-signup-columns-box-img rounded-top rounded-md-left" style="background-image: url('web_asset/images/bg-signup-img3.png');"></div>
                              </div>
                              <div class="col-md-8">
                                  <div class="p-4 bs-steps-height">
                                      <div class="form-group">
                                          <div class="float-right ml-2 my-1"><span class="owl-btn StepPrevBtn"><i class="fal fa-long-arrow-left"></i> Back</span> | <span class="owl-btn StepSkip">Skip <i class="fal fa-long-arrow-right"></i></span></div>
                                          <h3 class="font-weight-bold text-pink">What planning have you done so far?</h3>
                                      </div>

                                      <div class="row mt-5">
                                          <div class="col-sm-7">
                                              <div class="form-group bs-form-db text-purple bs-help-block-inline">
                                                  <div class="form-check bs-custom-checkbox bs-checkboxpurple mb-2">
                                                      <input id="step2-1" type="checkbox" class="form-check-input" name="planning_done[]" value="We have a rough budget in mind">
                                                      <label class="form-check-label d-inline-block" for="step2-1"> We have a rough budget in mind</label>
                                                  </div>
                                              </div>
                                              <div class="form-group bs-form-db text-purple bs-help-block-inline">
                                                  <div id="step2-2" class="form-check bs-custom-checkbox bs-checkboxpurple mb-2">
                                                      <input type="checkbox" class="form-check-input" name="planning_done[]" value="We know who we'll be inviting">
                                                      <label class="form-check-label d-inline-block" for="step2-2"> We know who we'll be inviting</label>
                                                  </div>
                                              </div>
                                              <div class="form-group bs-form-db text-purple bs-help-block-inline">
                                                  <div id="step2-3" class="form-check bs-custom-checkbox bs-checkboxpurple mb-2">
                                                      <input type="checkbox" class="form-check-input" name="planning_done[]" value="We know the style of venue we want">
                                                      <label class="form-check-label d-inline-block" for="step2-3"> We know the style of venue we want</label>
                                                  </div>
                                              </div>
                                              <div class="form-group bs-form-db text-purple bs-help-block-inline">
                                                  <div class="form-check bs-custom-checkbox bs-checkboxpurple mb-2">
                                                      <input id="step2-4" type="checkbox" class="form-check-input" name="planning_done[]" value="We've decided on our venue">
                                                      <label class="form-check-label d-inline-block" for="step2-4"> We've decided on our venue</label>
                                                  </div>
                                              </div>
                                              <div class="form-group bs-form-db text-purple bs-help-block-inline">
                                                  <div class="form-check bs-custom-checkbox bs-checkboxpurple mb-2">
                                                      <input id="step2-5" type="checkbox" class="form-check-input" name="planning_done[]" value="We've already set the date!">
                                                      <label class="form-check-label d-inline-block" for="step2-5"> We've already set the date!</label>
                                                  </div>
                                              </div>
                                              <div class="form-group bs-form-db text-purple bs-help-block-inline">
                                                  <div class="form-check bs-custom-checkbox bs-checkboxpurple mb-2">
                                                      <input id="step2-6" type="checkbox" class="form-check-input" name="planning_done[]" value="We haven't started at all">
                                                      <label class="form-check-label d-inline-block" for="step2-6"> We haven't started at all</label>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-sm-5">
                                              <div class="form-group my-md-4 text-center">
                                                  <img src="{{ asset('web_asset/images/step2-icon.png') }}" class="img-fluid" alt=""/>
                                              </div>
                                              <div class="form-group">
                                                  <button type="button" class="btn btn-dark btn-block btn-purple StepNextBtn font-weight-bold mb-2">Next Step</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- step 3 -->
                      <div class="card mb-3 step3" data-dot='<span></span>'>
                          <div class="row no-gutters">
                              <div class="col-md-4">
                                  <div class="bg-center-left-url h-100 bs-signup-columns-box-img rounded-top rounded-md-left" style="background-image: url('web_asset/images/bg-signup-img7.png');"></div>
                              </div>
                              <div class="col-md-8">
                                  <div class="p-4 bs-steps-height">
                                      <div class="form-group">
                                          <div class="float-right ml-2 my-1"><span class="owl-btn StepPrevBtn"><i class="fal fa-long-arrow-left"></i> Back</span></div>
                                          <h3 class="font-weight-bold text-pink">Have you booked your wedding reception venue?</h3>
                                      </div>

                                      <div class="row mt-5">
                                          <div class="col-sm-7">
                                              <!-- radiobox-input buttom -->
                                              <div class="nav nav-tabs btn-group btn-group-toggle bs-sigup-radio link-purple" data-toggle="buttons">
                                                  <a class="btn btn-default active" data-toggle="tab" href="#step3-radiobox1" for="ywh">
                                                      <input id="ywh" class="VenueBooked" type="radio" name="VenueBooked" value="1" required checked/> Yes, We here!
                                                  </a>
                                                  <a class="btn btn-default border-left" data-toggle="tab" href="#step3-radiobox2" for="nny">
                                                      <input id="nny" class="VenueBooked" type="radio" name="VenueBooked" value="0" required/> No, not yet
                                                  </a>
                                              </div>

                                              <div class="tab-content">
                                                  <!-- Yes, We here! -->
                                                  <div class="tab-pane fade active show" id="step3-radiobox1">
                                                      <div class="my-4">
                                                          <h5 class="text-purple mb-3">Great! let's add your venue to your Asian Wedding</h5>
                                                          <div class="form-group bs-form-db">
                                                              <label class="text-pink font-weight-bold" for="venuename">Your wedding venue name?</label>
                                                              <input id="venuename" type="text" class="form-control venuename" name="venuename" autocomplete="off">
                                                              <input type="hidden" id="weeding_location" name="weeding_location" value="">
                                                              <input type="hidden" id="location_id" name="location_id" value="">
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <!-- No, not yet -->
                                                  <div class="tab-pane fade" id="step3-radiobox2">
                                                      <div class="my-4">
                                                          <h5 class="text-purple mb-3">Select a location for your first venue search:</h5>
                                                          <div class="form-group bs-form-db">
                                                              <label class="text-pink font-weight-bold" for="areaofpk">Enter a UK city, country or region</label>
                                                              <input id="areaofpk" type="text" class="form-control areaofpk" name="areaofpk" autocomplete="off">
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="form-group bs-form-db text-purple">
                                                  <div class="form-check bs-custom-checkbox bs-checkboxpurple mb-2">
                                                      <input id="doitlate" type="checkbox" class="form-check-input">
                                                      <label class="form-check-label d-inline-block" for="doitlate"> We'll do it later</label>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-sm-5">
                                              <div class="form-group my-md-4 text-center">
                                                  <img src="{{ asset('web_asset/images/step3-icon.png') }}" class="img-fluid" alt=""/>
                                              </div>
                                              <div class="form-group">
                                                  <button type="button" class="btn btn-dark btn-block btn-purple StepNextBtn font-weight-bold mb-2">Next Step</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- step 4 -->
                      <div class="card mb-3 step4" data-dot='<span></span>'>
                          <div class="row no-gutters">
                              <div class="col-md-4">
                                  <div class="bg-center-left-url h-100 bs-signup-columns-box-img rounded-top rounded-md-left" style="background-image: url('web_asset/images/bg-signup-img5.png');"></div>
                              </div>
                              <div class="col-md-8">
                                  <div class="p-4 bs-steps-height">
                                      <div class="form-group">
                                          <div class="float-right ml-2 my-1"><span class="owl-btn StepPrevBtn"><i class="fal fa-long-arrow-left"></i> Back</span></div>
                                          <h3 class="font-weight-bold text-pink">How many people are you thinking of inviting?</h3>
                                      </div>
                                      <div class="row mt-5">
                                          <div class="col-sm-7">
                                              <h5 class="text-purple mb-3">This will help us show you suitable venues.</h5>
                                              <div class="form-group bs-form-db mb-4">
                                                  <label class="text-pink font-weight-bold" for="enog">Estimated number of guests?</label>
                                                  <input id="enog" type="text" class="form-control guestcount" onkeypress="return isNumber(event)" name="weeding_no_guests" placeholder="" required>
                                              </div>
                                              <div class="form-group bs-form-db text-purple">
                                                  <div class="form-check bs-custom-checkbox bs-checkboxpurple">
                                                      <input id="know-yet" type="checkbox" name="know-yet1" class="form-check-input">
                                                      <label class="form-check-label d-inline-block" for="know-yet"> We don't know yet</label>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-sm-5">
                                              <div class="form-group my-md-4 text-center">
                                                  <img src="{{ asset('web_asset/images/step4-icon.png') }}" class="img-fluid" alt=""/>
                                              </div>
                                              <div class="form-group">
                                                  <button type="button" class="btn btn-dark btn-block btn-purple StepNextBtn font-weight-bold mb-2">Next Step</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- step 5 -->
                      <div class="card mb-3 step5" data-dot='<span></span>'>
                          <div class="row no-gutters">
                              <div class="col-md-4">
                                  <div class="bg-center-left-url h-100 bs-signup-columns-box-img rounded-top rounded-md-left" style="background-image: url('web_asset/images/bg-signup-img4.png');"></div>
                              </div>
                              <div class="col-md-8">
                                  <div class="p-4 bs-steps-height">
                                      <div class="form-group">
                                          <div class="float-right ml-2 my-1"><span class="owl-btn StepPrevBtn"><i class="fal fa-long-arrow-left"></i> Back</span></div>
                                          <h3 class="font-weight-bold text-pink">What is your ideal wedding date?</h3>
                                          <h4 class="font-weight-bold append_date text-center" style="color: rgb(45, 186, 167);width: 351px;position: absolute;"></h4>
                                      </div>
                                      <div class="row mt-5">
                                          <div class="col-sm-7">
                                              <!-- Not radiobox-input buttom -->
                                              <div class="nav nav-tabs btn-group btn-group-toggle bs-sigup-radio link-purple" data-toggle="buttons">
                                                  <button type="button" class="btn btn-default active tabweddingyear">Year
                                                      <input type="radio" name="" checked value="Year" />
                                                  </button>
                                                  <button type="button" class="btn btn-default tabweddingmonth" disabled>Season/Month
                                                      <input type="radio" name="" value="Season/Month" />
                                                  </button>
                                                  <button type="button" class="btn btn-default tabweddingday" disabled>Day
                                                      <input type="radio" name="" value="Day" />
                                                  </button>
                                              </div>

                                              <div class="tab-content">
                                                  <!-- Year -->
                                                  <div class="tab-pane active step5-radiobox1" id="">
                                                      <div class="mt-4">
                                                          <h5 class="text-purple">Select a year</h5>
                                                          <input type="hidden" class="weeding_date" name="weeding_date">
                                                          <input type="hidden" class="weeding_year" name="weeding_year">
                                                          <input type="hidden" class="weeding_month_season" name="weeding_month_season">
                                                          <input type="hidden" class="weeding_day_date" name="weeding_day_date">
                                                          <div class="form-group bs-form-db">
                                                              <!-- Not radiobox-input buttom -->
                                                              <div class="btn-group-toggle bs-sigup-radio-purple" data-toggle="buttons">
                                                                  <label class="btn btn-light btn-grey yearlabel" for="selectyear1">
                                                                      <input id="selectyear1" class="weddingyear" type="radio" name="selectyear" value="2020" required/> 2020
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey yearlabel" for="selectyear2">
                                                                      <input id="selectyear2" class="weddingyear" type="radio" name="selectyear" value="2021" required/> 2021
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey yearlabel" for="selectyear3">
                                                                      <input id="selectyear3" class="weddingyear" type="radio" name="selectyear" value="2022" required/> 2022
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey yearlabel" for="selectyear4">
                                                                      <input id="selectyear4" class="weddingyear" type="radio" name="selectyear" value="2023" required/> 2023
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey yearlabel" for="selectyear5">
                                                                      <input id="selectyear5" class="weddingyear" type="radio" name="selectyear" value="2024" required/> 2024
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey yearlabel" for="selectyear6">
                                                                      <input id="selectyear6" class="weddingyear" type="radio" name="selectyear" value="2025" required/> 2025
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey yearlabel" for="selectyear7">
                                                                      <input id="selectyear7" class="weddingyear" type="radio" name="selectyear" value="2026" required/> 2026
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey yearlabel" for="selectyear8">
                                                                      <input id="selectyear8" class="weddingyear" type="radio" name="selectyear" value="2027" required/> 2027
                                                                  </label>
                                                              </div>
                                                          </div>
                                                          <h5 class="text-purple">Or select from the list</h5>
                                                          <div class="form-group bs-form-db">
                                                              <select class="form-control otherweddingyear" name="otheryear">
                                                                  <option value="">Select year</option>
                                                                  <option value="2020">2020</option>
                                                                  <option value="2021">2021</option>
                                                                  <option value="2022">2022</option>
                                                                  <option value="2023">2023</option>
                                                                  <option value="2024">2024</option>
                                                                  <option value="2025">2025</option>
                                                                  <option value="2026">2026</option>
                                                                  <option value="2027">2027</option>
                                                              </select>
                                                          </div>

                                                           <div class="form-check bs-custom-checkbox bs-checkboxpurple">
                                                              <input id="undecided_year" type="checkbox" name="undecided_year" class="form-check-input">
                                                              <label class="form-check-label d-inline-block" for="undecided_year"> Undecided on year</label>
                                                          </div>

                                                      </div>
                                                  </div>

                                                  <!-- Season/Month -->
                                                  <div class="tab-pane fade step5-radiobox2" id="">
                                                      <div class="mt-4">
                                                          <!-- Season/Month -->
                                                          <h5 class="text-purple">Select a season</h5>
                                                          <div class="form-group bs-form-db">
                                                              <div class="btn-group-toggle bs-sigup-radio-purple" data-toggle="buttons">
                                                                  <label class="btn btn-light btn-grey seasonlabel" for="selectseason1">
                                                                      <input id="selectseason1" type="radio" class="selectseason" name="selectseason" value="spring" required/><i class="fal fa-2x fa-flower" title="spring"></i>
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey seasonlabel" for="selectseason2">
                                                                      <input id="selectseason2" type="radio" class="selectseason" name="selectseason" value="summer" required/><i class="fal fa-2x fa-sun" title="summer"></i>
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey seasonlabel" for="selectseason3">
                                                                      <input id="selectseason3" type="radio" class="selectseason" name="selectseason" value="winter" required/><i class="fal fa-2x fa-snowflake" title="winter"></i>
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey seasonlabel" for="selectseason4">
                                                                      <input id="selectseason4" type="radio" class="selectseason" name="selectseason" value="autumn" required/><i class="fal fa-2x fa-feather-alt" title="autumn"></i>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                          <h5 class="text-purple">Or select a month</h5>
                                                          <div class="form-group bs-form-db">
                                                              <div class="btn-group-toggle bs-sigup-radio-purple" data-toggle="buttons">
                                                                  <label class="btn btn-light btn-grey monthlabel" for="selectmonth1">
                                                                      <input id="selectmonth1" type="radio" name="selectmonth" class="selectmonth" value="January" /> January
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel" for="selectmonth2">
                                                                      <input id="selectmonth2" type="radio" name="selectmonth" class="selectmonth" value="February" /> February
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel"  for="selectmonth3">
                                                                      <input id="selectmonth3" type="radio" name="selectmonth" class="selectmonth" value="March" /> March
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel"  for="selectmonth4">
                                                                      <input id="selectmonth4" type="radio" name="selectmonth" class="selectmonth" value="April" /> April
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel" for="selectmonth5">
                                                                      <input id="selectmonth5" type="radio" name="selectmonth" class="selectmonth" value="May" /> May
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel" for="selectmonth6">
                                                                      <input id="selectmonth6" type="radio" name="selectmonth" class="selectmonth" value="June" /> June
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel"  for="selectmonth7">
                                                                      <input id="selectmonth7" type="radio" name="selectmonth" class="selectmonth" value="July" /> July
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel" for="selectmonth8">
                                                                      <input id="selectmonth8" type="radio" name="selectmonth" class="selectmonth" value="August" /> August
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel"  for="selectmonth9">
                                                                      <input id="selectmonth9" type="radio" name="selectmonth" class="selectmonth" value="September" /> September
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel"  for="selectmonth10">
                                                                      <input id="selectmonth10" type="radio" name="selectmonth" class="selectmonth" value="October" /> October
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel"  for="selectmonth11">
                                                                      <input id="selectmonth11" type="radio" name="selectmonth" class="selectmonth" value="November" /> November
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey monthlabel"  for="selectmonth12">
                                                                      <input id="selectmonth12" type="radio" name="selectmonth" class="selectmonth" value="December" /> December
                                                                  </label>
                                                              </div>
                                                          </div>

                                                           <div class="form-check bs-custom-checkbox bs-checkboxpurple">
                                                              <input id="undecided_month" type="checkbox" name="undecided_month" class="form-check-input">
                                                              <label class="form-check-label d-inline-block" for="undecided_year"> Undecided month</label>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <!-- Day -->
                                                  <div class="tab-pane fade step5-radiobox3" id="">
                                                       <div class="mt-4">
                                                          <h5 class="text-purple">Select a day of the week</h5>
                                                          <div class="form-group bs-form-db">
                                                              <div class="btn-group-toggle bs-sigup-radio-purple" data-toggle="buttons">

                                                                  <label class="btn btn-light btn-grey weeklabel" for="Mondays">
                                                                      <input id="Mondays" type="radio" class="selectweek" name="selectweek" value="Monday" required/> Monday
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey weeklabel" for="Tuesday">
                                                                      <input id="Tuesday" type="radio" class="selectweek" name="selectweek" value="Tuesday" required/> Tuesday
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey weeklabel" for="Wednesday">
                                                                      <input id="Wednesday" type="radio" class="selectweek" name="selectweek" value="Wednesday" required/> Wednesday
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey weeklabel" for="Thursday">
                                                                      <input id="Thursday" type="radio" class="selectweek" name="selectweek" value="Thursday" required/> Thursday
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey weeklabel" for="Friday">
                                                                      <input id="Friday" type="radio" class="selectweek" name="selectweek" value="Friday" required/> Friday
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey weeklabel" for="Saturday">
                                                                      <input id="Saturday" type="radio" class="selectweek" name="selectweek" value="Saturday" required/> Saturday
                                                                  </label>
                                                                  <label class="btn btn-light btn-grey weeklabel" for="Sunday">
                                                                      <input id="Sunday" type="radio" class="selectweek" name="selectweek" value="Sunday" required/> Sunday
                                                                  </label>
                                                              </div>
                                                          </div>



                                                          <div class="mt-4 date_selector" id="">
                                                              <h5 class="text-purple">Or Select a Date</h5>
                                                              <div class="form-group">
                                                                  <div class="datepicker-show"></div>
                                                                  <input type="hidden" name="date" id="step5-date" class="calendarpicker">
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>

                                          </div>
                                          <div class="col-sm-5">
                                              <div class="form-group my-md-4 text-center">
                                                  <img src="{{ asset('web_asset/images/step5-icon.png') }}" class="img-fluid" alt=""/>
                                              </div>
                                              <div class="form-group">
                                                  <button type="button" class="btn btn-dark btn-block btn-purple StepNextBtn font-weight-bold mb-2">Next Step</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- step 6 -->
                      <div class="card mb-3 step6"  data-dot='<span></span>'>
                          <div class="row no-gutters">
                              <div class="col-md-4">
                                  <div class="bg-center-left-url h-100 bs-signup-columns-box-img rounded-top rounded-md-left" style="background-image: url('web_asset/images/bg-signup-img5.png');"></div>
                              </div>
                              <div class="col-md-8">
                                  <div class="p-4 bs-steps-height">
                                      <div class="form-group">
                                          <div class="float-right ml-2 my-1"><span class="owl-btn StepPrevBtn"><i class="fal fa-long-arrow-left"></i> Back</span></div>
                                          <h3 class="font-weight-bold text-pink">Do you have an overall wedding budget in mind?</h3>
                                      </div>
                                      <div class="row mt-5">
                                          <div class="col-sm-7">
                                              <h5 class="text-purple mb-3">The average Pakistan wedding costs around Rs.170,000.</h5>

                                              <div class="form-group bs-form-db">
                                                  <label class="text-pink font-weight-bold" for="ewb">Estimated Wedding Budget?</label>
                                                  <input type="text" class="form-control budget" onkeypress="return isNumber(event)" placeholder="" id="ewb" name="weeding_budget" required>
                                              </div>

                                              <div class="form-check bs-custom-checkbox bs-checkboxpurple">
                                                  <input id="know-yet2" type="checkbox" name="know-yet2" class="form-check-input undecided_budget">
                                                  <label class="form-check-label d-inline-block" for="know-yet2"> We don't know yet</label>
                                              </div>
                                          </div>
                                          <div class="col-sm-5">
                                              <div class="form-group my-md-4 text-center">
                                                  <img src="{{ asset('web_asset/images/step6-icon.png') }}" class="img-fluid" alt=""/>
                                              </div>
                                              <div class="form-group">
                                                  <button type="button" class="btn btn-dark btn-block btn-purple StepNextBtn font-weight-bold mb-2">Next Step</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- step 7 -->
                      <div class="card mb-3 step7" data-dot='<span></span>'>
                          <div class="row no-gutters">
                              <div class="col-md-4">
                                  <div class="bg-center-url h-100 bs-signup-columns-box-img rounded-top rounded-md-left" style="background-image: url('web_asset/images/bg-signup-img2.png');"></div>
                              </div>
                              <div class="col-md-8">
                                  <div class="p-4 bs-steps-height">
                                      <div class="form-group">
                                          <div class="float-right ml-2 my-1"><span class="owl-btn StepPrevBtn"><i class="fal fa-long-arrow-left"></i> Back</span> | <span class="owl-btn StepSkip">Skip <i class="fal fa-long-arrow-right"></i></span></div>
                                          <h3 class="font-weight-bold text-pink">Add your partner</h3>
                                      </div>
                                      <div class="row mt-5">
                                          <div class="col-sm-7">
                                              <h5 class="text-purple mb-3">Add your partner to your Shadi Tayari so you can plan your wedding together.</h5>

                                              <div class="form-group bs-form-db">
                                                  <label class="text-pink font-weight-bold" for="partner-email">Add your partner's email</label>
                                                  <input id="partner-email" name="partner_email" type="text" class="form-control" placeholder="" required>
                                              </div>

                                                <div class="form-group bs-form-db">
                                                  <label class="text-pink font-weight-bold" for="fnamel">First and last name</label>
                                                  <div class="input-group">
                                                      <div class="input-group-prepend"><span class="input-group-text rounded-0"><i class="fal fa-user text-pink"></i></span></div>
                                                      <input id="pnamel" name="partner_name" type="text" class="form-control pl-0" placeholder="First and last name of Partner" required>
                                                  </div>
                                               </div>
                                          </div>
                                          <div class="col-sm-5">
                                              <div class="form-group my-md-4 text-center">
                                                  <img src="{{ asset('web_asset/images/step7-icon.png') }}" class="img-fluid" alt=""/>
                                              </div>
                                              <div class="form-group">
                                                  <button type="button" class="btn btn-dark btn-block btn-purple StepNextBtn font-weight-bold mb-2">Invite</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- step 8 -->
                      <div class="card mb-3 step8" data-dot='<span></span>'>
                          <div class="row no-gutters">
                              <div class="col-md-4">
                                  <div class="bg-center-url h-100 bs-signup-columns-box-img rounded-top rounded-md-left" style="background-image: url('web_asset/images/bg-signup-img2.png');"></div>
                              </div>
                              <div class="col-md-8">
                                  <div class="p-4 bs-steps-height">
                                      <div class="form-group">
                                          <div class="float-right ml-2 my-1"><span class="owl-btn StepPrevBtn"><i class="fal fa-long-arrow-left"></i> Back</span></div>
                                          <h3 class="font-weight-bold text-pink">And finally...</h3>
                                      </div>
                                      <div class="row mt-5">
                                          <div class="col-sm-7">
                                              <h5 class="text-purple mb-3">All enquiries you send will come from this email address:</h5>

                                              <div class="form-group bs-form-db">
                                                  <label class="text-pink font-weight-bold" for="Confirm-email">Confirm your email address</label>
                                                  <input type="text" class="form-control" name="email" placeholder="" value="{{ Auth::user()->email }}" id="Confirm-email">
                                                  <div id="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; margin-top: 5px; margin-bottom: 30px; display: none;">
                                          					<ul></ul>
                                          				</div>
                                                  <!-- <div id="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; margin-top: 5px; margin-bottom: 30px; display: none;">
                                          					<ul></ul>
                                          				</div> -->
                                              </div>


                                          </div>
                                          <div class="col-sm-5">
                                              <div class="form-group my-md-4 text-center">
                                                  <img src="{{ asset('web_asset/images/step7-icon.png') }}" class="img-fluid" alt=""/>
                                              </div>
                                              <div class="form-group">
                                                  <button type="submit" class="btn btn-dark btn-block btn-purple font-weight-bold mb-2">Confirm</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- step 9 -->
                      <div class="card mb-3 step9" data-dot='<span></span>'>
                          <div class="row no-gutters">
                              <div class="col-md-4">
                                  <div class="bg-center-url h-100 bs-signup-columns-box-img rounded-top rounded-md-left" style="background-image: url('web_asset/images/bg-signup-img2.png');"></div>
                              </div>
                              <div class="col-md-8">
                                  <div class="p-4 bs-steps-height">
                                      <div class="form-group">
                                        <h3 class="font-weight-bold text-pink" id="congrats"></h3>
                                      </div>
                                      <div class="form-group my-md-4 text-center">
                                        <img src="{{ asset('web_asset/images/step7-icon.png') }}" class="img-fluid" alt=""/>
                                      </div>
                                      <div class="form-group">
                                        <button type="button" id="confirmed" class="btn btn-dark btn-block btn-purple font-weight-bold mb-2 done">Done</button>
                                      </div>
                                    </div>
                              </div>
                          </div>
                      </div>



                  </div>
              </form>
              </div>
          </div>
      </div>
  </div>

  <script type="text/javascript">
    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
      return true;
    }

    var path_c = "{{ url('/search_venues') }}";
    var venues = $('#venuename').typeahead({
      source: function (query, process)
      {
        return $.get(path_c, {query: query}, function(venues){
          return process(venues);
        });
      },
      displayText: function (venue)
      {
        return venue['name'] + ' \n Venues ' +venue['location_name'];
      }
    });

    $("#venuename").change(function()
    {
        var venue_id = $("#venuename").typeahead("getActive");
        $("#venuename").val(venue_id.name);
        $("#weeding_location").val(venue_id.name);
        $("#location_id").val(venue_id.location_id);
        $("#areaofpk").val(venue_id.location_name);
    });

    var path_l = "{{ url('/search_location') }}";
    var locations = $('.areaofpk').typeahead({
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

    $(".areaofpk").change(function()
    {
        var location_id = $(".areaofpk").typeahead("getActive");
        $("#location_id").val(location_id.location_id);
        $(".areaofpk").val(location_id.location_name);
        $(".location_change").text('');
        $(".location_change").text(location_id.location_name);
        var data = {'value': location_id.location_id, 'type': 'location'};
        var array = Object.keys(data).map(item => data[item]);
        update_user_data(array);
    });

    // $('.ajax_request').on('change', function(e) {
    //   e.preventDefault();
    //   var data = {'user_id': "{{ Auth::user()->id }}"};
    //   update_user_data(data);
    // });
    //
    // $('.ajax_request').on('keypress', function (e) {
    //   var data = {'user_id': "{{ Auth::user()->id }}"};
    //   if (e.keyCode == 13) {
    //     e.preventDefault();
    //     update_user_data(data);
    //   }
    // });


    function update_user_data(data) {
      var form_data = [{ 'user_id': "{{ Auth::user()->id }}", 'value': data[0], 'type': data[1] }];
      var json = JSON.stringify(form_data);
      $.ajax({
        url:"{{ url('/update_user_info') }}",
        method:"POST",
      	data:json,
        dataType:"JSON",
        contentType: "application/json; charset=utf-8",
      	cache:false,
      	processData:false,
      	success:function(response){
          // console.log(response);
          if(data[1] == 'name' || data[1] == 'partner_name'){
            if(response.name == null || response.partner_name == null){
              $('.groom_bride').text('');
              $('.groom_bride').text('Your Wedding ');
            }else {
              $('.groom_bride').text('');
              $('.groom_bride').text(response.name+' & '+response.partner_name+' ');
            }
          }
        },
      });
    }

    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var created_at = "{{ Auth::user()->created_at }}";
      var updated_at = "{{ Auth::user()->updated_at }}";
      if(created_at == updated_at){
        $("#signup-popup").modal({
          backdrop: 'static',
          keyboard: false
        });
      }


      $('input:radio[name="selectyear"]').on('change', function() {
        var d_year = $(this).val();
        $('.append_date').text('');
        $('.append_date').append(d_year);
      });

      $('.otherweddingyear').on('change', function() {
        var d_year = $(this).val();
        $('.append_date').text('');
        $('.append_date').append(d_year);
      });

      $('input:radio[name="selectseason"]').on('change', function() {
        $('.date_selector').hide();
        var d_season = $(this).val();

        var checkBoxClassesYear = [];
        y_d = $('select[name="otheryear"] option').filter(':selected').val();
        checkBoxClassesYear.push(y_d);
        y_d = $('input:radio[name="selectyear"]:checked').val();
        checkBoxClassesYear.push(y_d);

        showYear = checkBoxClassesYear.filter(Boolean);
        new_yd = showYear[0];

        $('.append_date').text('');
        $('.append_date').append(new_yd+' '+d_season+' ');

      });

      $('input:radio[name="selectmonth"]').on('change', function() {
        $('.date_selector').show();
        var d_month = $(this).val();

        var checkBoxClassesYear = [];
        y_d = $('select[name="otheryear"] option').filter(':selected').val();
        checkBoxClassesYear.push(y_d);
        y_d = $('input:radio[name="selectyear"]:checked').val();
        checkBoxClassesYear.push(y_d);

        showYear = checkBoxClassesYear.filter(Boolean);
        new_yd = showYear[0];

        $('.append_date').text('');
        $('.append_date').append(new_yd+' '+d_month+' ');

        var months = {'January' : '1', 'February' : '2', 'March' : '3', 'April' : '4', 'May' : '5', 'June' : '6', 'July' : '7', 'August' : '8', 'September' : '9', 'October' : '10', 'November' : '11', 'December' : '12'};
        $.each( months, function( key, value ) {
          if(key == d_month){
            var startDate = new Date(new_yd, value-1);
            $(".datepicker-show").datepicker("setDate", startDate);
          }
        });
      });

      $('input:radio[name="selectweek"]').on('change', function() {
        var d_day = $(this).val();
        var checkBoxClassesYear = [];
        y_d = $('select[name="otheryear"] option').filter(':selected').val();
        checkBoxClassesYear.push(y_d);
        y_d = $('input:radio[name="selectyear"]:checked').val();
        checkBoxClassesYear.push(y_d);

        showYear = checkBoxClassesYear.filter(Boolean);
        new_yd = showYear[0];

        var checkBoxClassesMonth = [];
        m_d = $('input:radio[name="selectseason"]:checked').val();
        checkBoxClassesMonth.push(m_d);
        m_d = $('input:radio[name="selectmonth"]:checked').val();
        checkBoxClassesMonth.push(m_d);

        showMonth = checkBoxClassesMonth.filter(Boolean);
        new_md = showMonth[0];

        $('.append_date').text('');
        $('.append_date').append('A '+d_day+' in '+new_md+' '+new_yd);
        $('.wedding-date-setting-btn').val('');
        $('.wedding-date-setting-btn').val('A '+d_day+' in '+new_md+' '+new_yd);
        $('.weeding_date').val('');
        $('.weeding_date').val('A '+d_day+' in '+new_md+' '+new_yd);
        $('.weeding_year').val(new_yd);
        $('.weeding_month_season').val(new_md);
        $('.weeding_day_date').val(d_day);
      });

      $(".datepicker-show").datepicker({ dateFormat: "dd" });
      $('#step5-date').change(function(){
          $('.datepicker-show').datepicker('setDate', $(this).val());
      });
      $('.datepicker-show').change(function(){
          $('#step5-date').attr('value',$(this).val());
           $('.selectweek').prop('checked', false);
          $('.selectweek').removeAttr('required');
          $(".weeklabel").removeClass('active');
      });

      var months = {'January' : '1', 'February' : '2', 'March' : '3', 'April' : '4', 'May' : '5', 'June' : '6', 'July' : '7', 'August' : '8', 'September' : '9', 'October' : '10', 'November' : '11', 'December' : '12'};
      $.each( months, function( key, value ) {
        if(key == "{{ $user->weeding_month_season }}"){
          $('.date_selector').show();
          var startDate = new Date("{{ $user->weeding_year }}", value-1, "{{ $user->weeding_day_date }}");
          $(".datepicker-show").datepicker("setDate", startDate);
        }
      });




      $('.datepicker-show').on('change', function() {

        var d_day = $(this).val();
        var checkBoxClassesYear = [];
        y_d = $('select[name="otheryear"] option').filter(':selected').val();
        checkBoxClassesYear.push(y_d);
        y_d = $('input:radio[name="selectyear"]:checked').val();
        checkBoxClassesYear.push(y_d);

        showYear = checkBoxClassesYear.filter(Boolean);
        new_yd = showYear[0];

        var checkBoxClassesMonth = [];
        m_d = $('input:radio[name="selectseason"]:checked').val();
        checkBoxClassesMonth.push(m_d);
        m_d = $('input:radio[name="selectmonth"]:checked').val();
        checkBoxClassesMonth.push(m_d);

        showMonth = checkBoxClassesMonth.filter(Boolean);
        new_md = showMonth[0];

        $('.append_date').text('');
        $('.append_date').append(d_day+' '+new_md+' '+new_yd);
        $('.wedding-date-setting-btn').val('');
        $('.wedding-date-setting-btn').val(d_day+' '+new_md+' '+new_yd);
        $('.weeding_date').val('');
        $('.weeding_date').val(d_day+' '+new_md+' '+new_yd);
        $('.weeding_year').val(new_yd);
        $('.weeding_month_season').val(new_md);
        $('.weeding_day_date').val(d_day);
      });

      $('#steps-form').on('submit', function(event){
    		event.preventDefault();
        $.ajax({
          url:"{{ url('/complete_profile') }}",
          method:"POST",
    			data:new FormData(this),
          dataType:"JSON",
    			contentType:false,
    			cache:false,
    			processData:false,
    			success:function(data){
    				$('#append_errors ul').text('');
    				$('#append_success ul').text('');
            if(data.errors)
            {
    					$.each(data.errors, function(i, error){
    						$('#append_errors').show();
                $('#append_errors ul').append("<li>" + data.errors[i] + "</li>");
            	});
            }else {
    					$('#append_errors').hide();
    					$('#append_success').show();
    					$('#congrats').append('Congratulations, your profile is updated');
            }
          },
        });
      });

      $('#update-date-ajax').on('submit', function(event){
    		event.preventDefault();
        $.ajax({
          url:"{{ url('/update_date_ajax') }}",
          method:"POST",
    			data:new FormData(this),
          dataType:"JSON",
    			contentType:false,
    			cache:false,
    			processData:false,
    			success:function(data){
            if(data.weeding_date == "" || data.weeding_days_remaining == ""){
              $('.weeding_date_ajax').text('');
              $('.weeding_date_ajax').text('No weeding date yet ');
              $('.weeding_days_count_ajax').text('');
            }else {
              $('.weeding_date_ajax').text('');
              $('.weeding_date_ajax').text(data.weeding_date);
              $('.weeding_days_count_ajax').text('');
              $('.weeding_days_count_ajax').text(data.weeding_days_remaining+' days to go!');
            }
            $('#setting-date-popup').modal('hide');
            location.reload();
          },
        });
      });

      $('.done').on('click', function functionName(event) {
        event.preventDefault();
        location.reload();
      });
      $('.wedding-date-setting-btn').on('click', function functionName(event) {
          $('#setting-date-popup').modal(open);
      });
    });
  </script>
  <style type="text/css">
    .step3 .typeahead.dropdown-menu a.dropdown-item::first-line,.step3 .typeahead.dropdown-menu a.dropdown-item:first-line {white-space: pre-line; line-height:23px;color:#000000;}
    .step3 .typeahead.dropdown-menu a.dropdown-item{white-space: pre-line; line-height:23px;color:#8a8484;}
      .form-control{
        border-radius: 5px;
      }
      .bs-card-sizer.bg-center-url{position:relative;padding-top:50%;}
.bs-card-sizer:before{
    position:absolute;
    content:'';
    display:block;
    width:100%;
    height:100%;
    left:0;
    top:0;
    background: linear-gradient(rgba(0, 0, 0, 0) 60%, rgb(0, 0, 0) 100%);
}
.bs-card-sizer>div{position:relative;}
  </style>
@endsection
