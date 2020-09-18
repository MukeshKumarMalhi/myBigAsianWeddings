@extends('layouts.app')
@section('title','Wedding planner')

@section('content')
<div style="background-color: #4E2A5E;">
  <div class="container">
  <form class="text-center sub_header_search_form" method="get">
    @csrf
    <div class="mx-auto text-left">
      <div class="row form-group pt-3 pb-2 mb-0 no-gutters">
        <div class="form-group col-md-4">
          <div class="d-md-table align-middle">
            <div class="d-md-table-cell pt-1 pr-2 text-white text-nowrap">We’re looking for </div>
            <div class="d-md-table-cell w-100">
              <select name="category_id_searched" class="form-control category_search_form">
                <?php foreach ($categories as $key => $value): ?>
                  <option value="{{ $value->id }}" <?php if($value->id == $category_id->id) echo "selected"; ?>>{{ $value->category_name }}</option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group col-md-3">
          <div class="d-md-table align-middle">
            <div class="d-md-table-cell pt-1 pr-1 text-white text-nowrap px-md-4">near</div>
            <div class="d-md-table-cell w-100">
              <input type="text" name="location_name_searched" placeholder="Location" class="form-control areaofp location_name_searched" value="{{ $location_id->location_name }}" autocomplete="off">
              <input type="hidden" name="location_id_searched" class="location_id_searched" value="{{ $location_id->id }}">
              <input type="hidden" name="category_name_searched" class="category_name_searched" value="{{ $category_id->category_name }}">
            </div>
          </div>
        </div>
        <div class="form-group col-md-4">
          <div class="d-md-table align-middle">
            <div class="d-md-table-cell pt-1 pr-1 text-white text-nowrap px-md-4">or called</div>
            <div class="d-md-table-cell w-100">
              <input type="text" name="business_name_searched" placeholder="e.g. 'The Ritz, London'" class="form-control areaofb business_name_searched" value="" autocomplete="off">
              <input type="hidden" name="business_id_searched" class="business_id_searched" value="">
            </div>
          </div>
        </div>
        <div class="form-group col-md-1 pl-md-4">
            <button type="submit" class="btn btn-dark btn-block btn-purple rounded">Search</button>
        </div>
      </div>
      </div>
  </form>
</div>
</div>
<div>
    <div class="row no-gutters">
      <div class="col-md-8">
          <div class="shadow p-2 bg-white">
            <div class="row">
              <div class="col-md-7">
                <h3><span style="color: #537cd7;">{{ count($businesses) }} {{ ($count == 0 ? '' : " of ".$count) }}</span> Wedding {{ $category_id->category_name }} near {{ $location_id->location_name }}</h3>
              </div>
              <div class="col-md-2">
                <a href="{{ url('/shortlist') }}" class="underline-on-hover" style="font-size:16px; font-weight: 600; cursor: pointer; color: darkgray;">Your Shortlist (<span class="shortlist_count">{{ $shortlist_count }}</span>)</a>
              </div>

              <div class="col-md-2">
                <form role="form" method="get" action="">
                  <div class="form-group">
                    <select class="form-control rounded sort_type" name="sort_type" onchange="this.form.submit();" style="width: 160px">
                      <option value="favourites">Our Favourites</option>
                      <option value="most_popular">Most Popular</option>
                      <option value="recently_added">Recently Added</option>
                      <option value="distance">Distance</option>
                    </select>
                  </div>
                </form>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <button type="button" class="btn btn-primary btn-block rounded">Filter</button>
                </div>
              </div>
            </div>
          </div>
          <div class="container-fluid py-3">
              <div class="row no-gutters-8">
                <?php foreach ($businesses as $key => $value): ?>
                  <div class="col-md-6 col-lg-4">
                    <div class="card bs-supplier-box mb-3">
                      <div class="bs-star-ratings pt-3 pl-2 text-white" style="font-size: 12px;position: absolute;right: 0;top: 0;">
                        <div class="save-to-shortlist<?php $s_l = (isset($value->shortlisted) == true ? ' shortlisted' : ''); echo $s_l; ?>" style="cursor: pointer;" id="short_<?php echo $value->id;?>">
                          <input type="checkbox" id="short-<?php echo $value->id;?>" value="<?php echo $value->id; ?>" data-cat_id="{{ $value->category_id }}" data-shl_id="{{ isset($value->shortlisted_id) ? $value->shortlisted_id : '' }}">
                          <label for="short-<?php echo $value->id;?>" style="cursor: pointer;">
                            <svg viewBox="0 0 34 48" width="34px" height="48px"><g><g transform="translate(-956.000000, -472.000000)"><g transform="translate(600.000000, 472.000000)"><path fill="rgba(0, 0, 0,0.25)" d="M356,0h34v48c0,0-11.4-5.3-17-5.3S356,48,356,48V0z"></path></g></g></g></svg>
                            <i class="far fa-heart fa-2x text-purple"></i>
                          </label>
                        </div>
                      </div>
                        <a href="{{ url('/wedding') }}-{{ strtolower($value->category_name) }}/{{ str_replace(' ', '-', strtolower($value->name)) }}">
                          <div class="card-img-top bs-supplier-img bg-center-url" style="background-image: url('{{ asset('web_asset/images/benedict.jpg') }}');">
                            <div class="bs-star-ratings pt-3 pl-2 text-white font-weight-bold" style="font-size: 12px;background: linear-gradient(rgba(0, 0, 0,0.6) 0%, rgb(0, 0, 0, 0) 100%);">
                              <i class="fas fa-map-marker-alt"></i> {{ $value->location_name }}
                            </div>
                          </div>
                          <div class="featured-line">
                            <div class="king-hat">
                              <svg viewBox="0 0 81.2 46" width="82px" height="46px"><path fill="rgba(83, 125, 215,0.8)" d="M71.5 42.1l-.2-.1c-7-6.5-10.6-12.7-10.7-22.2C60.5 8.6 51.9 0 40.6 0s-19.9 8.6-20 19.8c-.1 9.5-3.7 15.7-10.7 22.2l-.2.2C7.1 44.6 3.6 46 0 46h81.2c-3.6 0-7.1-1.4-9.7-3.9z"></path></svg>
                                <svg viewBox="0 0 45.5 34.4" width="24px" height="18px"><path fill="rgb(255, 255, 255)" d="M3.5 20.9V6.2l5.6 6.3c.8.9 2.1 1 3.1.2l11-8.8 10 8.7c.9.8 2.3.7 3.1-.2L42 6.2v14.7H3.5zM42 30.6c0 .1-.1.2-.2.2h-38c-.1 0-.2-.1-.2-.2v-6.2H42v6.2zM44.1.8c-.9-.3-1.8-.1-2.5.6l-7 7.8L24.7.6c-.8-.7-2-.7-2.9-.1L10.9 9.2l-7-7.8C3.3.7 2.3.4 1.4.8.6 1.1 0 1.9 0 2.9v27.7c0 2.1 1.7 3.7 3.8 3.7h38c2.1 0 3.7-1.7 3.8-3.7V2.9c-.1-1-.7-1.8-1.5-2.1z"></path></svg>
                            </div>
                          </div>
                        </a>
                        <div class="card-body p-2 text-purple">
                            <h5 class="font-weight-bold">{{ $value->name }}</h5>
                            <div class="star-rating text-gold" title="50%" style="display: inline-block;margin:0px;padding:0px">
                                <div class="back-stars">
                                    <i class="far fa-star" aria-hidden="true"></i>
                                    <i class="far fa-star" aria-hidden="true"></i>
                                    <i class="far fa-star" aria-hidden="true"></i>
                                    <i class="far fa-star" aria-hidden="true"></i>
                                    <i class="far fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                            <a href="#" class="brochure_modal_heading btn btn-success link-light px-3 py-2 rounded mb-2 mt-1 text-center d-block" data-business_name_heading="{{ $value->name }}" data-toggle="modal" data-target="#modalBrochure">Request a brochure</a>
                        </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              <div class="pagination-center">
                {{ $businesses->appends([
                  'sort_type' => app('request')->input('sort_type')
                ])->links() }}
              </div>
          </div>
      </div>
      <div class="col-md-4 bg-white">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.7882143845204!2d67.11008121539737!3d24.905204684032796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb339274254ba69%3A0xa93537e837c2cda0!2sFour+Seasons+Banquet+Hall!5e0!3m2!1sen!2s!4v1553145925079" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
  </div>
<!--
    <div class="row">
        <div class="col-sm-6 col-md-7 col-lg-8">

        </div>
        <div class="col-sm-6 col-md-5 col-lg-4">
        </div>
    </div> -->
</div>
<!-- modal brochure -->
<div class="modal fade" id="modalBrochure" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modalBrochureLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header heading_color">
        <h4 class="modal-title brochure_heading" id="modalLargeLabel"></h4>
        <button type="button" class="close close_main_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff;">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body py-2" style="background-color: #f5f6f9;">
            <div class="text-left small text-center" style="">
              <div class="container" style="max-width:630px;">
                <em>We will pass your details to the supplier so they can get back to you with a proposal.</em>
              </div>
            </div>
      </div>
      <div class="modal-body py-2">
        <div class="container" style="width:630px;">
          <!-- <div class="container"> -->
            <div class="row" style="font-size: 14px;">
              <div class="col-md-5">
                <table class="baseball">
                  <tr>
                  <td>Email: </td>
                  <td class="edit_my_email">{{ $user->email }}</td>
                  </tr>

                  <tr>
                  <td>Phone: </td>
                  <td class="edit_my_phone">{{ $user->phone }}</td>
                  </tr>

                  <tr>
                  <td>Names: </td>
                  <td class="edit_my_names">{{ $user->name }} & {{ $user->partner_name }}</td>
                  </tr>
                </table>
              </div>
              <div class="col-md-5">
                <table class="baseball">
                  <tr>
                  <td>Date: </td>
                  <td class="edit_my_date">{{ $user->weeding_date }}</td>
                  </tr>

                  <tr>
                  <td>Est. guests: </td>
                  <td class="edit_my_gustes">{{ $user->weeding_no_guests }}</td>
                  </tr>

                  <tr>
                  <td>Location: </td>
                  <td class="edit_my_location">{{ $user->weeding_location }}</td>
                  </tr>
                </table>
              </div>
              <div class="col-md-2">
                <a href="#" class="open_edit_modal" style="text-decoration: none;" data-toggle="modal" data-target="#modalEditSetting" title="Edit Settings" ><i class="fal fa-pencil" style="font-size: 14px;line-height: 22px;vertical-align: bottom;display: inline-block;" aria-hidden="true"></i> &nbsp;Edit</a>
              </div>
            </div>
          <!-- </div> -->
          <form id="store_feedback" role="form" class="form-horizontal" method="post">
            @csrf
        </div>
      </div>
      <div class="modal-body py-2" style="background-color: #f5f6f9;">
        <div class="container" style="width:700px;">
          <h4 style="margin-bottom: 1.0rem;">What info would you like to receive?</h4>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group bs-custom-checkbox2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="More info" id="Moreinfo" name="remember">
                    <div class="clearfix">
                      <label class="form-check-label" for="Moreinfo"> &nbsp; More info</label>
                    </div>
                  </div>
                </div>
                <div class="form-group bs-custom-checkbox2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Alternative dates" id="Alternativedates" name="remember">
                    <div class="clearfix">
                      <label class="form-check-label" for="Alternativedates"> &nbsp; Alternative dates</label>
                    </div>
                  </div>
                </div>
                <div class="form-group bs-custom-checkbox2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Showround date" id="Showrounddate" name="remember">
                    <div class="clearfix">
                      <label class="form-check-label" for="Showrounddate"> &nbsp; Showround date</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group bs-custom-checkbox2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Brochure" id="Brochure" name="remember" checked>
                    <div class="clearfix">
                      <label class="form-check-label" for="Brochure"> &nbsp; Brochure</label>
                    </div>
                  </div>
                </div>
                <div class="form-group bs-custom-checkbox2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Availability" id="Availability" name="remember">
                    <div class="clearfix">
                      <label class="form-check-label" for="Availability"> &nbsp; Availability</label>
                    </div>
                  </div>
                </div>
                <div class="form-group bs-custom-checkbox2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Showround date" id="Other" name="remember">
                    <div class="clearfix">
                      <label class="form-check-label" for="Other"> &nbsp; Other</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group bs-custom-checkbox2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Pricing details" id="Pricingdetails" name="remember">
                    <div class="clearfix">
                      <label class="form-check-label" for="Pricingdetails"> &nbsp; Pricing details</label>
                    </div>
                  </div>
                </div>
                <div class="form-group bs-custom-checkbox2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Quote" id="Quote" name="remember">
                    <div class="clearfix">
                      <label class="form-check-label" for="Quote"> &nbsp; Quote</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" class="close_custom_message">
              <div class="col-md-12 text-center">
                <label class="d-block">
                  <div class="underline-on-hover add_custom_m" style="color: #000; font-weight: 600;"><i class="fas fa-plus-circle"></i> &nbsp;<span>Add a custom message</span></div>
                </label>
                <!-- <button type="buttons" class="btn btn-success link-light px-3 py-2 rounded mb-3 text-center d-block" id="add_custom_m"><i class="fas fa-plus-circle"></i> Add a custom message</button> -->
              </div>
            </div>
            <div class="row allow_custom_message">
              <div class="col-md-12">
                <h5 style="font-size: 16px;">Edit your message below</h5>
                <div class="form-group">
                  <textarea name="custom_message" class="form-control" rows="6" cols="80">Hi,

We're interested in your services! Please could you share your availability around our date, plus any additional information?

Thank you!</textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <button type="submit" class="btn btn-success link-light px-3 py-2 rounded mb-3 w-50 text-center d-block"><i class="far fa-paper-plane"></i> &nbsp; Request brochure</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- modal brochure end -->

<!-- modal edit settings -->
<div class="modal fade" id="modalEditSetting" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modalEditSetting" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header heading_color">
        <h4 class="modal-title" id="modalLargeLabel">Edit your details</h4>
        <button type="button" class="close close_edit_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff;">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body py-2" style="background-color: #f5f6f9;">
            <div class="text-left small text-center" style="">
              <div class="container" style="max-width:630px;">
                <em>We will pass your details to the supplier so they can get back to you with a proposal.</em>
              </div>
            </div>
      </div>
      <div class="modal-body">
        <div class="container" style="width:700px;">
          <div class="append_errors_buckets py-3 px-3 text-center" class="mb-2" style="display: none; color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; font-size: 16px;">
          </div>
          <div class="append_success_buckets py-3 px-3 text-center" class="mb-2" style="display: none; color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6; font-size: 16px;"></div>
          <form id="store_my_info" role="form" class="form-horizontal" method="post">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Email <span style="color: red;">*</span></label>
                  <input type="text" name="email" class="form-control email_error" style="background-color: rgba(241, 241, 241, 0);" placeholder="Your email address" value="{{ $user->email }}" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Phone <span style="color: #537cd7;">(Recommended)</span></label>
                  <input type="text" name="phone" class="form-control phone_error" style="background-color: rgba(241, 241, 241, 0);" onkeypress="return isNumber(event)" placeholder="Your phone number" value="{{ $user->phone }}" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Your Name <span style="color: red;">*</span></label>
                  <input type="text" name="name" class="form-control name_error" style="background-color: rgba(241, 241, 241, 0);" placeholder="Your full name" value="{{ $user->name }}" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Your partner's name <span style="color: red;">*</span></label>
                  <input type="text" name="partner_name" class="form-control partner_name_error" style="background-color: rgba(241, 241, 241, 0);" placeholder="Your partner's name" value="{{ $user->partner_name }}" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Estimated guests <span style="color: red;">*</span></label>
                  <input type="text" name="weeding_no_guests" onkeypress="return isNumber(event)" class="form-control weeding_no_guests_error" style="background-color: rgba(241, 241, 241, 0);" placeholder="Wedding estimated guests" value="{{ $user->weeding_no_guests }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Ideal date <span style="color: red;">*</span></label>
                  <input type="text" name="weeding_date" class="form-control wedding-date-setting-btn weeding_date_error" style="background-color: rgba(241, 241, 241, 0);" placeholder="Wedding date" value="{{ $user->weeding_date }}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-pink font-weight-bold">Location <span style="color: red;">*</span></label>
                  <input type="text" name="weeding_location" class="form-control areaofpk weeding_location_error" style="background-color: rgba(241, 241, 241, 0);" placeholder="Wedding location?" value="{{ $user->location_name }}" autocomplete="off">
                  <input type="hidden" id="location_id" name="location_id" value="{{ $user->location_id }}">
                  <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                </div>
              </div>
            </div>
        </div>
      </div>
      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <button type="submit" class="btn btn-success link-light px-3 py-2 rounded mb-3 text-center d-block">Save information</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- modal edit settings end -->

<!-- modal date settings -->
<div class="modal fade" id="setting-date-popup" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="setting-date-popup" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header heading_color">
        <h4 class="modal-title" id="modalLargeLabel">Edit your details</h4>
        <button type="button" class="close close_date_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff;">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <div class="container" style="width:700px;">
          <!-- <div class="signup-box p-1"> -->
            <form id="update-date-ajax" role="form" class="form-horizontal" method="post">
              @csrf
              <!-- <div class="card mb-3"> -->
                  <div class="row">
                      <div class="col-md-12">
                              <div class="form-group">
                                  <h5 class="font-weight-bold text-center">Your Ideal wedding date</h5>
                                  <h5 class="font-weight-bold append_date text-center" style="color: rgb(45, 186, 167);">{{ $user->weeding_date }}</h5>
                              </div>
                              <div class="row mt-3">
                                  <div class="col-sm-12">
                                      <div class="nav nav-tabs btn-group btn-group-toggle bs-sigup-radio link-purple" data-toggle="buttons">
                                          <button type="button" class="btn btn-default active tabweddingyear">Year
                                              <input type="radio" name="" checked value="Year" />
                                          </button>
                                          <button type="button" class="btn btn-default tabweddingmonth">Season/Month
                                              <input type="radio" name="" value="Season/Month" />
                                          </button>
                                          <button type="button" class="btn btn-default tabweddingday">Day
                                              <input type="radio" name="" value="Day" />
                                          </button>
                                      </div>

                                      <div class="tab-content">
                                          <div class="tab-pane active step5-radiobox1" id="">
                                            <div class="row mt-5">
                                              <div class="col-md-6">
                                                <h5 class="text-purple">Select a year</h5>
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" class="weeding_date" name="weeding_date" value="{{ $user->weeding_date }}">
                                                <input type="hidden" class="weeding_year" name="weeding_year" value="{{ $user->weeding_year }}">
                                                <input type="hidden" class="weeding_month_season" name="weeding_month_season" value="{{ $user->weeding_month_season }}">
                                                <input type="hidden" class="weeding_day_date" name="weeding_day_date" value="{{ $user->weeding_day_date }}">
                                                <div class="form-group bs-form-db">
                                                    <div class="btn-group-toggle bs-sigup-radio-purple" data-toggle="buttons">
                                                        <label class="btn btn-light btn-grey yearlabel <?php $ya2020 = ($user->weeding_year == "2020" ? "active" : ""); echo $ya2020; ?>" for="selectyear1">
                                                            <input id="selectyear1" class="weddingyear" type="radio" name="selectyear" value="2020" required <?php $yc2020 = ($user->weeding_year == "2020" ? "checked" : ""); echo $yc2020; ?> /> 2020
                                                        </label>
                                                        <label class="btn btn-light btn-grey yearlabel <?php $ya2021 = ($user->weeding_year == "2021" ? "active" : ""); echo $ya2021; ?>" for="selectyear2">
                                                            <input id="selectyear2" class="weddingyear" type="radio" name="selectyear" value="2021" required <?php $yc2021 = ($user->weeding_year == "2021" ? "checked" : ""); echo $yc2021; ?> /> 2021
                                                        </label>
                                                        <label class="btn btn-light btn-grey yearlabel <?php $ya2022 = ($user->weeding_year == "2022" ? "active" : ""); echo $ya2022; ?>" for="selectyear3">
                                                            <input id="selectyear3" class="weddingyear" type="radio" name="selectyear" value="2022" required <?php $yc2022 = ($user->weeding_year == "2022" ? "checked" : ""); echo $yc2022; ?> /> 2022
                                                        </label>
                                                        <label class="btn btn-light btn-grey yearlabel <?php $ya2023 = ($user->weeding_year == "2023" ? "active" : ""); echo $ya2023; ?>" for="selectyear4">
                                                            <input id="selectyear4" class="weddingyear" type="radio" name="selectyear" value="2023" required <?php $yc2023 = ($user->weeding_year == "2023" ? "checked" : ""); echo $yc2023; ?> /> 2023
                                                        </label>
                                                        <label class="btn btn-light btn-grey yearlabel <?php $ya2024 = ($user->weeding_year == "2024" ? "active" : ""); echo $ya2024; ?>" for="selectyear5">
                                                            <input id="selectyear5" class="weddingyear" type="radio" name="selectyear" value="2024" required <?php $yc2024 = ($user->weeding_year == "2024" ? "checked" : ""); echo $yc2024; ?> /> 2024
                                                        </label>
                                                        <label class="btn btn-light btn-grey yearlabel <?php $ya2025 = ($user->weeding_year == "2025" ? "active" : ""); echo $ya2025; ?>" for="selectyear6">
                                                            <input id="selectyear6" class="weddingyear" type="radio" name="selectyear" value="2025" required <?php $yc2025 = ($user->weeding_year == "2025" ? "checked" : ""); echo $yc2025; ?> /> 2025
                                                        </label>
                                                        <label class="btn btn-light btn-grey yearlabel <?php $ya2026 = ($user->weeding_year == "2026" ? "active" : ""); echo $ya2026; ?>" for="selectyear7">
                                                            <input id="selectyear7" class="weddingyear" type="radio" name="selectyear" value="2026" required <?php $yc2026 = ($user->weeding_year == "2026" ? "checked" : ""); echo $yc2026; ?> /> 2026
                                                        </label>
                                                        <label class="btn btn-light btn-grey yearlabel <?php $ya2027 = ($user->weeding_year == "2027" ? "active" : ""); echo $ya2027; ?>" for="selectyear8">
                                                            <input id="selectyear8" class="weddingyear" type="radio" name="selectyear" value="2027" required <?php $yc2027 = ($user->weeding_year == "2027" ? "checked" : ""); echo $yc2027; ?> /> 2027
                                                        </label>
                                                    </div>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <h5 class="text-purple">Or select from the list</h5>
                                                <div class="form-group bs-form-db">
                                                    <select class="form-control otherweddingyear" name="otheryear">
                                                        <option value="">Select year</option>
                                                        <option value="2020" <?php $ya2020 = ($user->weeding_year == "2020" ? "selected" : ""); echo $ya2020; ?>>2020</option>
                                                        <option value="2021" <?php $ya2021 = ($user->weeding_year == "2021" ? "selected" : ""); echo $ya2021; ?>>2021</option>
                                                        <option value="2022" <?php $ya2022 = ($user->weeding_year == "2022" ? "selected" : ""); echo $ya2022; ?> >2022</option>
                                                        <option value="2023" <?php $ya2023 = ($user->weeding_year == "2023" ? "selected" : ""); echo $ya2023; ?> >2023</option>
                                                        <option value="2024" <?php $ya2024 = ($user->weeding_year == "2024" ? "selected" : ""); echo $ya2024; ?> >2024</option>
                                                        <option value="2025" <?php $ya2025 = ($user->weeding_year == "2025" ? "selected" : ""); echo $ya2025; ?> >2025</option>
                                                        <option value="2026" <?php $ya2026 = ($user->weeding_year == "2026" ? "selected" : ""); echo $ya2026; ?> >2026</option>
                                                        <option value="2027" <?php $ya2027 = ($user->weeding_year == "2027" ? "selected" : ""); echo $ya2027; ?> >2027</option>
                                                    </select>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="tab-pane fade step5-radiobox2" id="">
                                              <div class="row mt-2">
                                                <div class="col-md-6">
                                                  <h5 class="text-purple">Select a season</h5>
                                                  <div class="form-group bs-form-db">
                                                    <div class="btn-group-toggle bs-sigup-radio-purple" data-toggle="buttons">
                                                      <label class="btn btn-light btn-grey seasonlabel <?php $spring = ($user->weeding_month_season == "spring" ? "active" : ""); echo $spring; ?>" for="selectseason1">
                                                        <input id="selectseason1" type="radio" class="selectseason" name="selectseason" value="spring" <?php $cspring = ($user->weeding_month_season == "spring" ? "checked" : ""); echo $cspring; ?> /><i class="fal fa-2x fa-flower" title="spring"></i>
                                                      </label>
                                                      <label class="btn btn-light btn-grey seasonlabel <?php $summer = ($user->weeding_month_season == "summer" ? "active" : ""); echo $summer; ?>" for="selectseason2">
                                                        <input id="selectseason2" type="radio" class="selectseason" name="selectseason" value="summer" <?php $csummer = ($user->weeding_month_season == "summer" ? "checked" : ""); echo $csummer; ?> /><i class="fal fa-2x fa-sun" title="summer"></i>
                                                      </label>
                                                      <label class="btn btn-light btn-grey seasonlabel <?php $autumn = ($user->weeding_month_season == "autumn" ? "active" : ""); echo $autumn; ?>" for="selectseason4">
                                                        <input id="selectseason4" type="radio" class="selectseason" name="selectseason" value="autumn" <?php $cautumn = ($user->weeding_month_season == "autumn" ? "checked" : ""); echo $cautumn; ?> /><i class="fal fa-2x fa-feather-alt" title="autumn"></i>
                                                      </label>
                                                      <label class="btn btn-light btn-grey seasonlabel <?php $winter = ($user->weeding_month_season == "winter" ? "active" : ""); echo $winter; ?>" for="selectseason3">
                                                        <input id="selectseason3" type="radio" class="selectseason" name="selectseason" value="winter" <?php $cwinter = ($user->weeding_month_season == "winter" ? "checked" : ""); echo $cwinter; ?> /><i class="fal fa-2x fa-snowflake" title="winter"></i>
                                                      </label>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <h5 class="text-purple">Or select a month</h5>
                                                  <div class="form-group bs-form-db">
                                                    <div class="btn-group-toggle bs-sigup-radio-purple" data-toggle="buttons">
                                                      <label class="btn btn-light btn-grey monthlabel <?php $january = ($user->weeding_month_season == "January" ? "active" : ""); echo $january; ?>" for="selectmonth1">
                                                        <input id="selectmonth1" type="radio" name="selectmonth" class="selectmonth" value="January" <?php $cjanuary = ($user->weeding_month_season == "January" ? "checked" : ""); echo $cjanuary; ?> /> January
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $febuary = ($user->weeding_month_season == "February" ? "active" : ""); echo $febuary; ?>" for="selectmonth2">
                                                        <input id="selectmonth2" type="radio" name="selectmonth" class="selectmonth" value="February" <?php $cfebuary = ($user->weeding_month_season == "February" ? "checked" : ""); echo $cfebuary; ?> /> February
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $march = ($user->weeding_month_season == "March" ? "active" : ""); echo $march; ?>"  for="selectmonth3">
                                                        <input id="selectmonth3" type="radio" name="selectmonth" class="selectmonth" value="March" <?php $cmarch = ($user->weeding_month_season == "March" ? "checked" : ""); echo $cmarch; ?> /> March
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $april = ($user->weeding_month_season == "April" ? "active" : ""); echo $april; ?>"  for="selectmonth4">
                                                        <input id="selectmonth4" type="radio" name="selectmonth" class="selectmonth" value="April" <?php $capril = ($user->weeding_month_season == "April" ? "checked" : ""); echo $capril; ?> /> April
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $may = ($user->weeding_month_season == "May" ? "active" : ""); echo $may; ?>" for="selectmonth5">
                                                        <input id="selectmonth5" type="radio" name="selectmonth" class="selectmonth" value="May" <?php $cmay = ($user->weeding_month_season == "May" ? "checked" : ""); echo $cmay; ?> /> May
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $june = ($user->weeding_month_season == "June" ? "active" : ""); echo $june; ?>" for="selectmonth6">
                                                        <input id="selectmonth6" type="radio" name="selectmonth" class="selectmonth" value="June" <?php $cjune = ($user->weeding_month_season == "June" ? "checked" : ""); echo $cjune; ?> /> June
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $july = ($user->weeding_month_season == "July" ? "active" : ""); echo $july; ?>"  for="selectmonth7">
                                                        <input id="selectmonth7" type="radio" name="selectmonth" class="selectmonth" value="July" <?php $cjuly = ($user->weeding_month_season == "July" ? "checked" : ""); echo $cjuly; ?> /> July
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $august = ($user->weeding_month_season == "August" ? "active" : ""); echo $august; ?>" for="selectmonth8">
                                                        <input id="selectmonth8" type="radio" name="selectmonth" class="selectmonth" value="August" <?php $caugust = ($user->weeding_month_season == "August" ? "checked" : ""); echo $caugust; ?> /> August
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $september = ($user->weeding_month_season == "September" ? "active" : ""); echo $september; ?>"  for="selectmonth9">
                                                        <input id="selectmonth9" type="radio" name="selectmonth" class="selectmonth" value="September" <?php $cseptember = ($user->weeding_month_season == "September" ? "checked" : ""); echo $cseptember; ?> /> September
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $october = ($user->weeding_month_season == "October" ? "active" : ""); echo $october; ?>"  for="selectmonth10">
                                                        <input id="selectmonth10" type="radio" name="selectmonth" class="selectmonth" value="October" <?php $coctober = ($user->weeding_month_season == "October" ? "checked" : ""); echo $coctober; ?> /> October
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $november = ($user->weeding_month_season == "November" ? "active" : ""); echo $november; ?>"  for="selectmonth11">
                                                        <input id="selectmonth11" type="radio" name="selectmonth" class="selectmonth" value="November" <?php $cnovember = ($user->weeding_month_season == "November" ? "checked" : ""); echo $cnovember; ?> /> November
                                                      </label>
                                                      <label class="btn btn-light btn-grey monthlabel <?php $december = ($user->weeding_month_season == "December" ? "active" : ""); echo $december; ?>"  for="selectmonth12">
                                                        <input id="selectmonth12" type="radio" name="selectmonth" class="selectmonth" value="December" <?php $cdecember = ($user->weeding_month_season == "December" ? "checked" : ""); echo $cdecember; ?> /> December
                                                      </label>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>

                                          <div class="tab-pane fade step5-radiobox3" id="">
                                               <div class="row mt-2">
                                                 <div class="col-md-6">
                                                   <h5 class="text-purple">Select a day of the week</h5>
                                                   <div class="form-group bs-form-db">
                                                     <div class="btn-group-toggle bs-sigup-radio-purple" data-toggle="buttons">
                                                       <label class="btn btn-light btn-grey weeklabel <?php $monday = ($user->weeding_day_date == "Monday" ? "active" : ""); echo $monday; ?>" for="Mondayss">
                                                         <input id="Mondayss" type="radio" class="selectweek" name="selectweek" value="Monday" required <?php $cmonday = ($user->weeding_day_date == "Monday" ? "checked" : ""); echo $cmonday; ?> /> Monday
                                                       </label>
                                                       <label class="btn btn-light btn-grey weeklabel <?php $tuesday = ($user->weeding_day_date == "Tuesday" ? "active" : ""); echo $tuesday; ?>" for="Tuesdayss">
                                                         <input id="Tuesdayss" type="radio" class="selectweek" name="selectweek" value="Tuesday" required <?php $ctuesday = ($user->weeding_day_date == "Tuesday" ? "checked" : ""); echo $ctuesday; ?> /> Tuesday
                                                       </label>
                                                       <label class="btn btn-light btn-grey weeklabel <?php $wednesday = ($user->weeding_day_date == "Wednesday" ? "active" : ""); echo $wednesday; ?>" for="Wednesdayss">
                                                         <input id="Wednesdayss" type="radio" class="selectweek" name="selectweek" value="Wednesday" required <?php $cwednesday = ($user->weeding_day_date == "Wednesday" ? "checked" : ""); echo $cwednesday; ?> /> Wednesday
                                                       </label>
                                                       <label class="btn btn-light btn-grey weeklabel <?php $thursday = ($user->weeding_day_date == "Thursday" ? "active" : ""); echo $thursday; ?>" for="Thursdayss">
                                                         <input id="Thursdayss" type="radio" class="selectweek" name="selectweek" value="Thursday" required <?php $cthursday = ($user->weeding_day_date == "Thursday" ? "checked" : ""); echo $cthursday; ?> /> Thursday
                                                       </label>
                                                       <label class="btn btn-light btn-grey weeklabel <?php $friday = ($user->weeding_day_date == "Friday" ? "active" : ""); echo $friday; ?>" for="Fridayss">
                                                         <input id="Fridayss" type="radio" class="selectweek" name="selectweek" value="Friday" required <?php $cfriday = ($user->weeding_day_date == "Friday" ? "checked" : ""); echo $cfriday; ?> /> Friday
                                                       </label>
                                                       <label class="btn btn-light btn-grey weeklabel <?php $saturday = ($user->weeding_day_date == "Saturday" ? "active" : ""); echo $saturday; ?>" for="Saturdayss">
                                                         <input id="Saturdayss" type="radio" class="selectweek" name="selectweek" value="Saturday" required <?php $csaturday = ($user->weeding_day_date == "Saturday" ? "checked" : ""); echo $csaturday; ?>/> Saturday
                                                       </label>
                                                       <label class="btn btn-light btn-grey weeklabel <?php $sunday = ($user->weeding_day_date == "Sunday" ? "active" : ""); echo $sunday; ?>" for="Sundayss">
                                                         <input id="Sundayss" type="radio" class="selectweek" name="selectweek" value="Sunday" required <?php $csunday = ($user->weeding_day_date == "Sunday" ? "checked" : ""); echo $csunday; ?> /> Sunday
                                                       </label>
                                                     </div>
                                                   </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                   <div class="mt-4 date_selector" id="">
                                                     <h5 class="text-purple">Or Select a Date</h5>
                                                     <div class="form-group">
                                                       <div class="datepicker-show"></div>
                                                       <input type="hidden" name="date" class="step5-date calendarpicker">
                                                     </div>
                                                   </div>
                                                 </div>
                                              </div>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                      </div>
                  </div>
              <!-- </div> -->
              <!--Footer-->
              <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-success link-light px-3 py-2 rounded mb-3 text-center d-block">Save date</button>
              </div>
              </form>
          <!-- </div> -->
    </div>
  </div>
</div>
</div>
</div>
<!-- modal edit settings end -->
<style media="screen">
.pagination-center  ul.pagination{-ms-flex-pack: center!important;justify-content: center!important; margin-top: 5px;}
.form-control {
    border-radius: 5px;
}

.save-to-shortlist{position:absolute;right:10px;top:0;}
.save-to-shortlist label>svg path{fill: #4d2e5f; position:absolute;right:0;top:0;}
.save-to-shortlist label>i.fa-heart.fa-2x.text-purple{position:absolute;right:8px;top:14px;color:#ffffff;font-size:18px}
.save-to-shortlist>input{position: absolute;clip: rect(0,0,0,0);pointer-events: none;}
.save-to-shortlist.shortlisted label>i.fa-heart.fa-2x.text-purple:before{font-weight:700 !important}
.bs-supplier-box .bs-supplier-img {
    height: 220px;
}
.king-hat {text-right:right;display:block; position:relative;border-bottom:5px solid #7597df;height:51px;margin-top:-50px;}
.king-hat>svg:last-child{position:absolute; right:28px;top:10px;}
.king-hat>svg{position:absolute; right:0;}
.bb-dz {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
}
.errorClass { border:  1px solid red; }
.baseball td:nth-child(1) { font-weight: 600; }
.baseball { display: inline; }
.baseball td{ text-align: left; padding: 3px; }
.modal-open2 {
    overflow: hidden;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.bs-custom-checkbox2 input[type="checkbox"] {height: 1.2em !important; width: 1.2em !important; vertical-align: top; border: 2px solid #a2a2a2;-moz-appearance: none; -webkit-appearance: none; -webkit-transition: box-shadow 200ms; box-shadow:inset 0px 0px 0 #fff, 0 0px 0px rgba(0,0,0,0.1);line-height: 3px !important; margin-top: 1px;text-align: center;}
.bs-custom-checkbox2 input[type="checkbox"] {-webkit-border-radius:4px; border-radius:4px;}
.bs-custom-checkbox2 input[type="checkbox"]:not(:disabled):hover{border-color:##764f7f;box-shadow:inset 0px 0px 0 #fff, 0 0 0px rgba(0,0,0,0.3);}
.bs-custom-checkbox2 input[type="checkbox"]:active:not(:disabled){box-shadow:inset 0px 0px 0 rgba(0,0,0,0.2), inset 0px 0px 0 rgba(255,255,255,0.6);border-color:rgba(0,0,0,0.5);}
.bs-custom-checkbox2 input[type="checkbox"]:focus {outline:none;}
.bs-custom-checkbox2 input[type="checkbox"]:checked:before{font-weight: bold;color:#ffffff;content: ' \2713 ';-webkit-margin-start: 0px;font-size: 0.9em;line-height:15px;text-align: center;}
.bs-custom-checkbox2 input[type="checkbox"]:checked{background:#764f7f;border-color: #764f7f;}
.bs-custom-checkbox2 input[type="checkbox"]:checked,input[type="checkbox"]{transition: all ease-in-out .15s,all ease-in-out .15s;}
</style>
<script type="text/javascript">
function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}

$(document).ready(function(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('.hidden_class_user_info').hide();
  $('.hidden_class_form').hide();
  $('.allow_custom_message').hide();
  $('.disabled_custom').text('');

  var months = {'January' : '1', 'February' : '2', 'March' : '3', 'April' : '4', 'May' : '5', 'June' : '6', 'July' : '7', 'August' : '8', 'September' : '9', 'October' : '10', 'November' : '11', 'December' : '12'};
  $.each( months, function( key, value ) {
    if(key == "{{ $user->weeding_month_season }}"){
      $('.date_selector').show();
      var startDate = new Date("{{ $user->weeding_year }}", value-1, "{{ $user->weeding_day_date }}");
      $(".datepicker-show").datepicker("setDate", startDate);
    }
  });

  $(document).on('click', '.brochure_modal_heading', function(){
		// $('.assignment_form')[0].reset();
		$('.brochure_heading').html('Send a message to '+$(this).data('business_name_heading'));
		// $('.assesment_online_course_id').val($(this).data('online_course_id'));
		// $('.assesment_week_no').val($(this).data('online_course_week_no'));
		// $('.assesment_final').val('final');
	});

  $(document).on('click', '.open_edit_modal', function(){
		$('#modalBrochure').modal('hide');
    $('body').addClass('modal-open2');
	});
  $(document).on('click', '.close_edit_modal', function(){
		$('#modalBrochure').modal('show');
    $('body').addClass('modal-open2');
	});
  $(document).on('click', '.close_date_modal', function(){
		$('#modalEditSetting').modal('show');
    $('body').addClass('modal-open2');
	});
  $(document).on('click', '.add_custom_m', function(){
		$('.add_custom_m').hide();
		$('.allow_custom_message').show();
	});
  $('.wedding-date-setting-btn').on('click', function(event) {
      $('#setting-date-popup').modal(open);
      $('#modalEditSetting').modal('hide');
  });
  $('.close_main_modal').on('click', function(event) {
    $('body').removeClass('modal-open2');
  });

  $('.save-to-shortlist>input:checkbox').each(function(index) {
    $(this).click(function(){

      //form_Data
      var b_id = $(this).val();
      var c_id = $(this).data('cat_id');
      var fo_d = new FormData();
      fo_d.append('user_id', "{{ Auth::user()->id }}");
      fo_d.append('business_id', b_id);
      fo_d.append('category_id', c_id);
      //form_data_end

      var shl_id = $(this).attr('data-shl_id');

      if(typeof shl_id !== typeof undefined && shl_id !== false && shl_id !== ''){
        var fo_d_delete = new FormData();
        fo_d_delete.append('shortlisted_id', shl_id);

        $(this).prop("checked", false);
        $(this).parent('.save-to-shortlist').removeClass('shortlisted');

        $.ajax({
          type:'POST',
          url:"{{ url('/delete_shortlist') }}",
          data:fo_d_delete,
          dataType:"JSON",
          contentType:false,
          cache:false,
          processData:false,
          success:function(data){
            console.log(data);
            $("#short-"+b_id).removeAttr("data-shl_id");
            $('.append_remove_data_message').text('');
            $('.shortlist_count').text('');
            $('.shortlist_count').text(data.count);
            $('.append_remove_data_message').text(data.remove);
            $('.append_remove_message_whole_website').fadeIn();
            setTimeout(function(){
              $('.append_remove_message_whole_website').fadeOut();
            },2000);

          }
        });
      }
      else if($(this).is(':checked')) {
        $(this).prop("checked", true);
        $(this).parent('.save-to-shortlist').addClass('shortlisted');

        $.ajax({
          type:'POST',
          url:"{{ url('/store_shortlist') }}",
          data:fo_d,
          dataType:"JSON",
          contentType:false,
          cache:false,
          processData:false,
          success:function(response){
            console.log(response);
            $("#short-"+b_id).attr({"data-shl_id" : response.shortlist});
            $('.append_success_data_message').text('');
            $('.shortlist_count').text('');
            $('.shortlist_count').text(response.count);
            $('.append_success_data_message').text(response.success);
            $('.append_success_message_whole_website').fadeIn();
            setTimeout(function(){
              $('.append_success_message_whole_website').fadeOut();
            },2000);
          }
        });
      }else{
        alert('else else');
      }
    });
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
  });

  $('#store_my_info').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"{{ url('/store_my_info') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_error_data_message').text('');
        $('.append_success_data_message').text('');
        if(data.errors)
        {
          if(data.errors.email){
              $('.form-control').css("border-color", "#ced4da");

              if(data.errors.email[0] == "The email format is invalid."){
                $('.append_error_data_message').text("Hmm, looks like that email is not in the correct format.");
              }else{
                $('.append_error_data_message').text("Please fill out all missing fields.");
              }

              $('.email_error').css("border-color", "red");
              $('.append_error_message_whole_website').fadeIn();
              setTimeout(function(){
                $('.append_error_message_whole_website').fadeOut();
              },3000);
          }
          else if(data.errors.name){
            $('.form-control').css("border-color", "#ced4da");
            $('.append_error_data_message').text('Please fill out all missing fields.');
            $('.name_error').css("border-color", "red");
            $('.append_error_message_whole_website').fadeIn();
            setTimeout(function(){
              $('.append_error_message_whole_website').fadeOut();
            },3000);
          }
          else if(data.errors.partner_name){
            $('.form-control').css("border-color", "#ced4da");
            $('.append_error_data_message').text('Please fill out all missing fields.');
            $('.partner_name_error').css("border-color", "red");
            $('.append_error_message_whole_website').fadeIn();
            setTimeout(function(){
              $('.append_error_message_whole_website').fadeOut();
            },3000);
          }
          else if(data.errors.weeding_no_guests){
            $('.form-control').css("border-color", "#ced4da");
            $('.append_error_data_message').text('Please fill out all missing fields.');
            $('.weeding_no_guests_error').css("border-color", "red");
            $('.append_error_message_whole_website').fadeIn();
            setTimeout(function(){
              $('.append_error_message_whole_website').fadeOut();
            },3000);
          }
          else if(data.errors.weeding_date){
            $('.form-control').css("border-color", "#ced4da");
            $('.append_error_data_message').text('Please fill out all missing fields.');
            $('.weeding_date_error').css("border-color", "red");
            $('.append_error_message_whole_website').fadeIn();
            setTimeout(function(){
              $('.append_error_message_whole_website').fadeOut();
            },3000);
          }
          else if(data.errors.weeding_location){
            $('.form-control').css("border-color", "#ced4da");
            $('.append_error_data_message').text('Please fill out all missing fields.');
            $('.weeding_location_error').css("border-color", "red");
            $('.append_error_message_whole_website').fadeIn();
            setTimeout(function(){
              $('.append_error_message_whole_website').fadeOut();
            },3000);
          }
        }else if (data.success){
          $('.form-control').css("border-color", "#ced4da");
          $('.email_error').val(data.success.user.email);
          $('.phone_error').val(data.success.user.phone);
          $('.name_error').val(data.success.user.name);
          $('.partner_name_error').val(data.success.user.partner_name);
          $('.weeding_no_guests_error').val(data.success.user.weeding_no_guests);
          $('.weeding_date_error').val(data.success.user.weeding_date);
          $('.weeding_location_error').val(data.success.user.weeding_location);
          $('#location_id').val(data.success.user.location_id);
          $('.edit_my_email').text(data.success.user.email);
          $('.edit_my_phone').text(data.success.user.phone);
          $('.edit_my_names').text(data.success.user.name+' & '+data.success.user.partner_name);
          $('.edit_my_date').text(data.success.user.weeding_date);
          $('.edit_my_gustes').text(data.success.user.weeding_no_guests);
          $('.edit_my_location').text(data.success.user.weeding_location);

          $('.append_success_data_message').text(data.success[0]);
          $('.append_success_message_whole_website').fadeIn();
          setTimeout(function(){
            $('.append_success_message_whole_website').fadeOut();
          },3000);

          setTimeout(function(){ $('.append_success_buckets').fadeOut(); },3000);
          setTimeout(function(){ $('#modalEditSetting').modal('hide'); },2000);
          setTimeout(function(){ $('#modalBrochure').modal('show'); },2000);
          $('body').addClass('modal-open2');
        }
      },
    });
  });
});
</script>
@endsection
