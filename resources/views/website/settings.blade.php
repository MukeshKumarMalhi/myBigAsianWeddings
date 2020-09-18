@extends('layouts.app')
@section('title','Wedding planner')

@section('content')
              <div class="shadow">
                <div class="container py-4">
                  <h1>My Settings</h1>
                </div>
              </div>
              <div class="container py-4" style="max-width:800px;">
                <h3>Invite Your Partner & Collaborators</h3>
                  <hr class="my-2 mb-3 border-dark">
                <p>Invite your partner, friends and family to share planning. They can access / edit your wedding info and they’ll receive email updates too.
                  <br><br>Once they accept, collaborators will appear below
                </p>
                <a href="#" class="btn btn-success link-light px-3 py-2 rounded mb-3 text-center d-block">Invite Partner/ Collaborators</a>
                <div class="row">
                  <div class="col-md-6">
                    Email
                  </div>
                  <div class="col-md-6" style="text-align: right;">
                    Access Level
                  </div>
                </div>
                <hr class="my-2 border-dark">
                <div class="row mb-5">
                  <div class="col-md-6">
                    <p class="append_email">{{ $user->email }}</p>
                  </div>
                  <div class="col-md-6" style="text-align: right;">
                    <p>Admin</p>
                  </div>
                </div>
                <h3>My Wedding Details</h3>
                <hr class="my-2 mb-3 border-dark">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-pink font-weight-bold">Your Name</label>
                        <input type="text" name="name" class="form-control py-4" style="background-color: rgba(241, 241, 241, 0);" onchange="update_user_data([this.value,'name'])" placeholder="Your full name" value="{{ Auth::user()->name }}" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-pink font-weight-bold">Your partner's name</label>
                        <input type="text" name="partner_name" class="form-control py-4" style="background-color: rgba(241, 241, 241, 0);" onchange="update_user_data([this.value,'partner_name'])" placeholder="Your partner's name" value="{{ Auth::user()->partner_name }}" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-pink font-weight-bold">Location</label>
                        <input type="text" name="weeding_location" class="form-control py-4 areaofpk" style="background-color: rgba(241, 241, 241, 0);" placeholder="Wedding location?" value="{{ $user->location_name }}" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-pink font-weight-bold">Wedding date</label>
                        <input id="" type="text" name="edit_weeding_date" class="form-control py-4 wedding-date-setting-btn" style="background-color: rgba(241, 241, 241, 0);" placeholder="Wedding date?" onchange="update_user_data([this.value,'weeding_date'])" value="{{ Auth::user()->weeding_date }}">
                      </div>
                    </div>
                  </div>
                  <h4>Get Help</h4>
                  <hr class="my-2 mb-3 border-dark">
                  <p>The support team is here to keep your Bridebook running smoothly. Need help? Get in touch!</p>
                  <div class="row mb-2">
                    <div class="col-md-6">
                      <a id="get-help-btn" href="#" class="btn btn-success link-light px-3 py-2 rounded mb-3 text-center d-block">Get help</a>
                    </div>
                  </div>
                  <h4>Feedback</h4>
                  <hr class="my-2 mb-3 border-dark">
                  <p>We love hearing from you and finding ways to improve. Click below to send us your feedback!</p>
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <a href="#" class="btn btn-success link-light px-3 py-2 rounded mb-3 text-center d-block" data-toggle="modal" data-target="#modalFeedback">Give us feedback</a>
                    </div>
                  </div>
                  <h3>Your User Photo</h3>
                  <hr class="my-2 mb-3 border-dark">
                  <div class="row">
                    <div class="col-md-12 text-center">
                          <div class="bg-purple d-inline-block rounded-circle border-bottom p-0 m-0 mb-1">
                            <img id="blah" src="web_asset/images/photos/add-person-icon.png" style="width: 100px; height: 100px; <?php $one = ($user->user_image == null ? '' : 'display: none;'); echo $one; ?>" class="img-fluid rounded-circle">
                            <img id="blah_image" src="<?php echo asset('storage/app/public/'.$user->user_image); ?>" style="width: 100px; height: 100px; <?php $two = ($user->user_image != null ? '' : 'display: none;'); echo $two; ?>" class="img-fluid rounded-circle">
                            <input id="image" type="file" name="user_image" accept="image/*" onchange="readURL(this);" class="form-control d-none" required>
                          </div>
                          <label class="d-block" for="image">
                            <div class="text-center underline-on-hover"><span>Upload new photo</span> <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                          </label>
                          <label class="d-block">
                            <div class="text-center underline-on-hover remove_image" style="color: #537cd7; <?php $three = ($user->user_image != null ? '' : 'display: none;'); echo $three; ?>"><span>Remove photo</span> <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                          </label>
                      <script type="text/javascript">
                          function readURL(input) {
                              if (input.files && input.files[0]) {
                              var reader = new FileReader();
                              reader.onload = function (e) {
                                  $('#blah').hide();
                                  $('#blah_image').show();
                                  $('#blah_image').attr('src', e.target.result);
                              };
                              reader.readAsDataURL(input.files[0]);
                              var fd = new FormData();
                              fd.append( 'file', input.files[0] );
                              fd.append( 'user_id', "{{ Auth::user()->id }}" );
                              console.log(fd);
                              $.ajax({
                                url:"{{ url('/upload_user_image') }}",
                                data: fd,
                                processData: false,
                                contentType: false,
                                type: 'POST',
                                success: function (response) {
                                  $('.remove_image').show();
                                }
                              });
                          }
                      }
                      </script>
                    </div>
                  </div>
                  <!-- <h3>My Contact Email Address</h3>
                  <p style="margin-bottom: 0rem;">The email address our suppliers will contact you on (please type it carefully)</p>
                  <hr class="my-2 mb-3 border-dark">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="email" class="form-control py-4" style="background-color: rgba(241, 241, 241, 0);" value="{{ Auth::user()->email }}" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <button type="button" class="btn btn-success link-light px-3 py-2 rounded mb-3 text-center d-block" name="button">Save email address</button>
                    </div>
                  </div> -->
                  <h3>My Login Methods</h3>
                  <hr class="my-2 mb-3 border-dark">
                  <div class="row">
                    <div class="col-md-6">
                      <p style="margin-bottom: 0.4rem;">Your email login method</p>
                      <p style="font-weight: 600;" class="my_email">{{ $user->email }}</p>
                      <div class="change_credentils">
                        <label class="d-block">
                          <div class="underline-on-hover change_email" style="color: #537cd7; font-weight: 600;"><i class="fal fa-pencil" aria-hidden="true"></i> &nbsp;<span>Change the email</span></div>
                        </label>
                        <label class="d-block">
                          <div class="underline-on-hover reset_password" style="color: #537cd7; font-weight: 600;"><i class="fal fa-envelope" aria-hidden="true"></i> &nbsp;<span>Reset Password</span></div>
                        </label>
                      </div>
                      <div class="append_login_success" style="margin-top:15px; font-size: 16px; color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 10px; display: none;">
                      </div>
                      <div class="change_email_with_password" style="display: none;">
                        <form id="change_email_address" role="form" class="form-horizontal" method="post">
                          <div class="form-group">
                            <input type="text" name="email" class="form-control py-4 email_keypress" style="background-color: rgba(241, 241, 241, 0);" placeholder="{{ Auth::user()->email }}" autocomplete="off">
                            <span class="invalid-feedback append_login_email_errors" role="alert" style="margin-left: 5px; font-size: 14px; display: none;">
                            </span>
                          </div>
                          <div class="pass_btn" style="display: none;">
                            <div class="form-group">
                              <input type="password" name="password" class="form-control py-4 password_keypress" style="background-color: rgba(241, 241, 241, 0);" placeholder="Please enter your current password">
                              <span class="invalid-feedback append_login_password_errors" role="alert" style="margin-left: 5px; font-size: 14px; display: none;">
                              </span>
                            </div>
                            <button type="submit" class="btn btn-success link-light px-3 py-2 rounded mb-3 text-center d-block" name="button">Save</button>
                          </div>
                        </form>
                        <div id="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
                					<ul></ul>
                				</div>
                				<div id="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
                					<ul></ul>
                				</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <p>Your social login methods</p>
                      <a href="{{ url('/auth/redirect/facebook') }}" class="btn link-light bg-facebook px-3 py-2 rounded mb-2 text-center d-block">Connect with Facebook</a>
                      <a href="{{ url('/auth/redirect/google') }}" class="btn link-light bg-google rounded mb-2 py-2 text-center d-block">Connect with Google</a>
                      <!-- <div class="form-group">
                        <input type="text" name="email" class="form-control py-4" style="background-color: rgba(241, 241, 241, 0);" value="{{ Auth::user()->email }}" autocomplete="off">
                      </div> -->
                    </div>
                  </div>
                  <h4>Share your Bridebook</h4>
                  <hr class="my-2 mb-3 border-dark">
                  <p>Share info about your wedding with friends. This link is connected to your ‘Request Addresses’ link, the simplest way to gather contact details from your guests.</p>
                  <div class="generate_url_area" style="<?php $one = ($user->user_url == null ? '' : 'display: none;'); echo $one; ?>">
                    <h5 style="font-size:16px; font-weight: 600;" ><span>https://staging.mybigasianwedding.co.uk/</span><span style="color: #537cd7;" id="appned_url_name">YOURLINK</span></h5>
                    <hr class="my-2 mb-3 border-dark">
                    <div class="row mb-4">
                      <div class="col-md-12">
                        <form id="store_user_url" role="form" class="form-horizontal" method="post">
                          <div class="form-group">
                            <input type="text" name="url_name" class="form-control py-4 url_name" style="background-color: rgba(241, 241, 241, 0);" placeholder="e.g. Romeo Juliet 2021" autocomplete="off">
                            <span class="invalid-feedback url_name_already_exists" role="alert" style="margin-left: 5px; font-size: 14px; display: none;">
                            </span>
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-success link-light px-3 py-2 rounded mb-3 text-center d-block url_generate" name="button" disabled>Generate URL</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="delete_url_area" style="<?php $one = ($user->user_url != null ? '' : 'display: none;'); echo $one; ?>">
                    <h5 style="font-size:16px; font-weight: 600;" class="target_url"><a href="{{ url('/happy_wedding/'.$user->user_url) }}" style="color: #537cd7;">https://staging.mybigasianwedding.co.uk/{{ $user->user_url }}</a></h5>
                    <h5 style="font-size:16px; font-weight: 600; cursor: pointer; color: darkgray;" class="delete_url" >Delete URL</h5>
                  </div>
                </div>
      </div>
  </div>


<!-- Modal: help support -->
<!-- help up -->
<div id="help-popup" class="card help-up fixed-bottom mb-3" style="border-radius: 0.75rem;">
  <!-- FAQ search how -->
  <div class="step1">
    <div class="card-header bg-primary text-white text-center">
      <button type="button" class="help-close float-right bg-transparent border-0 text-white"><i style="font-size: 12px;" class="fa fa-minus" aria-hidden="true"></i></button>
      <h4 class="mb-0">Support</h4>
    </div>
    <div class="card-content">
      <div class="form-group mb-0 bg-primary px-3 pb-3">
        <input class="form-control" placeholder="How can we help?" name='help-search'>
      </div>
      <div class="p-4">
        <h5>Top results</h5>
        <p>text...</p>
      </div>
    </div>
    <div class="card-footer text-right">
      <button id="leave-msg-btn" type="button" class="btn btn-primary" style="border-radius: 5px;" name="button">leave us a message</button>
    </div>
  </div>
  <!-- leave us a message -->
  <div class="step2" style="display:none;">
    <div class="card-header bg-primary text-white text-center">
      <button type="button" class="help-close float-right bg-transparent border-0 text-white"><i style="font-size: 12px;" class="fa fa-minus" aria-hidden="true"></i></button>
      <button type="button" class="help-main float-left bg-transparent border-0 text-white"><i style="font-size: 12px;" class="fa fa-arrow-left" aria-hidden="true"></i></button>
      <h4 class="mb-0">Leave us a message</h4>
    </div>
    <form id="leave_message" role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
      @csrf
      <div class="card-content">
        <div id="append_success_message" style=" display: none;">
          <div class="py-2 px-3 text-center" style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;">
            <b>Thanks for reaching out</b><br>
            <p class="p-0 m-0">Someone will get back to you soon</p>
          </div>
        </div>
        <div class="p-4">
          <div class="form-group">
            <label class="text-pink font-weight-bold">Your name</label>
            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label class="text-pink font-weight-bold">Email address</label>
            <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label class="text-pink font-weight-bold">How can we help you?</label>
            <textarea rows="3" name="message" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label class="text-pink font-weight-bold">Attachments<span id="add_upto_files" style="color: rgb(169, 68, 66); display: none;"><strong> *Add upto 5 files</strong></span></label>
            <input type="file" class="form-control" name="files[]" multiple>
          </div>
          <!-- <div id="add_upto_files" style=" display: none;">
            <div class="py-2 px-3 text-center" style="color: rgb(169, 68, 66); background-color: rgb(242, 222, 222); border-color: rgb(235, 204, 209);">
            </div>
          </div> -->
        </div>
      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary" style="border-radius: 5px;" name="button">Send</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal: help support end -->

<!-- modal feedback -->
<div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-labelledby="modalFeedback" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header heading_color">
        <!-- <p class="heading lead">Give us feedback</p> -->
        <h4 class="modal-title" id="modalLargeLabel">Give us feedback</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff;">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <div class="container" style="width:630px;">
          <div id="append_success_feedback" class="mb-3" style="display: none;">
            <div class="py-3 px-3 text-center" style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6; border-radius: 5px; font-size: 16px;">
              <p class="p-0 m-0">Your feedback has been submitted.<br> Thanks for making myBigAsianWedding better!</p>
            </div>
          </div>
          <div class="text-left mb-4">
            We’d love to hear how Bridebook is working for you and what we can improve.<br><br>
            While we can’t respond to every piece of feedback individually, we love reading your comments. You can also find answers in our <span id="help_section" style="color: #537cd7; text-decoration: underline; cursor: pointer;"><strong>Help Section</strong></span> or <span id="contact_us_message" style="color: #537cd7; text-decoration: underline; cursor: pointer;"><strong>Contact us</strong></span> to get in touch with a lovely team member.
          </div>
          <form id="store_feedback" role="form" class="form-horizontal" method="post">
            @csrf
            <div class="form-group">
              <label class="text-pink font-weight-bold">What would you like to do?</label>
              <select class="form-control" name="feedback_type" required>
                <option value="">Please select</option>
                <option value="Report a bug">Report a bug</option>
                <option value="Give product feedback">Give product feedback</option>
                <option value="New feature request">New feature request</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group">
              <label class="text-pink font-weight-bold">What's your feedback about?</label>
              <select class="form-control" name="feedback_about" required>
                <option value="">Please select</option>
                <option value="Checklist">Checklist</option>
                <option value="Guest list">Guest list</option>
                <option value="Budget">Budget</option>
                <option value="Shortlist and booked suppliers">Shortlist and booked suppliers</option>
                <option value="Scrapbook">Scrapbook</option>
                <option value="Advice">Advice</option>
                <option value="Searching venues / suppliers">Searching venues / suppliers</option>
                <option value="Making enquiries">Making enquiries</option>
                <option value="Navigation / design">Navigation / design</option>
                <option value="Technical issues">Technical issues</option>
                <option value="Emails / notifications">Emails / notifications</option>
                <option value="New feature request">New feature request</option>
                <option value="My account">My account</option>
                <option value="Inviting a partner / collaborator">Inviting a partner / collaborator</option>
                <option value="Suggest a professional to be listed">Suggest a professional to be listed</option>
                <option value="General feedback">General feedback</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group">
              <label class="text-pink font-weight-bold">Tell us more..</label>
              <textarea class="form-control" name="feedback_notes" rows="6" cols="80" placeholder="Share your feedback with us. What's is working well? What could be improved?" required></textarea>
            </div>
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <button type="submit" class="btn btn-success link-light px-3 py-2 rounded mb-3 text-center d-block">Submit feedback</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- modal feedback end -->

<!-- Modal -->
<div class="modal fade" id="setting-date-popup" tabindex="-1" role="dialog" aria-labelledby="setting-date-popupLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 940px;" role="document">
        <div class="modal-content bg-lightgrey">
            <div class="signup-box p-3">
              <form id="update-date-ajax" role="form" class="form-horizontal" method="post">
                @csrf
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <div class="bg-center-left-url h-100 bs-signup-columns-box-img rounded-top rounded-md-left" style="background-image: url('web_asset/images/bg-signup-img4.png');"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="p-4 bs-steps-height">
                                <div class="form-group">
                                    <div class="float-right ml-2 my-1">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              					<span aria-hidden="true">&times;</span>
                              				</button>
                                    </div>
                                    <h3 class="font-weight-bold text-pink">What is your ideal wedding date?</h3>
                                    <h4 class="font-weight-bold append_date text-center" style="color: rgb(45, 186, 167);width: 351px;position: absolute;">{{ $user->weeding_date }}</h4>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-sm-7">
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
                                                <div class="mt-4">
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

                                            <div class="tab-pane fade step5-radiobox2" id="">
                                                <div class="mt-4">
                                                    <h5 class="text-purple">Select a season</h5>
                                                    <div class="form-group bs-form-db">
                                                        <div class="btn-group-toggle bs-sigup-radio-purple" data-toggle="buttons">
                                                            <label class="btn btn-light btn-grey seasonlabel <?php $spring = ($user->weeding_month_season == "spring" ? "active" : ""); echo $spring; ?>" for="selectseason1">
                                                                <input id="selectseason1" type="radio" class="selectseason" name="selectseason" value="spring" required <?php $cspring = ($user->weeding_month_season == "spring" ? "checked" : ""); echo $cspring; ?> /><i class="fal fa-2x fa-flower" title="spring"></i>
                                                            </label>
                                                            <label class="btn btn-light btn-grey seasonlabel <?php $summer = ($user->weeding_month_season == "summer" ? "active" : ""); echo $summer; ?>" for="selectseason2">
                                                                <input id="selectseason2" type="radio" class="selectseason" name="selectseason" value="summer" required <?php $csummer = ($user->weeding_month_season == "summer" ? "checked" : ""); echo $csummer; ?> /><i class="fal fa-2x fa-sun" title="summer"></i>
                                                            </label>
                                                            <label class="btn btn-light btn-grey seasonlabel <?php $autumn = ($user->weeding_month_season == "autumn" ? "active" : ""); echo $autumn; ?>" for="selectseason4">
                                                              <input id="selectseason4" type="radio" class="selectseason" name="selectseason" value="autumn" required <?php $cautumn = ($user->weeding_month_season == "autumn" ? "checked" : ""); echo $cautumn; ?> /><i class="fal fa-2x fa-feather-alt" title="autumn"></i>
                                                            </label>
                                                            <label class="btn btn-light btn-grey seasonlabel <?php $winter = ($user->weeding_month_season == "winter" ? "active" : ""); echo $winter; ?>" for="selectseason3">
                                                                <input id="selectseason3" type="radio" class="selectseason" name="selectseason" value="winter" required <?php $cwinter = ($user->weeding_month_season == "winter" ? "checked" : ""); echo $cwinter; ?> /><i class="fal fa-2x fa-snowflake" title="winter"></i>
                                                            </label>
                                                        </div>
                                                    </div>
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

                                            <div class="tab-pane fade step5-radiobox3" id="">
                                                 <div class="mt-4">
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
                                            <img src="web_asset/images/step5-icon.png" class="img-fluid" alt=""/>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-dark btn-block btn-purple StepNextBtn font-weight-bold mb-2">Save</button>
                                        </div>
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

      $('#leave_message').on('submit', function(event){
    		event.preventDefault();
        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length)>5){
          $('#add_upto_files').show();
          return false;
        }
        $.ajax({
          url:"{{ url('/store_message') }}",
          method:"POST",
    			data:new FormData(this),
          dataType:"JSON",
    			contentType:false,
    			cache:false,
    			processData:false,
    			success:function(data){
            $('#add_upto_files').hide();
            $('#append_success_message').slideDown();
            $("#leave_message")[0].reset();
            setTimeout(function(){ $('#append_success_message').slideUp(); },5000);
          },
        });
      });

      $('#store_feedback').on('submit', function(event){
    		event.preventDefault();
        $.ajax({
          url:"{{ url('/store_feedback') }}",
          method:"POST",
    			data:new FormData(this),
          dataType:"JSON",
    			contentType:false,
    			cache:false,
    			processData:false,
    			success:function(data){

            $('.append_success_data_message').html('');
            $('.append_success_data_message').html("<p>Your feedback has been submitted.<br/> Thanks for making myBigAsianWedding better!</p>");
            $('.append_success_message_whole_website').fadeIn();
            setTimeout(function(){
              $('.append_success_message_whole_website').fadeOut();
            },4000);

            $("#store_feedback")[0].reset();
            setTimeout(function(){ $('#modalFeedback').modal('hide'); },2000);
            setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					  setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
          },
        });
      });


      $('.remove_image').on('click',function(event){
    		event.preventDefault();

        var fo_d = new FormData();
        fo_d.append( 'user_id', "{{ Auth::user()->id }}" );

        $.ajax({
            type:'POST',
            url:"{{ url('/remove_user_image') }}",
    				data:fo_d,
            dataType:"JSON",
      			contentType:false,
      			cache:false,
      			processData:false,
            success:function(data){
              $('#blah_image').hide();
              $('.remove_image').hide();
              $('#blah').show();
            }
        });
      });

      $('.change_email').on('click', function(event) {
          event.preventDefault();
          $('.change_email_with_password').show();
          $('.change_credentils').hide();
          $('.my_email').hide();
      });

      $('.email_keypress').on("input", function() {
        if(this.value == ""){
          $('.pass_btn').hide();
        }else {
          $('.pass_btn').show();
        }
      });

      $('.url_name').on("input", function() {
        if(this.value == ""){
          $('#appned_url_name').text('YOURLINK');
          $('.url_generate').prop('disabled', true);
        }else {
          $('#appned_url_name').text('');
          var myStr = $(this).val();
          myStr=myStr.toLowerCase();
          myStr=myStr.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");
          myStr=myStr.replace(/\s+/g, "-");
          $('#appned_url_name').text(myStr);
          $('.url_generate').prop('disabled', false);
        }
      });

      $('#change_email_address').on('submit', function(event){
        event.preventDefault();
        $.ajax({
          url:"{{ url('/change_email_address') }}",
          method:"POST",
          data:new FormData(this),
          dataType:"JSON",
          contentType:false,
          cache:false,
          processData:false,
          success:function(data){

            $('.append_error_data_message').text('');
            $('.append_success_data_message').text('');
    				// $('.append_login_success').text('');
            // $('.append_login_password_errors').text('');
    				// $('.append_login_email_errors').text('');
            if(data.errors)
            {
              if(data.errors.email){
                // $.each(data.errors.email, function(i, error){
                // $('.append_login_email_errors').show();
                // $('.append_login_email_errors').append("<strong><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> " + data.errors.email[i] + "</strong>");
                // });

                $('.form-control').css("border-color", "#ced4da");

                if(data.errors.email[0] == "The email format is invalid."){
                  $('.append_error_data_message').text("Hmm, looks like that email is not in the correct format.");
                }else{
                  $('.append_error_data_message').text(data.errors.email[0]);
                }

                $('.email_keypress').css("border-color", "red");
                $('.append_error_message_whole_website').fadeIn();
                setTimeout(function(){
                  $('.append_error_message_whole_website').fadeOut();
                },3000);

              }else if (data.errors.password) {
                // $.each(data.errors.password, function(i, error){
                $('.form-control').css("border-color", "#ced4da");
                $('.append_error_data_message').text(data.errors.password[0]);
                $('.password_keypress').css("border-color", "red");
                $('.append_error_message_whole_website').fadeIn();
                setTimeout(function(){
                  $('.append_error_message_whole_website').fadeOut();
                },3000);

                // $('.append_login_password_errors').show();
                // $('.append_login_password_errors').append("<strong><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> " + data.errors.password[i] + "</strong>");
                // });
              }

            }else if (data.success){
              // $('.append_login_password_errors').hide();
              // $('.append_login_email_errors').hide();

              $("#change_email_address")[0].reset();
              $('.append_success_data_message').text(data.success[0]);
              $('.append_success_message_whole_website').fadeIn();
              setTimeout(function(){
                $('.append_success_message_whole_website').fadeOut();
              },3000);

              // $('.append_login_success').show();
              // $('.append_login_success').append("<strong><i class='fa fa-check' aria-hidden='true'></i> " + data.success[0] + "</strong>");

              $('.change_email_with_password').hide();
              $('.pass_btn').hide();
              $('.my_email').text(data.success[1]);
              $('.append_email').text(data.success[1]);
              $('.my_email').show();
              $('.email_keypress').attr('placeholder',data.success[1]);
              $('.change_credentils').show();
              // setTimeout(function(){ $('.append_login_success').slideUp(); },5000);
            }
          },
        });
      });

      $('#store_user_url').on('submit', function(event){
    		event.preventDefault();

        var fo_da = new FormData();
        var url_data = $('#appned_url_name').text();
        fo_da.append( 'user_id', "{{ Auth::user()->id }}" );
        fo_da.append( 'user_url', url_data );

        $.ajax({
          url:"{{ url('/store_user_url') }}",
          method:"POST",
    			data:fo_da,
          dataType:"JSON",
    			contentType:false,
    			cache:false,
    			processData:false,
    			success:function(data){
            $('.append_error_data_message').text('');
            $('.append_success_data_message').text('');
            if(data.errors){
              // $.each(data.errors.user_url, function(i, error){
                if(data.errors.user_url[0] == 'The user url has already been taken.'){
                  $('.append_error_data_message').text('URL is already taken. Please try another combination of letters and/or numbers.');
                  $('.append_error_message_whole_website').fadeIn();
                  setTimeout(function(){
                    $('.append_error_message_whole_website').fadeOut();
                  },3000);
                  // $('.url_name_already_exists').show();
                  // $('.url_name_already_exists').append("<strong><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> URL is already taken. Please try another combination of letters and/or numbers.</strong>");
                }else {
                  $('.append_error_data_message').text(data.errors.user_url[0]);
                  $('.append_error_message_whole_website').fadeIn();
                  setTimeout(function(){
                    $('.append_error_message_whole_website').fadeOut();
                  },3000);
                  // $('.url_name_already_exists').show();
                  // $('.url_name_already_exists').append("<strong><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> " + data.errors.user_url[i] + "</strong>");
                }
            	// });
            }else {
              $('.append_success_data_message').text(data.success);
              $('.append_success_message_whole_website').fadeIn();
              setTimeout(function(){
                $('.append_success_message_whole_website').fadeOut();
              },3000);
              $('.url_name_already_exists').hide();
              $('.generate_url_area').hide();
              $('.target_url').text('');
              $('.target_url').append('<a href="/happy_wedding/'+data.user_url.user_url+'" target="_blank" style="color: #537cd7;">https://mybigassianwedding/'+data.user_url.user_url+'</a>');
              $('.delete_url_area').show();
              $("#store_user_url")[0].reset();
              $('#appned_url_name').text('YOURLINK');
              $('.url_generate').prop('disabled', true);
            }
          },
        });
      });

      $('.delete_url').on('click',function(event){
    		event.preventDefault();
        if (confirm("Are you sure to delete this URL?")) {
          var fo_d = new FormData();
          fo_d.append( 'user_id', "{{ Auth::user()->id }}" );

          $.ajax({
              type:'POST',
              url:"{{ url('/delete_user_url') }}",
      				data:fo_d,
              dataType:"JSON",
        			contentType:false,
        			cache:false,
        			processData:false,
              success:function(data){
                $('.generate_url_area').show();
                $('.delete_url_area').hide();
              }
          });
        } else {
          return false;
        }
      });

      $('#get-help-btn').on('click', function(event) {
          event.preventDefault();
          $('#help-popup').addClass('active');
          $('#help-popup .step1').show();
          $('#help-popup .step2').hide();
      });
      $('#help_section').on('click', function(event) {
          event.preventDefault();
          $('#help-popup').addClass('active');
          $('#help-popup .step1').show();
          $('#help-popup .step2').hide();
      });
      $('.help-close').on('click', function(event) {
          event.preventDefault();
          $('#help-popup').removeClass('active');
      });
      $('.help-main').on('click', function(event) {
        event.preventDefault();
        $('#help-popup').addClass('active');
        $('#help-popup .step1').show();
        $('#help-popup .step2').hide();
      });
      $('#leave-msg-btn').on('click', function(event) {
          event.preventDefault();
          $('#help-popup .step1').hide();
          $('#help-popup .step2').show();
      });
      $('#contact_us_message').on('click', function(event) {
          event.preventDefault();
          $('#help-popup').addClass('active');
          $('#help-popup .step1').hide();
          $('#help-popup .step2').show();
          $('#help-popup .help-main').hide();
      });

      $('.done').on('click', function(event) {
        event.preventDefault();
        location.reload();
      });
      var months = {'January' : '1', 'February' : '2', 'March' : '3', 'April' : '4', 'May' : '5', 'June' : '6', 'July' : '7', 'August' : '8', 'September' : '9', 'October' : '10', 'November' : '11', 'December' : '12'};
      $.each( months, function( key, value ) {
        if(key == "{{ $user->weeding_month_season }}"){
          $('.date_selector').show();
          var startDate = new Date("{{ $user->weeding_year }}", value-1, "{{ $user->weeding_day_date }}");
          $(".datepicker-show").datepicker("setDate", startDate);
        }
      });
    });
  </script>
  <style type="text/css">
    .step3 .typeahead.dropdown-menu a.dropdown-item::first-line,.step3 .typeahead.dropdown-menu a.dropdown-item:first-line {white-space: pre-line; line-height:23px;color:#000000;}
    .step3 .typeahead.dropdown-menu a.dropdown-item{white-space: pre-line; line-height:23px;color:#8a8484;}
      .form-control{
        border-radius: 5px;
      }
      .card.help-up.fixed-bottom{
          z-index:9999;
          padding-right: 0px !important;
      }
      .card.help-up.fixed-bottom {width:330px;right:15px;left:auto;bottom:-600px;transition-duration: 250ms;transition-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);transition-property: opacity, top, bottom;}
      .card.help-up.fixed-bottom .card-content{height: 420px;}

      .card.help-up.fixed-bottom.active {bottom:0px;}
      .card.help-up.fixed-bottom .card-content{height: 420px;}

      .card.help-up .bg-primary,.card.help-up .btn.btn-primary{background-color: rgb(83, 125, 215) !important;color: rgb(255, 255, 255) !important;border-color: rgb(83, 125, 215) !important;}
      .card-header:first-child {
          border-radius: calc(0.75rem - 1px) calc(0.75rem - 1px) 0 0;
      }
  </style>
@endsection
