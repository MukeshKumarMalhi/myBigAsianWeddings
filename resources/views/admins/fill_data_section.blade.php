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
                  <h4 class="mb-0">Fill Section - <?php echo "Category : ". $sections[0]->category_name."<br/>"; ?></h4>
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
              <form method="post" role="form" class="form-horizontal" id="fill_section_form" enctype="multipart/form-data">
                <input type="hidden" name="category_id" value="{{ $sections[0]->category_id }}">
              <?php
                foreach ($sections as $key => $value) {
                  echo "<span style='font-weight: 600; font-size: 20px;'>$value->section_name</span>";
                  echo "<p style='font-weight: 500; font-size: 18px;'>$value->section_sub_heading</p>";
                  $arr_names = array();
                  foreach ($value->questions as $key => $val) {
                    array_push($arr_names, $val->question_name);
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
                    if($val->type == "text"){
                      echo "<input type='$val->type' name='$val->question_name"."_answer_text' class='form-control $question_class' placeholder='$val->question_placeholder' $question_mandatory autocomplete='off'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>"."<br/>";
                    }
                    if($val->type == "file"){
                      echo "<input type='$val->type' name='$val->question_name"."_answer_text[]' class='form-control' accept='image/*' multiple $question_mandatory><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>"."<br/>";
                    }
                    if($val->type == "textarea"){
                      echo "<textarea name='$val->question_name"."_answer_text' class='form-control' placeholder='$val->question_placeholder' rows='3' $question_mandatory></textarea><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='hidden' name='$val->question_name"."_answer_id'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'>"."<br/>";
                    }
                    if($val->type == "select"){
                      $select .= "<input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><select name='$val->question_name"."_answer_id' class='form-control appended_select' $question_mandatory><option value=''>Select $val->question_label</option>"."<br/>";
                    }
                    $options = "";
                    foreach ($val->answers as $key => $answer) {
                      if($val->type == "checkbox"){
                        echo "<input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='$val->type' name='$val->question_name"."_answer_id[]' value='$answer->answer_id' class='form-control' style='display: inline-block;'><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'> "."$answer->answer_name"."<br/>";
                      }
                      if($val->type == "radio"){
                        echo "<input type='hidden' name='$val->question_name"."_answer_text'><input type='hidden' name='$val->question_name"."_question_id' value='$val->id'><input type='$val->type' name='$val->question_name"."_answer_id' value='$answer->answer_id' class='form-control' style='display: inline-block;' $question_mandatory><input type='hidden' name='$val->question_name"."_$val->type' value='$val->type'> "."$answer->answer_name"."<br/>";
                      }
                      if($val->type == "select"){
                        $options .= "<option value='$answer->answer_id'>"."$answer->answer_name"."</option>";
                      }
                    }
                    $select .= $options;
                    echo "$select"."</select>"."<br/>";
                  }
                  foreach($arr_names as $nname)
                  {
                      echo '<input type="hidden" name="all_names[]" value="'. $nname. '">';
                  }
                  echo "<hr/>";
                }

              ?>
              <input type="hidden" name="location_id" id="location_id" value="">
              <button type="submit" class="btn btn-lg btn-primary" name="button">Save</button>
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

    //select all checkboxes
    $(".select_all").change(function(){  //"select all" change
    	var status = this.checked; // "select all" checked status
    	$('.checkbox').each(function(){ //iterate all listed checkbox items
    		this.checked = status; //change ".checkbox" checked status
    	});
    });

    $('.checkbox').change(function(){ //".checkbox" change
    	//uncheck "select all", if one of the listed checkbox item is unchecked
    	if(this.checked == false){ //if this item is unchecked
    		$(".select_all")[0].checked = false; //change "select all" checked status to false
    	}

    	//check "select all" if all checkbox items are checked
    	if ($('.checkbox:checked').length == $('.checkbox').length ){
    		$(".select_all")[0].checked = true; //change "select all" checked status to true
    	}
    });

    $('#SectionModal').on('shown.bs.modal', function () {
      $('#section_name').focus();
    });

  $('#fill_section_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ url('store_fill_section_form') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
			contentType:false,
			cache:false,
			processData:false,
      success:function(data){
        console.log(data);
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

	$(document).on('click', '.edit_modal', function(){
    $('#EditSectionModal').find('#edit_section_form')[0].reset();
		$('#fid').val($(this).data('id'));
		$('#edit_fid').val($(this).data('id'));
		$('#edit_section_name').val($(this).data('section_name'));
		$('#edit_section_order').val($(this).data('section_order'));
    var values = $(this).data('categories');
    $(".all_checks").find('[value=' + values.join('], [value=') + ']').prop("checked", true);

    if($(this).data('section_status') == true){
      $('#edit_section_status').prop('checked', true);
    }else {
      $('#edit_section_status').prop('checked', false);
    }
    if($(this).data('section_basic_search') == true){
      $('#edit_section_basic_search').prop('checked', true);
    }else {
      $('#edit_section_basic_search').prop('checked', false);
    }
    if($(this).data('section_advance_search') == true){
      $('#edit_section_advance_search').prop('checked', true);
    }else {
      $('#edit_section_advance_search').prop('checked', false);
    }
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_section_form').on('submit', function(event){
		event.preventDefault();
    $.ajax({
      url:"{{ url('update_data_section') }}",
      method:"POST",
			data:new FormData(this),
      dataType:"JSON",
			contentType:false,
			cache:false,
			processData:false,
			success:function(data){
				$('#edit_append_errors ul').text('');
				$('#edit_append_success ul').text('');
        if(data.errors)
        {
					$.each(data.errors, function(i, error){
						$('#edit_append_errors').show();
            $('#edit_append_errors ul').append("<li>" + data.errors[i] + "</li>");
        	});
        }else {
          console.log(data);
          // var date = moment(data.created_at).format("D MMM YYYY");
					// $('.Category' + data.id).replaceWith(" "+
					// "<tr class='Category"+data.id+"'>"+
					// "<td>" + data.id + "</td>"+
					// "<td>" + data.parent_category_name + "</td>"+
					// "<td>" + data.category_name + "</td>"+
					// "<td>" + '<img src={{ asset("/storage") }}/'+data.category_icon+' width="50px" height="50px">'+ "</td>"+
					// "<td>" + date + "</td>"+
					// "<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-category_name='"+data.category_name+"' data-category_icon='"+data.category_icon+"' data-parent_category_id='"+data.parent_category_id+"' data-toggle='modal' data-target='#EditCategoryModal' data-whatever='@mdo'>"+
					// "<i class='fa fa-pencil'></i> Edit</a> "+
					// "<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-category_name='"+data.category_name+"' data-category_icon='"+data.category_icon+"' data-toggle='modal' data-target='#DeleteCategoryModal' data-whatever='@mdo'>"+
					// "<i class='fa fa-trash'></i> Delete</a>"+
					// "</td>"+
					// "</tr>");
					$('#edit_append_errors').hide();
					$('#edit_append_success').show();
					$('#edit_append_success ul').append("<li>"+data.success+"</li>");
          setTimeout(function(){ $('#edit_append_success').hide(); },1000);
					setTimeout(function(){ $('#EditSectionModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
          location.reload();
        }
      },
    });
  });

	$(document).on('click', '.delete_modal', function(){
		$('.title').html($(this).data('section_name'));
		$('.id').text($(this).data('id'));
	});

  $('.delete').on('click',function(event){
		event.preventDefault();
		var data = {
			'_token' : $('input[name=_token]').val(),
			'id' : $('.id').text()
		};

    $.ajax({
        type:'POST',
        url:"{{ url('delete_section_data') }}",
				data:data,
				dataType:"json",
        success:function(data){
					$('#delete_append_success ul').text('');
					$('#delete_append_success').show();
					$('#delete_append_success ul').append("<li>"+data+"</li>");
          $('.Section' + $('.id').text()).remove();
          setTimeout(function(){ $('#delete_append_success').hide(); },1000);
					setTimeout(function(){ $('#DeleteSectionModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
          location.reload();
        }
    });
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
