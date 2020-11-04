@extends('layouts.l_app')
@section('title','Business Register')

@section('content')
<div class="container py-3">
  <div id="append_errors" style="width: 50%; color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 15px; margin-top: 15px; margin-left: 25px; display: none;">
    <ul></ul>
  </div>
  <div id="append_success" style="width: 50%; color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 15px; margin-top: 15px; margin-left: 25px; display: none;">
    <ul></ul>
  </div>
</div>
<form method="post" role="form" class="form-horizontal" id="business-register-data" enctype="multipart/form-data">
  @csrf
<?php
  foreach ($sections as $key => $value) {
    if($value->section_name == "Experience" || $value->section_name == "Getting Here"){
      echo "<div class='bg-warning-l'><div class='container py-3'><div class='row'><div class='col-sm-6'>";
    }
    if($value->section_name == "Pricing" || $value->section_name == "Cultural Experience"){
      echo "<div class='col-sm-6'>";
    }
    if($value->section_name != "Experience" || $value->section_name != "Pricing" || $value->section_name != "Getting Here" || $value->section_name != "Cultural Experience") {
      echo "<div class='container py-3'>";
    }
    echo "<h2 class='font-gotham-bold'>$value->section_name</h2>";
    echo "<hr class='border-warning'>";
    echo "<h4>$value->section_sub_heading</h4>";
    echo "<div class='row'>";
    $arr_names = array();
    foreach ($value->questions as $key => $val) {
      array_push($arr_names, $val->question_name);
      if($value->section_name == "Experience" || $value->section_name == "Pricing" || $value->section_name == "Getting Here" || $value->section_name == "Cultural Experience"){
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
        echo "<div class='col-sm-12'><div class='row'><div class='form-group col-sm-6'>";
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
      // $images_multiple = "";
      if($val->question_mandatory == true){
        $question_mandatory = 'required';
      }
      // if($val->question_name == "photos"){
      //   $images_multiple = 'multiple';
      // }
      if($val->question_name == 'location'){
        $question_class = 'areaofuk';
      }
      if($val->question_name == 'business_name'){
        $exists_business_name = 'business_name_exists';
      }
      $select = "";
      if($val->type == "text"){
        echo "<input type='$val->type' name='$val->question_name"."_answer_text' class='form-control border-warning $question_class $exists_business_name' placeholder='$val->question_placeholder' $question_mandatory autocomplete='off'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
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
          $category_dropbox = "<div class='form-group col-sm-6'><label class='font-gotham-medium'>Select Category</label><select class='form-control border-warning' name='category_id' required><option value=''>Select Category</option>";
          foreach ($categories as $key => $cat) {
            $category_dropbox .= "<option value='".$cat->id."'>".$cat->category_name."</option>";
          }
          $category_dropbox .= "</select></div>";
          echo $category_dropbox;
          echo "</div></div>";
        }else {
          echo "</div></div></div>";
        }
      }else {
        echo "</div>";
      }
    }
    echo "</div>";
    foreach($arr_names as $nname)
    {
      echo '<input type="hidden" name="all_names[]" value="'. $nname. '">';
    }
    if($value->section_name == "Experience" || $value->section_name == "Getting Here"){
      echo "</div>";
    }
    if($value->section_name == "Pricing" || $value->section_name == "Cultural Experience"){
      echo "</div></div></div></div>";
    }
    if($value->section_name != "Experience" || $value->section_name != "Pricing" || $value->section_name != "Getting Here" || $value->section_name != "Cultural Experience") {
      echo "</div>";
    }
  }

?>
  <input type="hidden" name="location_id" id="location_id">
  <div class="container py-3">
    <div class="form-group text-center">
        <button class="btn btn-danger"><i class="fa fa-download"></i> Save Change</button>
    </div>
  </div>
</form>

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

    $('#business-register-data').on('submit', function(event){
      event.preventDefault();

      $.ajax({
        url:"{{ url('store_business_register_data') }}",
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
            $('#append_success ul').append("<li>"+data.success+"</li>");
            setTimeout(function(){ $('#append_success').hide(); },1000);
            var url_redirect = "{{ url('/congratulations') }}";
            window.location = url_redirect;
          }
        },
      });
    });
});
</script>
<style media="screen">
  .form-check-label{
    vertical-align: text-top;
  }
</style>
@endsection
