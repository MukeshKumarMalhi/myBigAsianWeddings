@extends('layouts.l_app')
@section('title','Business Signup')

@section('content')
<!-- <div class="container py-3">
  <div id="append_errors" style="width: 100%; color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; display: none;">
    <ul class="exists_error"></ul>
  </div>
  <div id="append_success" style="width: 100%; color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; display: none;">
    <ul></ul>
  </div>
</div> -->
<!-- <div class="steps-box" style="min-height: 680px;"> -->
<div class="bg-center-url min-vh-100">
  <div class="container text-left py-4">
    <div class="media media-signup align-items-center">
    <div class="mr-2"><a href="{{ url('/') }}"><img src="{{ asset('web_asset/images/mybigasianwedding-logo.png') }}" class="img-fluid"></a></div>
    <div class="media-body">
    <h3 class="font-gotham-medium">UK's Biggest Wedding Suppliers Directory</h3>
    <h2 class="font-feelin-sweet display-4">Wedding Suppliers Signup</h2>
    </div>
  </div>

    <div class="row no-gutters my-3">
      <div class="col-md-8 bg-warning">
        <form method="post" role="form" class="form-horizontal" id="business-register-data" enctype="multipart/form-data" novalidate>
          @csrf
          <?php
            $step = 1;
            foreach ($sections as $key => $value) {
              echo "<div class='p-3 px-lg-5 py-lg-4'>";
              echo "<h4 class='font-gotham-medium mb-3'>$value->section_name</h4>";
              echo "<div class='row align-items-end'>";
              $arr_names = array();
              $count = 0;
              foreach ($value->questions as $key => $val) {

                array_push($arr_names, $val->question_name);

                if (($val->type == "text") && ($val->question_name == "business_name" || $val->question_name == "email" || $val->question_name == "address")){
                  echo "<div class='form-group col-sm-12'>";
                }
                else {
                  echo "<div class='form-group col-sm-6'>";
                }
                if((isset($val->question_label) || $val->question_label != "")){
                  echo "<label class='font-gotham-medium'>$val->question_label"."</label>";
                }else{
                  echo "";
                }

                $question_mandatory = '';
                $question_class = '';
                $exists_business_name = '';
                $exists_business_name_convert_to_slug = '';
                $slug_display_none = '';
                $is_phone_number = '';
                if($val->question_mandatory == true){
                  $question_mandatory = 'required';
                }
                if($val->question_name == 'location'){
                  $question_class = 'areaofuk';
                }
                if($val->question_name == 'slug' || $val->question_name == 'accept_terms_conditions'){
                  $slug_display_none = "style='display: none;'";
                }
                if($val->question_name == 'business_name'){
                  $exists_business_name = 'business_name_exists';
                  $exists_business_name_convert_to_slug = "onkeyup='convertToSlug(this.value)'";
                }
                if($val->question_name == 'phone_number'){
                  $is_phone_number = " onkeypress='return isNumber(event)'";
                }
                if($val->type == "text"){
                  echo "<div class='input-group' $slug_display_none><input type='$val->type' name='$val->question_name"."_answer_text' class='form-control border-right-0 $question_class $exists_business_name' $exists_business_name_convert_to_slug $is_phone_number placeholder='$val->question_placeholder' $question_mandatory autocomplete='off'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'><div class='input-group-append'><span class='input-group-text bg-white pl-1'><i class='$val->question_icon text-warning'></i></span></div></div>";
                }
                if($val->type == "password"){
                  echo "<div class='input-group'><input type='$val->type' id='$val->question_name"."_answer_text' name='$val->question_name"."_answer_text' class='form-control border-right-0' placeholder='$val->question_placeholder' $question_mandatory autocomplete='off'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'><div class='input-group-append'><span class='input-group-text bg-white pl-1'><i class='$val->question_icon text-warning'></i></span></div></div>";
                }
                if(($val->type == "text") && ($val->question_name == "business_name" || $val->question_name == "email" || $val->question_name == "address")){
                  echo "</div>";
                }else {
                  echo "</div>";
                }
                $count++;
              }
              $category_dropbox = "<div class='form-group col-sm-12'><label class='font-gotham-medium'>Select Category</label><select class='form-control' name='category_id' id='category_id'><option value=''>Select Category</option>";
              foreach ($categories as $key => $cat) {
                $category_dropbox .= "<option value='".$cat->id."'>".$cat->category_name."</option>";
              }
              $category_dropbox .= "</select></div>";
              echo $category_dropbox;
              $sub_category_dropbox = "<div class='form-group col-sm-12 sub_category_col' style='display: none;'><select class='form-control' name='sub_category_id' id='sub_category_id'></select></div>";
              echo $sub_category_dropbox;

              foreach($arr_names as $nname){
                echo '<input type="hidden" name="all_names[]" value="'. $nname. '">';
              }
              echo "</div>";
          ?>
          <div class="clear-fix">
            <div class="form-group float-right text-right">
              <div class="d-md-table-cell align-middle">
                <button type="submit" class="btn btn-dark px-5 mr-1">Sign Up</button>
              </div>
            </div>
            <div class="form-group float-left">
              <div class="form-check bs-custom-checkbox border-dark mt-1">
                <input type="checkbox" name="acceptcheckbox1" class="form-check-input" id="accept-checkbox1" value="I accept My Big Asian Wedding Terms of Use and Privacy Policy">
                <label class="form-check-label d-inline font-gotham-medium" for="accept-checkbox1">I accept My Big Asian Wedding <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a></label>
              </div>
            </div>
          </div>
          <?php
            }
          ?>
          <input type="hidden" name="location_id" id="location_id">
        </div>
        </form>
      </div>
      <div class="col-md-4 bg-white d-none d-md-block">
        <div class="bg-center-url h-100" style="background-image: url(' {{ asset('web_asset/images/bg-hall-img1.png') }} ');"></div>
      </div>
    </div>
    <div class="text-center mt-5 mb-3">
        <h1>Search by Category to Find Your Wedding Suppliers</h1>
    </div>
    <div class="row my-3" style="max-width: 1000px; margin: auto;">
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
            <div class="font-gotham-bold mt-3">Wedding Suppliers</div>
            <div><a href="{{ url('/search/wedding-beauty-and-spa/UK') }}" target="_blank">Beauty, Hair & Make Up</a></div>
            <div><a href="#">Bridalwear Shops</a></div>
            <div><a href="{{ url('/search/wedding-cakes/UK') }}" target="_blank">Cakes</a></div>
            <div><a href="{{ url('/search/wedding-florists/UK') }}" target="_blank">Florists</a></div>
            <div><a href="#">Marquee & Tipi Hire</a></div>
            <div><a href="#">Groom Attire</a></div>
            <div><a href="#">Confetti and Bubbles</a></div>
            <div><a href="#">Hen and Stag nights</a></div>
            <div><a href="#">Dress Cleaning and Boxes</a></div>
            <div><a href="#">Favours</a></div>
        </div>
        <div class="col-md-3">
            <div class="font-gotham-bold mt-3">&nbsp;</div>
            <div><a href="{{ url('/search/wedding-decoration/UK') }}" target="_blank">Decorative Hire</a></div>
            <div><a href="{{ url('/search/wedding-entertainment/UK') }}" target="_blank">Entertainment</a></div>
            <div><a href="{{ url('/search/wedding-photographer/UK') }}" target="_blank">Photographers</a></div>
            <div><a href="{{ url('/search/wedding-photo-booths/UK') }}" target="_blank">Photo Booths</a></div>
            <div><a href="{{ url('/search/wedding-honeymoon/UK') }}" target="_blank">Honeymoons</a></div>
            <div><a href="{{ url('/search/wedding-destination-weddings/UK') }}" target="_blank">Destination Weddings</a></div>
            <div><a href="#">Toastmasters</a></div>
            <div><a href="#">Sweets and treats</a></div>
            <div><a href="#">Mobile Bar Services</a></div>
            <div><a href="{{ url('/search/wedding-wedding-music/UK') }}" target="_blank">Music & DJs</a></div>
            <div><a href="{{ url('/search/wedding-stationery/UK') }}" target="_blank">Stationery</a></div>
        </div>
        <div class="col-md-3">
            <div class="font-gotham-bold mt-3">Vendor Categories</div>
            <div><a href="{{ url('/search/wedding-venues/UK') }}" target="_blank">Wedding Venues</a></div>
            <div><a href="{{ url('/search/wedding-photographer/UK') }}" target="_blank">Wedding Photographers</a></div>
            <div><a href="{{ url('/search/wedding-beauty-and-spa/UK') }}" target="_blank">Beauty Makeup</a></div>
            <div><a href="{{ url('/search/wedding-decoration/UK') }}" target="_blank">Tent & Decorators</a></div>
            <div><a href="{{ url('/search/wedding-jewellery/UK') }}" target="_blank">Bridal Jewellery</a></div>
            <div><a href="{{ url('/search/wedding-accessories/UK') }}" target="_blank">Wedding Accessories</a></div>
            <div><a href="#">Wedding Packing</a></div>
            <div><a href="{{ url('/search/wedding-cakes/UK') }}" target="_blank">Cakes</a></div>
            <div><a href="#">Mehendi Artist</a></div>
            <div><a href="#">Sangeet Choreographers</a></div>
            <div><a href="#">DJ</a></div>
            <div><a href="{{ url('/search/wedding-catering/UK') }}" target="_blank">Wedding Caterers</a></div>
            <div><a href="{{ url('/search/wedding-videographers/UK') }}" target="_blank">Marriage Videography</a></div>
            <div><a href="{{ url('/search/wedding-bridal-dresses/UK') }}" target="_blank">Bridal Wear</a></div>
            <div><a href="{{ url('/search/wedding-groom-dresses/UK') }}" target="_blank">Groom Wear</a></div>
            <div><a href="{{ url('/search/wedding-wedding-cards/UK') }}" target="_blank">Invitation Cards</a></div>
            <div><a href="#">Favors</a></div>
            <div><a href="{{ url('/search/wedding-wedding-planners/UK') }}" target="_blank">Wedding Planners</a></div>
        </div>
        <div class="col-md-3">
            <div class="font-gotham-bold mt-3">London</div>
            <div><a href="{{ url('/search/wedding-venues/London') }}" target="_blank">Venues in London</a></div>
            <div><a href="#">4+ Star Hotels</a></div>
            <div><a href="#">Banquet Halls</a></div>
            <div><a href="#">Marriage Lawns</a></div>
            <div><a href="#">Wedding Hotels</a></div>
            <div><a href="#">Wedding Resorts</a></div>
            <div><a href="#">Indoor</a></div>
            <div><a href="#">Outdoor</a></div>
            <div><a href="#">Pool Side</a></div>
            <div><a href="#">Terrace party venues</a></div>
            <div><a href="{{ url('/search/wedding-photogrphers/London') }}" target="_blank">Photogrphers in London</a></div>
            <div><a href="{{ url('/search/wedding-beauty-and-spa/London') }}" target="_blank">Bridal Makeup in London</a></div>
            <div><a href="{{ url('/search/wedding-bridal-dresses/London') }}" target="_blank">Bridal Wear in London</a></div>
            <div><a href="{{ url('/search/wedding-groom-dresses/London') }}" target="_blank">Groom Wear in London</a></div>
            <div><a href="{{ url('/search/wedding-decoration/London') }}" target="_blank">Tent & Decorators in London</a></div>
            <div><a href="{{ url('/search/wedding-wedding-cards/London') }}" target="_blank">Invitation Cards in London</a></div>
            <div><a href="#">Favors in London</a></div>
        </div>
        <div class="col-md-3">
            <div class="font-gotham-bold mt-3">Birmingham</div>
            <div><a href="{{ url('/search/wedding-venues/Birmingham') }}" target="_blank">Venues in Birmingham</a></div>
            <div><a href="#">4+ Star Hotels</a></div>
            <div><a href="#">Banquet Halls</a></div>
            <div><a href="#">Marriage Lawns</a></div>
            <div><a href="#">Wedding Hotels</a></div>
            <div><a href="#">Wedding Resorts</a></div>
            <div><a href="#">Indoor</a></div>
            <div><a href="#">Outdoor</a></div>
            <div><a href="#">Pool Side</a></div>
            <div><a href="#">Terrace party venues</a></div>
            <div><a href="{{ url('/search/wedding-photogrphers/Birmingham') }}" target="_blank">Photogrphers in Birmingham</a></div>
            <div><a href="{{ url('/search/wedding-beauty-and-spa/Birmingham') }}" target="_blank">Bridal Makeup in Birmingham</a></div>
            <div><a href="{{ url('/search/wedding-bridal-dresses/Birmingham') }}" target="_blank">Bridal Wear in Birmingham</a></div>
            <div><a href="{{ url('/search/wedding-groom-dresses/Birmingham') }}" target="_blank">Groom Wear in Birmingham</a></div>
            <div><a href="{{ url('/search/wedding-decoration/Birmingham') }}" target="_blank">Tent & Decorators in Birmingham</a></div>
            <div><a href="{{ url('/search/wedding-wedding-cards/Birmingham') }}" target="_blank">Invitation Cards in Birmingham</a></div>
            <div><a href="#">Favors in Birmingham</a></div>
        </div>
        <div class="col-md-3">
            <div class="font-gotham-bold mt-3">Glasgow</div>
            <div><a href="{{ url('/search/wedding-venues/Glasgow') }}" target="_blank">Venues in Glasgow</a></div>
            <div><a href="#">4+ Star Hotels</a></div>
            <div><a href="#">Banquet Halls</a></div>
            <div><a href="#">Marriage Lawns</a></div>
            <div><a href="#">Wedding Hotels</a></div>
            <div><a href="#">Wedding Resorts</a></div>
            <div><a href="#">Indoor</a></div>
            <div><a href="#">Outdoor</a></div>
            <div><a href="#">Pool Side</a></div>
            <div><a href="#">Terrace party venues</a></div>
            <div><a href="{{ url('/search/wedding-photogrphers/Glasgow') }}" target="_blank">Photogrphers in Glasgow</a></div>
            <div><a href="{{ url('/search/wedding-beauty-and-spa/Glasgow') }}" target="_blank">Bridal Makeup in Glasgow</a></div>
            <div><a href="{{ url('/search/wedding-bridal-dresses/Glasgow') }}" target="_blank">Bridal Wear in Glasgow</a></div>
            <div><a href="{{ url('/search/wedding-groom-dresses/Glasgow') }}" target="_blank">Groom Wear in Glasgow</a></div>
            <div><a href="{{ url('/search/wedding-decoration/Glasgow') }}" target="_blank">Tent & Decorators in Glasgow</a></div>
            <div><a href="{{ url('/search/wedding-wedding-cards/Glasgow') }}" target="_blank">Invitation Cards in Glasgow</a></div>
            <div><a href="#">Favors in Glasgow</a></div>
        </div>
        <div class="col-md-3">
            <div class="font-gotham-bold mt-3">Bradford</div>
            <div><a href="{{ url('/search/wedding-venues/Bradford') }}" target="_blank">Venues in Bradford</a></div>
            <div><a href="#">4+ Star Hotels</a></div>
            <div><a href="#">Banquet Halls</a></div>
            <div><a href="#">Marriage Lawns</a></div>
            <div><a href="#">Wedding Hotels</a></div>
            <div><a href="#">Wedding Resorts</a></div>
            <div><a href="#">Indoor</a></div>
            <div><a href="#">Outdoor</a></div>
            <div><a href="#">Pool Side</a></div>
            <div><a href="#">Terrace party venues</a></div>
            <div><a href="{{ url('/search/wedding-photogrphers/Bradford') }}" target="_blank">Photogrphers in Bradford</a></div>
            <div><a href="{{ url('/search/wedding-beauty-and-spa/Bradford') }}" target="_blank">Bridal Makeup in Bradford</a></div>
            <div><a href="{{ url('/search/wedding-bridal-dresses/Bradford') }}" target="_blank">Bridal Wear in Bradford</a></div>
            <div><a href="{{ url('/search/wedding-groom-dresses/Bradford') }}" target="_blank">Groom Wear in Bradford</a></div>
            <div><a href="{{ url('/search/wedding-decoration/Bradford') }}" target="_blank">Tent & Decorators in Bradford</a></div>
            <div><a href="{{ url('/search/wedding-wedding-cards/Bradford') }}" target="_blank">Invitation Cards in Bradford</a></div>
            <div><a href="#">Favors in Bradford</a></div>
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

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
        $('.bs-upload-dropndrag').addClass('edit');
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function convertToSlug( str ) {
  str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
  str = str.replace(/^\s+|\s+$/gm,'');
  str = str.replace(/\s+/g, '-');
  $("input[name=slug_answer_text]").val(str);
}

function spaceByhyphen(myStr){
  myStr=myStr.toLowerCase();
  myStr=myStr.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");
  myStr=myStr.replace(/\s+/g, "-");
  return myStr;
}

$(document).ready(function() {
  $('.bs-upload-thumbnails').imageUploader({
    imagesInputName:"photos_answer_text",
    extensions:[".jpg",".jpeg",".png",".gif",".svg",".PNG",".JPG",".JPEG"]
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
      $("#location_id").val(location_id.location_id);
      $(".areaofuk").val(location_id.location_name);
    });

    $('#business-register-data').validate({
      // errorElement: 'span',
      errorClass: 'help-block2',
       highlight: function(element, errorClass, validClass) {
         $(element).closest('.form-group').addClass("has-error");
       },
       unhighlight: function(element, errorClass, validClass) {
         $(element).closest('.form-group').removeClass("has-error");
       },
      rules: {
        business_name_answer_text: {
          required: true,

        },
        email_answer_text: {
          required: true,
          email: true
        },
        phone_number_answer_text: {
          required: true,
          digits: true
          // minlength: 10
        },
        password_answer_text : {
          required: true,
					minlength : 6
				},
				confirm_password_answer_text : {
          required: true,
					minlength : 6,
					equalTo : "#password_answer_text"
				}
      },
      // messages: {
      //     business_name_answer_text: "Sorry... This Business name is already taken..",
      // },

      submitHandler: function(form) {
    // $('#business-register-data').on('submit', function(event){
    //   event.preventDefault();

      $.ajax({
        url:"{{ url('store_business_register_data') }}",
        type:"POST",
        data:new FormData(form),
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
              if(data.errors[i] == "The business name answer text has already been taken."){
                $('input[name=business_name_answer_text]').after('<label id="business_name_answer_text_already_exists-error" class="help-block2" for="business_name_answer_text" style="">Sorry... This Business name is already taken..</label>');
                $('input[name=business_name_answer_text]').parent().parent().addClass('has-error');
                // $('input[name=business_name_answer_text]').after('<label id="business_name_answer_text_already_exists-error" class="help-block" for="business_name_answer_text">Sorry... This Business name is already taken..</label>');
              }else {
                $('#append_errors').show();
                $('#append_errors ul').append("<li>" + data.errors[i] + "</li>");
              }
            });
          }else {
            $('#append_errors').hide();
            $('#append_success').show();
            $('#append_success ul').append("<li>"+data.success+"</li>");
            setTimeout(function(){ $('#append_success').hide(); },3000);
            var url_redirect = "{{ url('/congratulations') }}";
            window.location = url_redirect;
          }
        },
      });
    }
    });

    var question_name_state = false;
    $('.business_name_exists').on('blur', function(){
      var question_name = $(this).val();
      var data = {
        '_token' : $('input[name=_token]').val(),
        'question_name' : $(this).val(),
        'question_name_check' : 1
      };
      if (question_name == '') {
        question_name_state = false;
        return;
      }
      $.ajax({
        url:"{{ url('check_business_name_exists_step1') }}",
        type:"post",
        data: data,
        success: function(response){
          $('#append_errors ul').text('');
          $('#append_success ul').text('');
          if (response == 'taken') {
            question_name_state = false;
            $('input[name=business_name_answer_text]').after('<label id="business_name_answer_text_already_exists-error" class="help-block2" for="business_name_answer_text" style="">Sorry... This Business name is already taken..</label>');
            $('input[name=business_name_answer_text]').parent().parent().addClass('has-error');
            // $('#append_errors').show();
            // $('#append_errors ul').append("<li> Sorry... This Business name is already taken.</li>");
            // $('.business_name_exists').attr('required', true);
            $('.class_check').prop('disabled', true);
          }else {
            question_name_state = true;
            $('#business_name_answer_text_already_exists-error').hide();
            $('#business_name_answer_text_already_exists-error').remove();
            $('.class_check').prop('disabled', false);
            // $('.business_name_exists').attr('required', false);
          }
        }
      });
    });
    $("#category_id").change(function(){
      var data = {
        '_token' : $('input[name=_token]').val(),
        'category_id' : $(this).val(),
        'category_id_check' : 1
      };
      $.ajax({
        url:"{{ url('serach_sub_category') }}",
        type:"post",
        data: data,
        success: function(response){
          if (response.sub_categories == 'no_sub_categories_exists') {
            $('#sub_category_id').empty();
            $('.sub_category_col').hide();
          }else {
            $('#sub_category_id').empty();
            $('#sub_category_id').append(response.sub_categories);
            $('.sub_category_col').show();
          }
        }
      });
   });
   $('#accept-checkbox1').on("change",function (){
     var str = "";
     $('#accept-checkbox1:checked').each(function(){
       str+= $(this).val();
     });
     $('input[name=accept_terms_conditions_answer_text]').val(str.substring(0, str.length - 1));
   });
});
</script>
<style media="screen">
  .form-check-label{
    vertical-align: text-top;
  }
  .bs-upload-dropndrag{border: 2px dashed #f6921e;background: #ffffff; position: relative; overflow: hidden; width: 100%; display: block;height: 160px;position: relative; margin-top: 22px;}
  .bs-upload-dropndrag img{position:absolute;top:0; left:0; width: 100%;height: 100%; display: block;object-fit: contain;object-position: center;}
  .bs-upload-dropndrag input{position:absolute;top:0; left:0; width: 100%;height: 100%; display: block; opacity: 0; z-index: 1;}
  /* .bs-upload-dropndrag.edit img{object-fit: cover;} */
  .bs-upload-dropndrag.edit:after,
  .bs-upload-dropndrag .edit:after{
    content: '\f304';
    font-family: 'Font Awesome 5 Pro';
    font-weight: 400;
    color: #f6921e;
    border: 2px #f6921e solid;
    background: #ffffff;
    border-radius: 50px;
    width: 40px;
    height: 40px;
    font-size: 20px;
    line-height: 35px;
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    text-align: center;
    margin: auto;
  }
  .error{
    color: #dc3545!important;
  }
  .form-check.bs-custom-checkbox label{padding-left: 5px;}
   .bs-custom-checkbox input[type="checkbox"]:checked,.bs-custom-checkbox input[type="checkbox"],.bs-custom-radio input[type="radio"]:checked,.bs-custom-radio input[type="radio"]{transition: all ease-in-out .15s,all ease-in-out .15s;}
   .bs-custom-checkbox input[type="checkbox"]{-webkit-border-radius:2px; border-radius:2px;height: 17px !important; width: 17px !important;border: 2px solid #381C1C;vertical-align: top; -moz-appearance: none; -webkit-appearance: none; -webkit-transition: box-shadow 200ms; box-shadow:inset 0px 0px 0 #fff, 0 0px 0px rgba(0,0,0,0.1);line-height: 10px !important; margin-top: 4px;text-align: center;}
   .bs-custom-checkbox input[type="checkbox"]:not(:disabled):hover{border-color:#381C1C;box-shadow:inset 0px 0px 0 #fff, 0 0 0px rgba(0,0,0,0.3);}
   .bs-custom-checkbox input[type="checkbox"]:active:not(:disabled){box-shadow:inset 0px 0px 0 rgba(0,0,0,0.2), inset 0px 0px 0 rgba(255,255,255,0.6);border-color:#381C1C;}
   .bs-custom-checkbox input[type="checkbox"]:focus {outline:none;}
   .bs-custom-checkbox input[type="checkbox"]:checked:before{color:#ffffff;-webkit-margin-start: 0px;font-size: 11px;line-height: 1.1 !important;text-align: center;font-family: "Font Awesome 5 Pro";font-weight: 700;content:"\f00c";}
   .bs-custom-checkbox input[type="checkbox"]:checked{background:#381C1C;border-color: #381C1C;}

  .help-block2{border-bottom: 2px solid #F05574;position: absolute;left: 10px;bottom: -40px;background-color: #ffffff;box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.30); padding: 2px 5px;font-size: 12px;z-index: 1;}
  .help-block2:before{border-left: 5px solid transparent;border-right: 5px solid transparent;border-bottom: 5px solid #e31f24; position: absolute; top:-5px; left: 0px; content:'';}
  .form-group{margin-bottom:15px}
  .form-group.has-error input{ border-color:#e31f24;}
  .form-group.has-error .input-group-text{ border-color:#e31f24;}
  .form-group.has-error .input-group-text i{color:#e31f24 !important;}
  .form-group.has-error .input-group-text i:before{content:'\f06a';}

</style>
@endsection
