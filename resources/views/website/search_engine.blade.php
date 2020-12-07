@extends('layouts.app')
@section('title','Search')

@section('content')
</div>
<!-- section 1 free wedding planning app-->
<div class="bg-light">
    <div class="container py-3">
        <div class="breadcrumbs">
            <span class="breadcrumb-item">Weddings</span>
            <span class="breadcrumb-item">Wedding Venues</span>
        </div>
    </div>
</div>
<!-- header-title-content -->
<div class="bg-center-url bg-dark bg-overlay-dark" style="background-image: url('{{ asset('web_asset/images/bg-dhol-baraat-ceremony-celebration.jpg') }}');">
    <div class="container text-light link-light text-center">
        <div class="row" style="min-height:300px;">
            <div class="col-md-12 align-self-center py-50">
                <h1>Wedding Venues</h1>
                <p>Choosing the right wedding venue is the most time consuming part of your wedding planning, but this section is here to save you time. No matter what you want from your wedding venue, you can find the perfect setting for your special day on My Big Asian Wedding.</p>
            </div>
        </div>
    </div>
</div>
<!-- Results -->
<!-- <div class="border-bottom">
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
<div class="container py-4">
  <!-- columns 2 -->
  <div class="row">
    <div class="col-md-4 col-lg-3">
      <div role="form" class="form-horizontal" id="serach_filter_form">
        <div class="form-group bg-purple-d2 padding text-light p-3">
            <h4 class="text-warning">Search</h4>
            <p>Lorem Ipsum is simply dummy text of the printing</p>
            <div class="form-group">
                <h5>Search for</h5>
                <input type="text" name="search_by_keyword" class="form-control rounded" placeholder="Search by keyword" value="{{ ($keyword_search == '' ? '' : $keyword_search) }}">
            </div>
            <div class="form-group">
                <h5>Loaction</h5>
                <input type="text" name="location_name_searched" placeholder="Search location" class="form-control areaofuk rounded" value="{{ ($search_location == 'UK' ? '' : $search_location) }}" autocomplete="off">
            </div>
            <div class="form-group">
                <h5>Category</h5>
                <select name='category_id_searched' class="form-control category_search_form filters custom-select rounded">
                  <?php foreach ($categories as $key => $value): ?>
                    <option value="{{ $value->category_name }}" <?php if($value->category_name == $category_search) echo "selected"; ?>>{{ $value->category_name }}</option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-warning btn-block" id="form_submit" name="button">Search</button>
            </div>
        </div>
        <?php
        $arr_names = array();
          foreach ($sections as $key => $value) {
            foreach ($value->questions as $key => $val) {
              array_push($arr_names, $val->question_name);
              echo "<div class='form-group'>";
              echo "<h4 class='font-weight-bold mb-2'>$val->question_label</h4>";
              $select = "";
              if(($val->type == "text" && count($val->listings) == 0)){
                echo "<input type='$val->type' name='$val->question_name' class='form-control filters' placeholder='$val->question_placeholder'>";
              }
              elseif (($val->type == "text" && isset($val->listings) && count($val->listings) > 0)) {
                $check = "";
                foreach ($val->listings as $key => $chk_val) {
                  $check = $chk_val;
                }
                echo "<input type='$val->type' name='$val->question_name' class='form-control filters' value='$check'>";
              }
              if($val->type == "select" && count($val->listings) == 0){
                $select .= "<select name='$val->question_name' class='form-control appended_select filters'><option value=''>Select $val->question_label</option>";
              }
              elseif ($val->type == "select" && count($val->listings) > 0) {
                // array_push($arr_name_updated, "updated_".$val->question_name);
                // foreach ($val->listings as $key => $list_selectbox) {
                  $select .= "<select name='$val->question_name' class='form-control appended_select filters'><option value=''>Select $val->question_label</option>";
                // }
              }
              $options = "";
              foreach ($val->answers as $key => $answer) {
                if(($val->type == "checkbox" && count($val->listings) == 0) || ($val->type == "radio" && count($val->listings) == 0)){
                  echo "<div class='form-check bs-custom-checkbox mb-2'><span class='float-right'></span><input type='checkbox' name='$val->question_name' id='$answer->answer_name' value='$answer->answer_name' class='form-control filters form-check-input'><label class='form-check-label d-inline' style='vertical-align: text-top;' for='$answer->answer_name'> "."$answer->answer_name"."</label></div>";
                }elseif (($val->type == "checkbox" && isset($val->listings) && count($val->listings) > 0) || ($val->type == "radio" && isset($val->listings) && count($val->listings) > 0)) {
                  $check = "";
                  foreach ($val->listings as $key => $chk) {
                    if($chk == $answer->answer_name){
                      $check = "checked";
                    }
                  }
                  echo "<div class='form-check bs-custom-checkbox mb-2'><span class='float-right'></span><input type='checkbox' name='$val->question_name' id='$answer->answer_name' value='$answer->answer_name' class='form-control filters form-check-input' $check><label class='form-check-label d-inline' style='vertical-align: text-top;' for='$answer->answer_name'> "."$answer->answer_name"."</label></div>";
                }
                if($val->type == "select" && count($val->listings) == 0){
                  $options .= "<option value='$answer->answer_name'>"."$answer->answer_name"."</option>";
                }elseif ($val->type == "select" && count($val->listings) > 0) {
                  $selected = "";
                  foreach ($val->listings as $key => $selecte) {
                    if($selecte == $answer->answer_name){
                      $selected = "selected";
                    }
                  }
                  $options .= "<option value='$answer->answer_name' $selected>"."$answer->answer_name"."</option>";
                }
              }
              $select .= $options;
              echo "$select"."</select>";
              echo "</div>";
            }
            echo "<hr/>";
          }
        ?>
      </div>
    </div>
    <div class="col-md-8 col-lg-9">
      <!-- title -->
      <div class="clearfix mb-4">
          <a class="btn btn-warning text-dark font-weight-bold float-right" href="search-map.html">Show Map <i class="far fa-map-marker-alt"></i></a>
          <h2 class="font-weight-bold">{{ $suppliers_count }} suppliers</h2>
      </div>
      <!-- product-section -->
      <div class="row">
        <?php foreach ($businesses as $key => $value): ?>
          <div class="col-md-6 col-lg-4">
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
                          <p class="bg-warning">SPECIAL DISCOUNT</p>
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
      <ul class="pagination" role="navigation">
        {{ $businesses->appends([
          'sort_type' => app('request')->input('sort_type')
        ])->links() }}
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
        // var url_web = "{{ url('/view_data_submissions') }}";
        // var url = url_web+'/search/wedding-'+sel_cat+'/'+sel_loc+fdata+qdata;
        var url = '/search/wedding-'+sel_cat+'/'+sel_loc+fdata+qdata;
        window.location = url;
    });
  });
  </script>
@endsection
