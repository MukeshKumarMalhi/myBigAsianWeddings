@extends('layouts.l_app')
@section('title','Business Register  Step 1')

@section('content')
<div class="container py-3">
  <div id="append_errors" style="width: 100%; color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; display: none;">
    <ul class="exists_error"></ul>
  </div>
  <div id="append_success" style="width: 100%; color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; display: none;">
    <ul></ul>
  </div>
</div>
<div class="steps-box" style="min-height: 680px;">
  <form method="post" role="form" class="form-horizontal" id="business-register-data" enctype="multipart/form-data" novalidate>
    @csrf
  <?php
    $step = 1;
    $hard_code_array = array('Contact Details', 'Description', 'Upload Your Photos', 'Experience', 'Personal Message from the Manager');
    foreach ($sections as $key => $value) {
      $class_active = "";
      if($value->section_name == "Contact Details"){
        $class_active = "active";
      }

      $class_step = "step".$step;
      if($value->section_name == "Special Offers"){
        $class_step = "";
      }
      if($value->section_name == "Experience"){
        echo "<div class='container py-3 $class_step $class_active'><div class='row'><div class='col-sm-6'>";
      }
      if($value->section_name == "Special Offers"){
        echo "<div class='col-sm-6'>";
      }
      if($value->section_name != "Experience" || $value->section_name != "Special Offers") {
        echo "<div class='container py-3 $class_step $class_active'>";
      }
      if($value->section_name == "Experience"){
        echo "";
      }
      if($value->section_name == "Contact Details"){
        echo "";
      }
      elseif($value->section_name == "Special Offers"){
        echo "<div class='float-right ml-2 my-1' style='cursor: pointer;'><span class='step-previous'><i class='fal fa-long-arrow-left'></i> Back</span></div>";
      }
      else {
        echo "<div class='form-group' style='cursor: pointer;'><div class='float-right ml-2 my-1'><span class='step-previous'><i class='fal fa-long-arrow-left'></i> Back</span> | <span class='StepSkip'>Skip <i class='fal fa-long-arrow-right'></i></span></div></div>";
      }
      echo "<div class='form-group'><h2 class='font-gotham-bold'>$value->section_name</h2></div>";

      echo "<hr class='border-warning'>";
      echo "<h4>$value->section_sub_heading</h4>";
      echo "<div class='row'>";
      $arr_names = array();
      foreach ($value->questions as $key => $val) {
        array_push($arr_names, $val->question_name);
        if($value->section_name == "Experience" || $value->section_name == "Special Offers"){
          echo "<div class='form-group col-sm-12'>";
        }
        elseif ($value->section_name == "Social"){
          echo "<div class='form-group col-sm-3'>";
        }
        elseif ($val->type == "textarea"){
          echo "<div class='form-group col-sm-12'>";
        }
        elseif ($val->type == "file" && $val->question_name == "featured_image"){
          echo "<div class='form-group bs-upload-dropndrag col-sm-6 col-md-4'>";
        }
        elseif ($val->type == "file" && $val->question_name == "photos"){
          echo "<div class='form-group bs-upload-thumbnails col-sm-6 col-md-8'>";
        }
        elseif (($val->type == "text") && ($val->question_name == "address" || $val->question_name == "location" || $val->question_name == "postcode")){
          if($val->question_name == "location"){
            echo "<div class='col-sm-12'><div class='row append_sub_category'><div class='form-group col-sm-6'>";
          }else {
            echo "<div class='col-sm-12'><div class='row'><div class='form-group col-sm-6'>";
          }
        }
        else {
          echo "<div class='form-group col-sm-6'>";
        }

        if((isset($val->question_label) || $val->question_label != "") && ($val->type != "radio")){
          echo "<label class='font-gotham-medium'>$val->question_label"."</label>";
        }elseif((isset($val->question_label) || $val->question_label != "") && ($val->type == "radio")){
          echo "<label class='font-gotham-medium'>$val->question_label"."</label><br/>";
        }else{
          echo "";
        }

        $question_mandatory = '';
        $question_class = '';
        $exists_business_name = '';
        $exists_business_name_convert_to_slug = '';
        $slug_display_none = '';
        if($val->question_mandatory == true){
          $question_mandatory = 'required';
        }
        if($val->question_name == 'location'){
          $question_class = 'areaofuk';
        }
        if($val->question_name == 'slug'){
          $slug_display_none = "style='display: none;'";
        }
        if($val->question_name == 'business_name'){
          $exists_business_name = 'business_name_exists';
          $exists_business_name_convert_to_slug = "onkeyup='convertToSlug(this.value)'";
        }
        $select = "";
        if($val->type == "text"){
          echo "<input type='$val->type' name='$val->question_name"."_answer_text' class='form-control border-warning $question_class $exists_business_name' $exists_business_name_convert_to_slug $slug_display_none placeholder='$val->question_placeholder' $question_mandatory autocomplete='off'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";

        }
        if($val->type == "file" && $val->question_name == "photos"){
          echo "<br/><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
        }
        if($val->type == "file" && $val->question_name == "featured_image"){
          echo "<br/><img id='blah' src='".asset('web_asset/images/drop-and-drag-img.png')."' class='img-fluid'><input type='$val->type' name='$val->question_name"."_answer_text[]' onchange='readURL(this);' class='form-control' accept='image/*' $question_mandatory><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
        }
        if($val->type == "textarea"){
          echo "<textarea name='$val->question_name"."_answer_text' class='form-control border-warning' placeholder='$val->question_placeholder' rows='4' $question_mandatory></textarea><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
        }
        if($val->type == "select"){
          $select .= "<input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><select name='$val->question_name"."_answer_id' class='form-control appended_select' $question_mandatory><option value=''>Select $val->question_label</option>";
        }
        $options = "";
        foreach ($val->answers as $key => $answer) {
          if($val->type == "checkbox"){
            if ($answer === reset($val->answers)) {
              echo "<div class='bs-custom-checkbox'>";
            }
            echo "<div class='form-check d-inline-block mb-2 mr-2'><input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='$val->type' name='$val->question_name"."_answer_id[]' id='$answer->answer_id' value='$answer->answer_id' class='form-check-input'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'> <label class='form-check-label' for='$answer->answer_id'>"."$answer->answer_name"."</label>&nbsp;&nbsp;</div>";
            if ($answer === end($val->answers)) {
              echo "</div>";
            }
          }
          if($val->type == "radio"){
            if ($answer === reset($val->answers)) {
              echo "<div class='bs-custom-radio'>";
            }
            echo "<div class='form-check d-inline-block mb-2 mr-2'><input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='$val->type' name='$val->question_name"."_answer_id' value='$answer->answer_id' id='$answer->answer_id' class='form-check-input' $question_mandatory><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'> <label class='form-check-label' for='$answer->answer_id'>"."$answer->answer_name"."</label>&nbsp;&nbsp;</div>";
            if ($answer === end($val->answers)) {
              echo "</div>";
            }
          }
          if($val->type == "select"){
            $options .= "<option value='$answer->answer_id'>"."$answer->answer_name"."</option>";
          }
        }
        $select .= $options;
        echo "$select"."</select>";
        if(($val->type == "text") && ($val->question_name == "address" || $val->question_name == "location" || $val->question_name == "postcode")){
          if($val->question_name == "address"){
            echo "</div>";
            $category_dropbox = "<div class='form-group col-sm-6'><label class='font-gotham-medium'>Select Category</label><select class='form-control border-warning' name='category_id' id='category_id'><option value=''>Select Category</option>";
            foreach ($categories as $key => $cat) {
              $category_dropbox .= "<option value='".$cat->id."'>".$cat->category_name."</option>";
            }
            $category_dropbox .= "</select></div>";
            echo $category_dropbox;
            echo "</div></div>";
          }
          elseif($val->question_name == "location"){
            echo "</div>";
            $sub_category_dropbox = "<div class='form-group col-sm-6 sub_category_col' style='display: none;'><select class='form-control border-warning' name='sub_category_id' id='sub_category_id'></select></div>";
            echo $sub_category_dropbox;
            echo "</div></div>";
          }
          else {
            echo "</div></div></div>";
          }
        }else {
          echo "</div>";
        }
      }
      echo "</div>";
      if($value->section_name == "Experience"){
        echo "";
      }elseif($value->section_name == "Special Offers") {
        echo "<div class='form-group float-right'><button type='submit' class='btn btn-danger font-weight-bold px-5 mb-2 mt-5'>Save</button></div>";
      }else{
        echo "<div class='form-group float-right'><button type='button' class='btn btn-danger font-weight-bold px-5 class_check mb-2 mt-5 step-next'>Next</button></div>";
      }
      foreach($arr_names as $nname)
      {
        echo '<input type="hidden" name="all_names[]" value="'. $nname. '">';
      }
      if($value->section_name == "Experience"){
        echo "</div>";
      }
      if($value->section_name == "Special Offers"){
        echo "</div></div></div>";
      }
      if($value->section_name != "Experience" || $value->section_name != "Special Offers") {
        echo "</div>";
      }
      $step++;
    }

  ?>
    <input type="hidden" name="location_id" id="location_id">
    <div class="container py-3">
      <!-- <div class="form-group text-center">
        <button class="btn btn-danger class_check px-5">Next</button>
      </div> -->
    </div>
  </form>
</div>

<script type="text/javascript">

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

    // $('#business-register-data').validate({
    //   // errorElement: 'span',
    //   errorClass: 'help-block',
    //    highlight: function(element, errorClass, validClass) {
    //      $(element).closest('.form-group').addClass("has-error");
    //    },
    //    unhighlight: function(element, errorClass, validClass) {
    //      $(element).closest('.form-group').removeClass("has-error");
    //    },
    //   rules: {
    //     business_name_answer_text: {
    //       required: true
    //     },
    //     email_answer_text: {
    //       required: true,
    //       email: true
    //     },
    //     phone_number_answer_text: {
    //       required: true,
    //       digits: true
    //       // minlength: 10
    //     },
    //   },
    //
    //   submitHandler: function(form) {
    $('#business-register-data').on('submit', function(event){
      event.preventDefault();

      $.ajax({
        url:"{{ url('store_business_register_data') }}",
        type:"POST",
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
              if(data.errors[i] == "The business name answer text has already been taken."){
                $('input[name=business_name_answer_text]').after('<label id="business_name_answer_text_already_exists-error" class="help-block" for="business_name_answer_text">Sorry... This Business name is already taken..</label>');
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
            // var slug = $("input[name=slug_answer_text]").val();
            // var selected_category = $("#category_id option:selected").text();
            // var selected_sub_value = $("#sub_category_id option:selected").val();
            // if (typeof selected_sub_value !== "undefined" && selected_sub_value != "") {
            //   selected_category = $("#sub_category_id option:selected").text();
            // }
            // var sel_cat = spaceByhyphen(selected_category);
            // if(slug == ""){
            //   var business_name = $("input[name=business_name_answer_text]").val();
            //   var slug = spaceByhyphen(business_name);
            // }
            // var url_web = "{{ url('/business-register-step2') }}";
            // var url = url_web+'/wedding-'+sel_cat+'/'+slug+'/'+data.business_listing_id;
            // console.log(url);
            // return false;
            // window.location = url;
            // var url_redirect = "{{ url('/congratulations') }}";
            // window.location = url_redirect+'/'+slug+;
          }
        },
      });
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
            $('input[name=business_name_answer_text]').after('<label id="business_name_answer_text_already_exists-error" class="help-block" for="business_name_answer_text" style="">Sorry... This Business name is already taken..</label>');
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
   var form2 = $('#business-register-data');
       $(".step-next").click(function(){
           form2.validate({
             errorElement: 'span',
             errorClass: 'help-block',
             highlight: function(element, errorClass, validClass) {
               $(element).closest('.form-group').addClass("has-error");
             },
             unhighlight: function(element, errorClass, validClass) {
               $(element).closest('.form-group').removeClass("has-error");
             },
             rules: {
                     phone: {
                       number: true,
                     },
                     email: {
                       email:true,
                     },
                },
                messages: {
                    name: "Name can not be blank ",
                    email: {
                        required: "Email can not be blank",
                        email: "Your email address must be in the format of name@domain.com"
                    },
                    phone: {
                        required: "Number can not be blank",
                        number: "Please enter a number"
                    },
                },
           });
           if (form2.valid() === true){
             if ($('.step1').is(":visible")){
               current_fs = $('.step1');
               next_fs = $('.step2');
             }
             else if($('.step2').is(":visible")){
               current_fs = $('.step2');
               next_fs = $('.step3');
             }
             else if($('.step3').is(":visible")){
               current_fs = $('.step3');
               next_fs = $('.step4');
             }
             // else if($('.step4').is(":visible")){
             //   current_fs = $('.step4');
             //   next_fs = $('.step6');
             // }
             // else if($('.step5').is(":visible")){
             //   current_fs = $('.step5');
             //   next_fs = $('.step6');
             // }
             // else if($('.step6').is(":visible")){
             //   current_fs = $('.step6');
             //   next_fs = $('.step7');
             // }
             // else if($('.step7').is(":visible")){
             //   current_fs = $('.step7');
             //   next_fs = $('.step9');
             // }
             // else if($('.step8').is(":visible")){
             //   current_fs = $('.step8');
             //   next_fs = $('.step9');
             // }
             // else if($('.step9').is(":visible")){
             //   current_fs = $('.step9');
             //   next_fs = $('.step10');
             // }
               next_fs.show();
               current_fs.hide();
               step_fs.addClass("active")
           }
   });
   $('.step-previous').click(function(){
       if($('.step2').is(":visible")){
           current_fs = $('.step2');
           next_fs = $('.step1');
           step_prs_fs = $("#stepform-check li.step2-p");
       }
       else if ($('.step3').is(":visible")){
           current_fs = $('.step3');
           next_fs = $('.step2');
           step_prs_fs = $("#stepform-check li.step3-p");
       }
       else if ($('.step4').is(":visible")){
           current_fs = $('.step4');
           next_fs = $('.step3');
           step_prs_fs = $("#stepform-check li.step4-p");
       }
       // else if ($('.step5').is(":visible")){
       //     current_fs = $('.step5');
       //     next_fs = $('.step4');
       //     step_prs_fs = $("#stepform-check li.step5-p");
       // }
       // else if ($('.step6').is(":visible")){
       //     current_fs = $('.step6');
       //     next_fs = $('.step4');
       //     step_prs_fs = $("#stepform-check li.step6-p");
       // }
       // else if ($('.step7').is(":visible")){
       //     current_fs = $('.step7');
       //     next_fs = $('.step6');
       //     step_prs_fs = $("#stepform-check li.step7-p");
       // }
       // else if ($('.step8').is(":visible")){
       //     current_fs = $('.step8');
       //     next_fs = $('.step7');
       //     step_prs_fs = $("#stepform-check li.step8-p");
       // }
       // else if ($('.step9').is(":visible")){
       //     current_fs = $('.step9');
       //     next_fs = $('.step7');
       //     step_prs_fs = $("#stepform-check li.step9-p");
       // }
       // else if ($('.step10').is(":visible")){
       //     current_fs = $('.step10');
       //     next_fs = $('.step9');
       //     step_prs_fs = $("#stepform-check li.step10-p");
       // }
       next_fs.show();
       current_fs.hide();
       step_prs_fs.removeClass("active")
   });
   $('.StepSkip').click(function(){
       if($('.step1').is(":visible")){
           current_fs = $('.step1');
           next_fs = $('.step2');
       }
       else if ($('.step2').is(":visible")){
           current_fs = $('.step2');
           next_fs = $('.step3');
       }
       else if ($('.step3').is(":visible")){
           current_fs = $('.step3');
           next_fs = $('.step4');
       }
       // else if ($('.step4').is(":visible")){
       //     current_fs = $('.step4');
       //     next_fs = $('.step6');
       // }
       // else if ($('.step5').is(":visible")){
       //     current_fs = $('.step5');
       //     next_fs = $('.step6');
       // }
       // else if ($('.step6').is(":visible")){
       //     current_fs = $('.step6');
       //     next_fs = $('.step7');
       // }
       // else if ($('.step7').is(":visible")){
       //     current_fs = $('.step7');
       //     next_fs = $('.step9');
       // }
       // else if ($('.step8').is(":visible")){
       //     current_fs = $('.step8');
       //     next_fs = $('.step9');
       // }
       // else if ($('.step9').is(":visible")){
       //     current_fs = $('.step9');
       //     next_fs = $('.step10');
       // }
       next_fs.show();
       current_fs.hide();
       step_prs_fs.removeClass("active")
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
  .step1,.step2,.step3,.step4,.step5,.step6,.step7,.step8,.step9,.step10{display: none;}
  .form-group{margin-bottom: 25px;position:relative;}
  .has-error.form-group{margin-bottom: 25px;}
  .step1.active,.step2.active,.step3.active,.step4.active,.step4.active,.step5.active,.step6.active,.step7.active,.step8.active,.step9.active,.step10.active{display: block;}

</style>
@endsection
