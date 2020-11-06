@extends('layouts.l_app')
@section('title','Business Register  Step 1')

@section('content')
<div class="container py-3">
  <div class="row">
    <div class="col-sm-9">
      <div id="append_errors" style="width: 50%; color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 15px; margin-top: 15px; margin-left: 25px; display: none;">
        <ul></ul>
      </div>
      <div id="append_success" style="width: 50%; color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 15px; margin-top: 15px; margin-left: 25px; display: none;">
        <ul></ul>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group text-right">
        <a href="{{ url('business-register-step2') }}/{{ $category_set }}/{{ $slug }}" class="btn btn-danger">Proceed to Step 2 <i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</div>
<form method="post" role="form" class="form-horizontal" id="business-register-data" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="category_id" value="{{ $sections[0]->category_id }}">
  <input type="hidden" name="location_id" id=location_id value="{{ $sections[0]->location_id }}">
  <input type="hidden" name="business_listing_id" value="{{ $business_listing_id }}">
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
    $arr_name_updated = array();
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

      if($val->type == "text" && count($val->listings) == 0){
        echo "<input type='$val->type' name='$val->question_name"."_answer_text' class='form-control border-warning $question_class $exists_business_name' $exists_business_name_convert_to_slug $slug_display_none placeholder='$val->question_placeholder' $question_mandatory autocomplete='off'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
      }elseif ($val->type == "text" && count($val->listings) > 0) {
        array_push($arr_name_updated, "updated_".$val->question_name);
        foreach ($val->listings as $key => $list_name) {
          echo "<input type='$val->type' name='updated_"."$val->question_name"."_answer_text_updated' class='form-control $question_class $exists_business_name' placeholder='$val->question_placeholder' $exists_business_name_convert_to_slug $slug_display_none value='$list_name->business_listing_attribute_data_answer_text' $question_mandatory autocomplete='off'><input type='hidden' name='updated_"."$val->question_name"."_question_id_updated' value='$val->id'><input type='hidden' name='updated_"."$val->question_name"."_answer_id_updated'><input type='hidden' name='updated_"."$val->question_name"."_$val->type"."_updated' value='$val->type'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_id_updated' value='$list_name->business_listing_attribute_business_listing_id'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_attribute_id_updated' value='$list_name->business_listing_attribute_id'>";
        }
      }

      if($val->type == "file" && $val->question_name == "photos" && count($val->listings) == 0){
        echo "<br/><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
      }elseif ($val->type == "file" && $val->question_name == "photos" && count($val->listings) >0) {
        echo "<br/><div class='image-uploader has-files'><div class='uploaded'>";
        foreach ($val->listings as $key => $pic) {
          if(strpos($pic->business_listing_attribute_data_answer_text, 'http') === 0) {
            $image = $pic->business_listing_attribute_data_answer_text;
          }else{
            $image = asset('/storage/'.$pic->business_listing_attribute_data_answer_text);
          }
          echo "<div class='uploaded-image' id='remove_image_$pic->business_listing_attribute_id'><img src='$image'>";
          echo "<button type='button' title='Delete image' class='delete-image' data-id='$pic->business_listing_attribute_id'><i class='fas fa-trash-alt'></i></button></div>";
        }
        echo "</div></div><br/>";
        echo "<input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
      }

      if($val->type == "file" && $val->question_name == "featured_image" && count($val->listings) == 0){
        echo "<br/><img id='blah' src='".asset('web_asset/images/drop-and-drag-img.png')."' class='img-fluid'><input type='$val->type' name='$val->question_name"."_answer_text[]' onchange='readURL(this);' class='form-control' accept='image/*' $question_mandatory><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
      }elseif ($val->type == "file" && $val->question_name == "featured_image" && count($val->listings) >0) {
        // echo "<br/><div class='image-uploader has-files'><div class='uploaded'>";
        foreach ($val->listings as $key => $pic) {
          if(strpos($pic->business_listing_attribute_data_answer_text, 'http') === 0) {
            $image = $pic->business_listing_attribute_data_answer_text;
          }else{
            $image = asset('/storage/'.$pic->business_listing_attribute_data_answer_text);
          }
          echo "<div class='uploaded-image' id='remove_image_$pic->business_listing_attribute_id'><img src='$image'>";
          echo "<button type='button' title='Delete image' class='delete-image' data-id='$pic->business_listing_attribute_id'><i class='fas fa-trash-alt'></i></button></div>";
        }
        // echo "</div></div><br/>";
      }

      if($val->type == "textarea" && count($val->listings) == 0){
        echo "<textarea name='$val->question_name"."_answer_text' class='form-control border-warning' placeholder='$val->question_placeholder' rows='4' $question_mandatory></textarea><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
      }elseif ($val->type == "textarea" && count($val->listings) > 0) {
        array_push($arr_name_updated, "updated_".$val->question_name);
        foreach ($val->listings as $key => $list_textarea) {
          echo "<textarea name='updated_"."$val->question_name"."_answer_text_updated' class='form-control border-warning' placeholder='$val->question_placeholder' rows='4' $question_mandatory>".$list_textarea->business_listing_attribute_data_answer_text."</textarea><input type='hidden' name='updated_"."$val->question_name"."_question_id_updated' value='$val->id'><input type='hidden' name='updated_"."$val->question_name"."_answer_id_updated'><input type='hidden' name='updated_"."$val->question_name"."_$val->type"."_updated' value='$val->type'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_id_updated' value='$list_textarea->business_listing_attribute_business_listing_id'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_attribute_id_updated' value='$list_textarea->business_listing_attribute_id'>";
        }
      }

      if ($val->type == "select" && count($val->listings) == 0){
        $select .= "<input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><select name='$val->question_name"."_answer_id' class='form-control appended_select' $question_mandatory><option value=''>Select $val->question_label</option>";
      }elseif ($val->type == "select" && count($val->listings) > 0) {
        array_push($arr_name_updated, "updated_".$val->question_name);
        foreach ($val->listings as $key => $list_selectbox) {
          $select .= "<input type='hidden' name='updated_"."$val->question_name"."_business_listing_id_updated' value='$list_selectbox->business_listing_attribute_business_listing_id'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_attribute_id_updated' value='$list_selectbox->business_listing_attribute_id'><input type='hidden' name='updated_"."$val->question_name"."_answer_text_updated'><input type='hidden' name='updated_"."$val->question_name"."_question_id_updated' value='$val->id'><select name='updated_"."$val->question_name"."_answer_id_updated' class='form-control appended_select' $question_mandatory><option value=''>Select $val->question_label</option>";
        }
      }
      $options = "";
      foreach ($val->answers as $key => $answer) {
        if($val->type == "checkbox" && count($val->listings) == 0){
          if ($answer === reset($val->answers)) {
            echo "<div class='bs-custom-checkbox'>";
          }
          echo "<div class='form-check d-inline-block mb-2 mr-2'><input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='$val->type' name='$val->question_name"."_answer_id[]' id='$answer->answer_id' value='$answer->answer_id' class='form-check-input'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'> <label class='form-check-label' for='$answer->answer_id'>"."$answer->answer_name"."</label>&nbsp;&nbsp;</div>";
          if ($answer === end($val->answers)) {
            echo "</div>";
          }
        }elseif ($val->type == "checkbox" && count($val->listings) > 0) {
          if ($answer === reset($val->answers)) {
            echo "<div class='bs-custom-checkbox'>";
          }
          array_push($arr_name_updated, "updated_".$val->question_name);
          $check = "";
          foreach ($val->listings as $key => $chk) {
            if($answer->answer_id == $chk->business_listing_attribute_data_answer_id){
              $check = "checked";
            }
          }
          echo "<div class='form-check d-inline-block mb-2 mr-2'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_id_updated' value='$chk->business_listing_attribute_business_listing_id'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_attribute_id_updated' value='$chk->business_listing_attribute_id'><input type='hidden' name='updated_"."$val->question_name"."_answer_text_updated'><input type='hidden' name='updated_"."$val->question_name"."_question_id_updated' value='$val->id'><input type='$val->type' name='updated_"."$val->question_name"."_answer_id_updated[]' value='$answer->answer_id' class='form-check-input' $check><input type='hidden' name='updated_"."$val->question_name"."_$val->type"."_updated' value='$val->type'> <label class='form-check-label' for='$answer->answer_id'>"."$answer->answer_name"."</label>&nbsp;&nbsp;</div>";

          if ($answer === end($val->answers)) {
            echo "</div>";
          }
        }

        if($val->type == "radio" && count($val->listings) == 0){
          if ($answer === reset($val->answers)) {
            echo "<div class='bs-custom-radio'>";
          }
          echo "<div class='form-check d-inline-block mb-2 mr-2'><input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='$val->type' name='$val->question_name"."_answer_id' value='$answer->answer_id' id='$answer->answer_id' class='form-check-input' $question_mandatory><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'> <label class='form-check-label' for='$answer->answer_id'>"."$answer->answer_name"."</label>&nbsp;&nbsp;</div>";
          if ($answer === end($val->answers)) {
            echo "</div>";
          }
        }elseif ($val->type == "radio" && count($val->listings) > 0) {
          if ($answer === reset($val->answers)) {
            echo "<div class='bs-custom-radio'>";
          }
          array_push($arr_name_updated, "updated_".$val->question_name);
          $check = "";
          foreach ($val->listings as $key => $rad) {
            if($answer->answer_id == $rad->business_listing_attribute_data_answer_id){
              $check = "checked";
            }
          }

          echo "<div class='form-check d-inline-block mb-2 mr-2'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_id_updated' value='$rad->business_listing_attribute_business_listing_id'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_attribute_id_updated' value='$rad->business_listing_attribute_id'><input type='hidden' name='updated_"."$val->question_name"."_answer_text_updated'><input type='hidden' name='updated_"."$val->question_name"."_question_id_updated' value='$val->id'><input type='$val->type' name='updated_"."$val->question_name"."_answer_id_updated[]' value='$answer->answer_id' class='form-check-input' $check><input type='hidden' name='updated_"."$val->question_name"."_$val->type"."_updated' value='$val->type'> <label class='form-check-label' for='$answer->answer_id'>"."$answer->answer_name"."</label>&nbsp;&nbsp;</div>";

          if ($answer === end($val->answers)) {
            echo "</div>";
          }
        }

        if($val->type == "select" && count($val->listings) == 0){
          $options .= "<option value='$answer->answer_id'>"."$answer->answer_name"."</option>";
        }elseif ($val->type == "select" && count($val->listings) > 0) {
          $selected = "";
          foreach ($val->listings as $key => $selecte) {
            if($answer->answer_id == $selecte->business_listing_attribute_data_answer_id){
              $selected = "selected";
            }
          }
          $options .= "<option value='$answer->answer_id' $selected>"."$answer->answer_name"."</option>";
        }
      }
      $select .= $options;
      echo "$select"."</select>";
      if(($val->type == "text") && ($val->question_name == "address" || $val->question_name == "location" || $val->question_name == "postcode")){
        if($val->question_name == "address"){
          echo "</div>";
          $category_dropbox = "<div class='form-group col-sm-6'><label class='font-gotham-medium'>Select Category</label><select class='form-control border-warning' name='category_id' id='category_id' required><option value=''>Select Category</option>";
          foreach ($categories as $key => $cat) {
            if($cat->id == $sections[0]->category_id){
              $category_dropbox .= "<option value='".$cat->id."' selected>".$cat->category_name."</option>";
            }else {
              $category_dropbox .= "<option value='".$cat->id."'>".$cat->category_name."</option>";
            }
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
    foreach($arr_name_updated as $update_nname)
    {
        echo '<input type="hidden" name="all_names_updated[]" value="'. $update_nname. '">';
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
  <div class="container py-3">
    <div class="form-group text-center">
        <button class="btn btn-danger"><i class="fa fa-download"></i> Save Change + Step 2</button>
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
            var slug = $("input[name=slug_answer_text]").val();
            var selected_category = $("#category_id option:selected").text();
            var sel_cat = spaceByhyphen(selected_category);
            if(slug == ""){
              var business_name = $("input[name=business_name_answer_text]").val();
              var slug = spaceByhyphen(business_name);
            }
            var url_web = "{{ url('/business-register-step2') }}";
            var url = url_web+'/wedding-'+sel_cat+'/'+slug;
            // console.log(url);
            // return false;
            window.location = url;
            // var url_redirect = "{{ url('/congratulations') }}";
            // window.location = url_redirect+'/'+slug+;
          }
        },
      });
    });

    $('.delete-image').on('click',function(event){
      event.preventDefault();
      var r = confirm("Are you sure want to delete this image?");
      if (r == true) {
    		var data = {
    			'_token' : $('input[name=_token]').val(),
    			'id' : $(this).data('id')
    		};

        var id = $(this).data('id');
        $.ajax({
            type:'POST',
            url:"{{ url('delete_single_submission_image_step_one') }}",
    				data:data,
    				dataType:"json",
            success:function(data){
              $('#remove_image_'+id).hide();
              alert(data);
            }
        });
      } else {
        return false;
      }
    });
});
</script>
<style media="screen">
  .form-check-label{
    vertical-align: text-top;
  }
  .image-uploader .uploaded .uploaded-image .delete-image i {
    padding-left: 7px;
  }
</style>
@endsection
