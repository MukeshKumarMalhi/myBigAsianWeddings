<!-- Navbar links -->
<div id="wrapper" class="dashboard-page closed">
    <!-- Sidebar-left -->
    <div class="sidebar-wrapper text-light">
        <div class="px-1 pt-3 bs-sideber-photos">
            <div class="text-center">
                <div class="bs-sideber-col-6 mb-1">
                    <a href="#Bride"><img src="{{ asset('web_asset/images/photos/girl-img1.png') }}" class="img-fluid img-thumbnail bs-photos rounded-circle"></a>
                    <h4 class="font-weight-bold">Bride</h4>
                    <p>me</p>
                </div>
                <div class="bs-sideber-col-6 mb-1">
                    <a href="#create"><img src="{{ asset('web_asset/images/photos/add-person-icon.png') }}" class="img-fluid img-thumbnail bs-photos rounded-circle"></a>
                    <h4 class="font-weight-bold">Groom</h4>
                    <p>Create</p>
                </div>
            </div>
        </div>
        <div class="pb-3">
            <ul class="list-sidebar list-unstyled">
                <li class="active"><a href="dashboard.html"><i class="bs-sidebar-icon fal fa-chart-bar"></i>&nbsp;<span class="bs-sidebar-text">Dashboard</span></a></li>
                <li><a href="#"><i class="bs-sidebar-icon fal fa-calendar-alt"></i>&nbsp;<span class="bs-sidebar-text">Events</span></a></li>
                <li><a href="#"><i class="bs-sidebar-icon fal fa-clipboard-list-check"></i>&nbsp;<span class="bs-sidebar-text">Checklist</span></a></li>
                <li><a href="#"><i class="bs-sidebar-icon far fa-money-bill-wave"></i>&nbsp;<span class="bs-sidebar-text">Budgeting</span></a></li>
                <li><a href="#"><i class="bs-sidebar-icon far fa-user"></i>&nbsp;<span class="bs-sidebar-text">Guests List</span></a></li>
                <li><a href="#"><i class="bs-sidebar-icon fal fa-comment-alt"></i>&nbsp;<span class="bs-sidebar-text">Message</span></a></li>
                <li><a href="#"><i class="bs-sidebar-icon far fa-calendar-alt"></i>&nbsp;<span class="bs-sidebar-text">Calendar</span></a></li>
                <li><a href="#"><i class="bs-sidebar-icon far fa-life-ring"></i>&nbsp;<span class="bs-sidebar-text">Help Center</span></a></li>
                <li><a href="#"><i class="bs-sidebar-icon fal fa-cog"></i>&nbsp;<span class="bs-sidebar-text">Settings</span></a></li>
            </ul>
        </div>
        <button class="menu-press text-center btn btn-dark btn-lightpurple rounded-circle py-2"><i class="fal fa-arrow-from-right"></i></button>
    </div>

    <!-- Page Content -->
    <div class="page-content-wrapper">

        <!-- sideber-right -->
        <div class="navbar-collapse offcanvas-collapse">
            <ul class="navbar-nav mr-auto text-white link-light">
                <li class="py-2"><a href="dashboard.html"><i class="bs-sidebar-icon fal fa-chart-bar"></i>&nbsp;<span class="bs-sidebar-text">My Profile</span></a></li>
                <li class="py-2"><a href="events.html"><i class="bs-sidebar-icon fal fa-calendar-alt"></i><span class="bs-sidebar-text">Settings</span></a></li>
                <li class="py-2"><a href="guests-list.html"><i class="bs-sidebar-icon far fa-user fa-"></i>&<span class="bs-sidebar-text">Logout</span></a></li>
            </ul>
        </div>
        <!--End- sideber-right -->

        <!-- layout -->
        <button class="menu-press text-left btn btn-danger btn-pink btn-block rounded-0 d-md-none"><i class="fal fa-bars"></i> Menu Open</button>

            <div class="alert alert-success alert-dismissible mb-0 py-3 append_success_message_whole_website font-weight-bold" style="display: none;">
              <div class="append_success_data_message">
              </div>
              <button type="button" class="close" data-dismiss="alert"><i class='fa fa-check' aria-hidden='true'></i></button>
            </div>
            <div class="alert alert-primary alert-dismissible mb-0 py-3 append_remove_message_whole_website font-weight-bold" style="display: none;">
              <div class="append_remove_data_message">
              </div>
              <button type="button" class="close" data-dismiss="alert"><i class="fas fa-info-circle"></i></button>
            </div>
            <div class="alert alert-danger alert-dismissible mb-0 py-3 append_error_message_whole_website font-weight-bold" style="display: none;">
              <div class="append_error_data_message">
              </div>
              <button type="button" class="close" data-dismiss="alert"><i class='fa fa-exclamation-triangle' aria-hidden='true'></i></button>
            </div>
            <div class="pt-r10 bg-center-url hidden_class_user_info" style="background-image: url('{{ asset('web_asset/images/bg-home.png') }}');">
                <div class="container bs-search-form text-center link-light text-light py-80">
                    <h2 class="font-weight-bold mb-2 font-playfairdisplay groom_bride" style="display: inline;">{{ ($user->name == "" || $user->partner_name == "" ? "Your Wedding" : $user->name." & ".$user->partner_name) }} </h2>
                    <a href="{{ asset('/settings') }}" title="My Settings" ><i class="fal fa-pencil" style="font-size: 16px;line-height: 33px;vertical-align: bottom;display: inline-block;" aria-hidden="true"></i></a>
                    <?php
                      // $weeding_date = "";
                      // if($user->weeding_date != ""){
                      //   $weeding_date = date('d M Y',strtotime($user->weeding_date));
                      //   $duration_detail = date_diff(new DateTime(), new DateTime($user->weeding_date));
                      //   $duration = $duration_detail->days;
                      // }
                    ?>
                    <h5>{{ ($user->weeding_date == "" && $user->location_id == "" ? "No wedding date and location yet" : '') }}</h5>
                    <h5 class="weeding_date_ajax">{{ ($user->weeding_date == "" ? "No weeding date yet" : $user->weeding_date) }}</h5>
                    <h5 class="mb-3 location_change">{{ ($user->location_id == "" ? "No wedding location yet" : $user->location_name) }}</h5>
                    <h3 class="weeding_days_count_ajax">{{ ($user->weeding_date == "" ? "" : $user->weeding_days_remaining." days to go!") }}</h3>
                </div>
                <div class="container">
                    <div class="row no-gutters-10 text-center">
                        <div class="col-6 col-md-4 col-lg">
                            <div class="bg-light p-3 mb-3">
                                <img src="{{ asset('web_asset/images/checklist-icon.png') }}" class="img-fluid m-auto">
                                <h3 class="font-weight-bold font-playfairdisplay">Home</h3>
                                <div class="bs-white-box-button"><a href="{{ url('/home') }}">{{ ($user->weeding_date == "" ? "" : $user->weeding_days_remaining." days to go!") }}</a></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg">
                            <div class="bg-light p-3 mb-3">
                                <img src="{{ asset('web_asset/images/guest-list-icon.png') }}" class="img-fluid m-auto">
                                <h3 class="font-weight-bold font-playfairdisplay">Guest list</h3>
                                <div class="bs-white-box-button"><a href="#">0 invited <i class="far fa-long-arrow-right"></i></a></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg">
                            <div class="bg-light p-3 mb-3">
                                <img src="{{ asset('web_asset/images/checklist-icon.png') }}" class="img-fluid m-auto">
                                <h3 class="font-weight-bold font-playfairdisplay">Checklist</h3>
                                <div class="bs-white-box-button"><a href="#">0% complete <i class="far fa-chevron-double-right"></i></a></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg">
                            <div class="bg-light p-3 mb-3">
                                <img src="{{ asset('web_asset/images/budget-icon.png') }}" class="img-fluid m-auto">
                                <h3 class="font-weight-bold font-playfairdisplay">Budget</h3>
                                <div class="bs-white-box-button"><a href="#">Get started <i class="far fa-long-arrow-right"></i></a></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg offset-md-2 offset-lg-0">
                            <div class="bg-light p-3 mb-3">
                                <img src="{{ asset('web_asset/images/shortlist-icon.png') }}" class="img-fluid m-auto">
                                <h3 class="font-weight-bold font-playfairdisplay">Shortlist</h3>
                                <div class="bs-white-box-button"><a href="#">0 saved <i class="far fa-long-arrow-right"></i></a></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg">
                            <div class="bg-light p-3 mb-3">
                                <img src="{{ asset('web_asset/images/gift-lists-icon.png') }}" class="img-fluid m-auto">
                                <h3 class="font-weight-bold font-playfairdisplay">Advice</h3>
                                <div class="bs-white-box-button"><a href="#">257 ideas <i class="far fa-long-arrow-right"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="background-color: #4E2A5E;" class="hidden_class_form">
              <div class="container">
              <form class="text-center sub_header_search_form" method="get">
                @csrf
                <div class="mx-auto text-left">
                  <div class="row pt-3 no-gutters">
                    <div class="form-group col-md-4">
                      <div class="d-md-table align-middle">
                        <div class="d-md-table-cell pt-1 pr-2 text-white text-nowrap">We’re looking for </div>
                        <div class="d-md-table-cell w-100 disabled_custom">
                          <select name="category_id_searched" class="form-control category_search_form">
                            <?php foreach ($categories as $key => $value): ?>
                              <option value="{{ $value->id }}" <?php if($value->category_name == "Venues") echo "selected"; ?>>{{ $value->category_name }}</option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-md-3">
                      <div class="d-md-table align-middle">
                        <div class="d-md-table-cell pt-1 pr-1 text-white text-nowrap px-md-4">near</div>
                        <div class="d-md-table-cell w-100 disabled_custom">
                          <input type="text" name="location_name_searched" placeholder="Location" class="form-control areaofp location_name_searched" value="{{ $user->location_name }}" autocomplete="off">
                          <input type="hidden" name="location_id_searched" class="location_id_searched" value="{{ $user->location_id }}">
                          <input type="hidden" name="category_name_searched" class="category_name_searched" value="">
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <div class="d-md-table align-middle">
                        <div class="d-md-table-cell pt-1 pr-1 text-white text-nowrap px-md-4">or called</div>
                        <div class="d-md-table-cell w-100 disabled_custom">
                          <input type="text" name="business_name_searched" placeholder="e.g. 'The Ritz, London'" class="form-control areaofb business_name_searched" autocomplete="off">
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
