@extends('layouts.a_app')
@section('content')

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <div class="container-fluid py-3" id="categories">
          <!-- table-->
          <div class="card">
            <div class="card-header bg-blue text-light">
              <div class="row">
                <div class="col-sm-6">
                  <h4 class="mb-0">Edit Submission - <?php echo "Category : ". $sections[0]->category_name."<br/>"; ?></h4>
                </div>
              </div>
            </div>
            <div id="append_errors" style="width: 50%; color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 15px; margin-top: 15px; margin-left: 25px; display: none;">
              <ul></ul>
            </div>
            <div id="append_success" style="width: 50%; color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 15px; margin-top: 15px; margin-left: 25px; display: none;">
              <ul></ul>
            </div>
            <div class="table-responsive small p-4" style="font-weight: 500; font-size: 16px;">
              <form method="post" role="form" class="form-horizontal" id="edit_fill_section_form" enctype="multipart/form-data">
                <input type="hidden" name="category_id" value="{{ $sections[0]->category_id }}">
                <input type="hidden" name="location_id" id=location_id value="{{ $sections[0]->location_id }}">
                <input type="hidden" name="business_listing_id" value="{{ $business_listing_id }}">
              <?php
                foreach ($sections as $key => $value) {
                  echo "<span style='font-weight: 600; font-size: 20px;'>$value->section_name</span>";
                  echo "<p style='font-weight: 500; font-size: 18px;'>$value->section_sub_heading</p>";
                  $arr_names = array();
                  $arr_name_updated = array();
                  foreach ($value->questions as $key => $val) {
                    array_push($arr_names, $val->question_name);
                    echo "<div class='form-group'>";
                    echo "$val->question_label"."<br/>";
                    $question_mandatory = '';
                    $question_class = '';
                    if($val->question_mandatory == true){
                      $question_mandatory = 'required';
                    }
                    if($val->question_name == 'location'){
                      $question_class = 'areaofuk';
                    }
                    $select = "";
                    if($val->type == "text" && count($val->listings) == 0){
                      echo "<input type='$val->type' name='$val->question_name"."_answer_text' class='form-control $question_class' placeholder='$val->question_placeholder' $question_mandatory autocomplete='off'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
                    }elseif ($val->type == "text" && count($val->listings) > 0) {
                      array_push($arr_name_updated, "updated_".$val->question_name);
                      foreach ($val->listings as $key => $list_name) {
                        echo "<input type='$val->type' name='updated_"."$val->question_name"."_answer_text_updated' class='form-control $question_class' placeholder='$val->question_placeholder' value='$list_name->business_listing_attribute_data_answer_text' $question_mandatory autocomplete='off'><input type='hidden' name='updated_"."$val->question_name"."_question_id_updated' value='$val->id'><input type='hidden' name='updated_"."$val->question_name"."_answer_id_updated'><input type='hidden' name='updated_"."$val->question_name"."_$val->type"."_updated' value='$val->type'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_id_updated' value='$list_name->business_listing_attribute_business_listing_id'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_attribute_id_updated' value='$list_name->business_listing_attribute_id'>";
                      }
                    }
                    if($val->type == "file" && count($val->listings) == 0){
                      echo "<input type='$val->type' name='$val->question_name"."_answer_text[]' class='form-control' accept='image/*' multiple $question_mandatory><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
                    }elseif ($val->type == "file" && count($val->listings) >0) {
                      echo "<input type='$val->type' name='$val->question_name"."_answer_text[]' class='form-control' accept='image/*' multiple $question_mandatory><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
                      echo "<div class='image-uploader'><div class='uploaded'>";
                      foreach ($val->listings as $key => $pic) {
                        if(strpos($pic->business_listing_attribute_data_answer_text, 'http') === 0) {
                          $image = $pic->business_listing_attribute_data_answer_text;
                        }else{
                          $image = asset('/storage/'.$pic->business_listing_attribute_data_answer_text);
                        }
                        // $image = asset('storage/'.$pic->business_listing_attribute_data_answer_text);
                        echo "<div class='uploaded-image' id='remove_image_$pic->business_listing_attribute_id'><img src='$image'>";
                        echo "<button type='button' title='Delete image' class='delete-image' data-id='$pic->business_listing_attribute_id'><i class='fas fa-times'></i></button></div>";
                      }
                      echo "</div></div>";
                    }
                    if($val->type == "textarea" && count($val->listings) == 0){
                      echo "<textarea name='$val->question_name"."_answer_text' class='form-control' placeholder='$val->question_placeholder' rows='3' $question_mandatory></textarea><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>";
                    }elseif ($val->type == "textarea" && count($val->listings) > 0) {
                      array_push($arr_name_updated, "updated_".$val->question_name);
                      foreach ($val->listings as $key => $list_textarea) {
                        echo "<textarea name='updated_"."$val->question_name"."_answer_text_updated' class='form-control' placeholder='$val->question_placeholder' rows='3' $question_mandatory>".$list_textarea->business_listing_attribute_data_answer_text."</textarea><input type='hidden' name='updated_"."$val->question_name"."_question_id_updated' value='$val->id'><input type='hidden' name='updated_"."$val->question_name"."_answer_id_updated'><input type='hidden' name='updated_"."$val->question_name"."_$val->type"."_updated' value='$val->type'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_id_updated' value='$list_textarea->business_listing_attribute_business_listing_id'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_attribute_id_updated' value='$list_textarea->business_listing_attribute_id'>";
                      }
                    }
                    if($val->type == "select" && count($val->listings) == 0){
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
                        echo "<input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='$val->type' name='$val->question_name"."_answer_id[]' value='$answer->answer_id' class='form-control' style='display: inline-block;'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'> "."$answer->answer_name"."&nbsp;&nbsp;";
                      }elseif ($val->type == "checkbox" && count($val->listings) > 0) {
                        array_push($arr_name_updated, "updated_".$val->question_name);
                        $check = "";
                        foreach ($val->listings as $key => $chk) {
                          if($answer->answer_id == $chk->business_listing_attribute_data_answer_id){
                            $check = "checked";
                          }
                        }
                        echo "<input type='hidden' name='updated_"."$val->question_name"."_business_listing_id_updated' value='$chk->business_listing_attribute_business_listing_id'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_attribute_id_updated' value='$chk->business_listing_attribute_id'><input type='hidden' name='updated_"."$val->question_name"."_answer_text_updated'><input type='hidden' name='updated_"."$val->question_name"."_question_id_updated' value='$val->id'><input type='$val->type' name='updated_"."$val->question_name"."_answer_id_updated[]' value='$answer->answer_id' class='form-control' style='display: inline-block;' $check><input type='hidden' name='updated_"."$val->question_name"."_$val->type"."_updated' value='$val->type'> "."$answer->answer_name"."&nbsp;&nbsp;";
                      }
                      if($val->type == "radio" && count($val->listings) == 0){
                        echo "<input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='$val->type' name='$val->question_name"."_answer_id' value='$answer->answer_id' class='form-control' style='display: inline-block;' $question_mandatory><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'> "."$answer->answer_name"."&nbsp;&nbsp;";
                      }elseif ($val->type == "radio" && count($val->listings) > 0) {
                        array_push($arr_name_updated, "updated_".$val->question_name);
                        $check = "";
                        foreach ($val->listings as $key => $rad) {
                          if($answer->answer_id == $rad->business_listing_attribute_data_answer_id){
                            $check = "checked";
                          }
                        }
                        echo "<input type='hidden' name='updated_"."$val->question_name"."_business_listing_id_updated' value='$rad->business_listing_attribute_business_listing_id'><input type='hidden' name='updated_"."$val->question_name"."_business_listing_attribute_id_updated' value='$rad->business_listing_attribute_id'><input type='hidden' name='updated_"."$val->question_name"."_answer_text_updated'><input type='hidden' name='updated_"."$val->question_name"."_question_id_updated' value='$val->id'><input type='$val->type' name='updated_"."$val->question_name"."_answer_id_updated[]' value='$answer->answer_id' class='form-control' style='display: inline-block;' $check><input type='hidden' name='updated_"."$val->question_name"."_$val->type"."_updated' value='$val->type'> "."$answer->answer_name"."&nbsp;&nbsp;";
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
                    echo "</div>";
                  }
                  foreach($arr_names as $nname)
                  {
                      echo '<input type="hidden" name="all_names[]" value="'. $nname. '">';
                  }
                  foreach($arr_name_updated as $update_nname)
                  {
                      echo '<input type="hidden" name="all_names_updated[]" value="'. $update_nname. '">';
                  }
                  echo "<hr/>";
                }
              ?>
              <button type="submit" class="btn btn-lg btn-primary" name="button">Update</button>
              </form>
            </div>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
            <ul class="pagination-for-categories justify-content-center">
            </ul>
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

    var path_l = "{{ url('/search_location_admin') }}";
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

    $('#edit_fill_section_form').on('submit', function(event){
    	event.preventDefault();

      $.ajax({
        url:"{{ url('update_fill_section_form') }}",
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
    				setTimeout(function(){ $('#append_success').hide(); },2000);
            window.location = "/view_data_submissions";
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
            url:"{{ url('delete_single_submission_image') }}",
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
.close{
  font-size: 1.4rem;
}
.form-control {
  border-radius: 5px;
  width: 50%;
}
</style>
@endsection
