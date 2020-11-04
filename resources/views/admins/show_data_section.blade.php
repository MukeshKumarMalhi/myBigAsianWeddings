@extends('layouts.a_app')

@section('content')

    <!-- Page Content -->
    <!-- add Category modal -->
      <div class="modal fade" id="QuestionModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width:1000px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
              <ul></ul>
            </div>
            <div id="append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
              <ul></ul>
            </div>
            <form method="post" role="form" class="form-horizontal" id="question_form">
              @csrf
              <div class="form-group row add">
                <label for="question_name" class="control-label col-sm-3" style="font-weight: 600;">Question Name :</label>
                <div class="col-sm-9">
                  <input type="text" name="question_name" id="question_name" style="border-radius: 5px;" class="form-control check_question_name" placeholder="Enter Question Name" autocomplete="off" autofocus required/>
                  <input type="hidden" name="data_section_id" value="{{ $section->id }}">
                </div>
              </div>
              <div class="form-group row add">
                <label for="question_label" class="control-label col-sm-3" style="font-weight: 600;">Question Label :</label>
                <div class="col-sm-9">
                  <input type="text" name="question_label" id="question_label" style="border-radius: 5px;" class="form-control" placeholder="Enter Question Label" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="question_placeholder" class="control-label col-sm-3" style="font-weight: 600;">Question Placeholder :</label>
                <div class="col-sm-9">
                  <input type="text" name="question_placeholder" id="question_placeholder" style="border-radius: 5px;" class="form-control" placeholder="Enter Question Placeholder" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="data_type_id" class="control-label col-sm-3" style="font-weight: 600;">Question's Data Type :</label>
                <div class="col-sm-9">
                  <select class="form-control data_type_id_add" id="data_type_id" style="border-radius: 5px;" name="data_type_id">
                    <option value="">Select Data Type</option>
                    <?php if(isset($data_types) && count($data_types) > 0){ ?>
                      @foreach($data_types as $data_ty)
                      <option value="{{ $data_ty->id }}">{{ $data_ty->type }}</option>
                      @endforeach
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row add">
                <label for="question_order" class="control-label col-sm-3" style="font-weight: 600;">Question Order :</label>
                <div class="col-sm-9">
                  <input type="text" name="question_order" id="question_order" style="border-radius: 5px;" class="form-control" placeholder="Enter Question Order e.g. 1, 2 or 3" autocomplete="off" required/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="question_mandatory" class="control-label col-sm-3" style="font-weight: 600;">Question Mandatory :</label>
                <div class="col-sm-9">
                  <input type="checkbox" name="question_mandatory" id="question_mandatory" value="true" style="border-radius: 5px;" class="form-control"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="question_is_common" class="control-label col-sm-3" style="font-weight: 600;">Question Is Common :</label>
                <div class="col-sm-9">
                  <input type="checkbox" name="question_is_common" id="question_is_common" value="true" style="border-radius: 5px;" class="form-control"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="question_basic_search" class="control-label col-sm-3" style="font-weight: 600;">Basic Search :</label>
                <div class="col-sm-9">
                  <input type="checkbox" name="question_basic_search" id="question_basic_search" value="true" style="border-radius: 5px;" class="form-control"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="question_advance_search" class="control-label col-sm-3" style="font-weight: 600;">Advance Search :</label>
                <div class="col-sm-9">
                  <input type="checkbox" name="question_advance_search" id="question_advance_search" value="true" style="border-radius: 5px;" class="form-control"/>
                </div>
              </div>
              <div class="form-group row add choices_div_add" style="display:none;">
                <label for="answer_name" class="control-label col-sm-3" style="font-weight: 600;">Choice Answers :</label>
                <div class="col-sm-6 append_choices_add">
                  <input type="text" name="answer_name[]" style="border-radius: 5px;" class="form-control" placeholder="Enter value" autocomplete="off"/>
                  <br>
                  <input type="text" name="answer_name[]" style="border-radius: 5px;" class="form-control" placeholder="Enter value" autocomplete="off"/>
                  <br>
                  <input type="text" name="answer_name[]" style="border-radius: 5px;" class="form-control" placeholder="Enter value" autocomplete="off"/>
                  <br>
                  <input type="text" name="answer_name[]" style="border-radius: 5px;" class="form-control" placeholder="Enter value" autocomplete="off"/>
                  <br>
                </div>
                <div class="col-sm-3">
                  <button type="button" class="btn btn-sm btn-danger form-control add_more_add" name="button">Add <i class="fas fa-plus-circle"></i></button>
                </div>
              </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-save class_check" id="add">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
      </div>
      </div>
    <!-- add Category modal -->
    <!-- edit Category modal -->
      <div class="modal fade" id="EditQuestionModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document" style="max-width: 1000px;">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>
      			<div class="modal-body">
      				<div id="edit_append_errors" style="color: #a94442; background-color: #f2dede; border-color: #ebccd1; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
      					<ul></ul>
      				</div>
      				<div id="edit_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
      					<ul></ul>
      				</div>
      				<form method="post" role="form" class="form-horizontal" id="edit_question_form">
      					@csrf
      					<div class="form-group row add">
      						<label for="fid" class="control-label col-sm-3" style="font-weight: 600;">ID :</label>
      						<div class="col-sm-9">
      							<input type="text" id="fid" name="fid" style="border-radius: 5px;" class="form-control" disabled/>
      							<input type="hidden" id="edit_fid" name="edit_fid">
      						</div>
      					</div>
                <div class="form-group row add">
                  <label for="edit_question_name" class="control-label col-sm-3" style="font-weight: 600;">Question Name :</label>
                  <div class="col-sm-9">
                    <input type="text" name="edit_question_name" id="edit_question_name" style="border-radius: 5px;" class="form-control check_question_name" placeholder="Enter Question Name e.g. brief_description, venue_type" autocomplete="off" autofocus required/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_question_label" class="control-label col-sm-3" style="font-weight: 600;">Question Label :</label>
                  <div class="col-sm-9">
                    <input type="text" name="edit_question_label" id="edit_question_label" style="border-radius: 5px;" class="form-control" placeholder="Enter Question Label" autocomplete="off"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_question_placeholder" class="control-label col-sm-3" style="font-weight: 600;">Question Placeholder :</label>
                  <div class="col-sm-9">
                    <input type="text" name="edit_question_placeholder" id="edit_question_placeholder" style="border-radius: 5px;" class="form-control" placeholder="Enter Question Placeholder" autocomplete="off"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_data_type_id" class="control-label col-sm-3" style="font-weight: 600;">Question's Data Type :</label>
                  <div class="col-sm-9">
                    <select class="form-control data_type_id_edit" id="edit_data_type_id" style="border-radius: 5px;" name="edit_data_type_id">
                      <option value="">Select Data Type</option>
                      <?php if(isset($data_types) && count($data_types) > 0){ ?>
                        @foreach($data_types as $data_ty)
                        <option value="{{ $data_ty->id }}">{{ $data_ty->type }}</option>
                        @endforeach
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_question_order" class="control-label col-sm-3" style="font-weight: 600;">Question Order :</label>
                  <div class="col-sm-9">
                    <input type="text" name="edit_question_order" id="edit_question_order" style="border-radius: 5px;" class="form-control" placeholder="Enter Question Order e.g. 1, 2 or 3" autocomplete="off" required/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_question_mandatory" class="control-label col-sm-3" style="font-weight: 600;">Question Mandatory :</label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="edit_question_mandatory" id="edit_question_mandatory" value="true" style="border-radius: 5px;" class="form-control"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_question_status" class="control-label col-sm-3" style="font-weight: 600;">Question Status :</label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="edit_question_status" id="edit_question_status" value="true" style="border-radius: 5px;" class="form-control"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_question_is_common" class="control-label col-sm-3" style="font-weight: 600;">Question Is Common :</label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="edit_question_is_common" id="edit_question_is_common" value="true" style="border-radius: 5px;" class="form-control"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_question_basic_search" class="control-label col-sm-3" style="font-weight: 600;">Basic Search :</label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="edit_question_basic_search" id="edit_question_basic_search" value="true" style="border-radius: 5px;" class="form-control"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_question_advance_search" class="control-label col-sm-3" style="font-weight: 600;">Advance Search :</label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="edit_question_advance_search" id="edit_question_advance_search" value="true" style="border-radius: 5px;" class="form-control"/>
                  </div>
                </div>
                <div class="form-group row add choices_div_edit" style="display:none;">
                  <label for="answer_name" class="control-label col-sm-3" style="font-weight: 600;">Choice Answers :</label>
                  <div class="col-sm-6 append_choices_edit">
                    <input type="text" name="answer_name[]" style="border-radius: 5px;" class="form-control" placeholder="Enter value" autocomplete="off"/>
                    <br>
                    <input type="text" name="answer_name[]" style="border-radius: 5px;" class="form-control" placeholder="Enter value" autocomplete="off"/>
                    <br>
                    <input type="text" name="answer_name[]" style="border-radius: 5px;" class="form-control" placeholder="Enter value" autocomplete="off"/>
                    <br>
                    <input type="text" name="answer_name[]" style="border-radius: 5px;" class="form-control" placeholder="Enter value" autocomplete="off"/>
                    <br>
                  </div>
                  <div class="col-sm-3">
                    <button type="button" class="btn btn-sm btn-danger form-control add_more_edit" name="button">Add <i class="fas fa-plus-circle"></i></button>
                  </div>
                </div>
      				</div>
      				<div class="modal-footer">
      					<button type="submit" class="edit btn btn-save class_check">Update</button>
      					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      				</div>
      			</form>
      		</div>
      	</div>
      </div>
      <!-- edit Category modal end -->
      <!-- delete Category modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeleteQuestionModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
      		<div class="modal-content" style="width:200%;">
      			<div class="modal-body">
              <div id="delete_append_success" style="color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; border-radius: 5px; padding: 17px 0px 1px 0px; margin-bottom: 30px; display: none;">
                <ul></ul>
              </div>
      				<div class="deletecontent">
      					Are you sure want to delete <span class="title" style="font-size: 18px; font-weight: 500;"></span>?
      					<span class="id" style="display: none;"></span>
      				</div>
      			</div>
      			<div class="modal-footer">
      				<button type="button" class="delete btn btn-danger">Delete</button>
      				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      			</div>
      		</div>
      	</div>
      </div>
      <!-- edit Category modal end -->

    <div id="page-content-wrapper">

        <div class="container-fluid py-3" id="questions">
          <!-- table-->
          <div class="card">
              <div class="card-header bg-blue text-light">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="mb-0">Data Section - {{ $section->section_name }}</h4>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#QuestionModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Question</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive small">
                <table class="table table-condensed" id="userTable">
                    <thead>
                        <tr>
                            <th><span>ID</span></th>
                            <th><span>Question Name</span></th>
                            <th><span>Question Label</span></th>
                            <th><span>Question Placeholder</span></th>
                            <th><span>Order no#</span></th>
                            <th><span>Status</span></th>
                            <th><span>Is Common</span></th>
                            <th><span>Basic Search</span></th>
                            <th><span>Advance Search</span></th>
                            <th><span>Data Type</span></th>
                            <th><span>Section</span></th>
                            <th><span>Choices Answer</span></th>
                            <th><span>Created at</span></th>
                            <th class="text-center" style="width:110px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          {{ csrf_field() }}
                         <?php if(isset($questions) && count($questions) > 0){ ?>
                           @foreach($questions as $question)
                             <tr class="Question{{$question->id}}">
                               <td>{{ $question->id }}</td>
                               <td>{{ $question->question_name }}</td>
                               <td>{{ $question->question_label }}</td>
                               <td>{{ $question->question_placeholder }}</td>
                               <td>{{ $question->question_order }}</td>
                               <td>{{ $question->question_status }}</td>
                               <td>{{ $question->question_is_common }}</td>
                               <td>{{ $question->question_basic_search }}</td>
                               <td>{{ $question->question_advance_search }}</td>
                               <td>{{ $question->type }}</td>
                               <td>{{ $question->section_name }}</td>
                               <td>
                                 @if(count($question->answers) > 0)
                                   @foreach($question->answers as $answer)
                                    {{ $answer->answer_name }},
                                    @endforeach
                                 @endif
                               </td>
                               <td><?php echo date('d M Y',strtotime($question->created_at)); ?></td>
                               <td class="px-2 text-nowrap">
                                 <a href="#" class="edit_modal btn btn-sm btn-save" data-id="{{ $question->id }}" data-question_name="{{ $question->question_name }}" data-question_label="{{ $question->question_label }}" data-question_placeholder="{{ $question->question_placeholder }}" data-question_order="{{ $question->question_order }}" data-question_mandatory="{{ $question->question_mandatory }}" data-question_status="{{ $question->question_status }}" data-question_is_common="{{ $question->question_is_common }}" data-question_basic_search="{{ $question->question_basic_search }}" data-question_advance_search="{{ $question->question_advance_search }}" data-data_type_id="{{ $question->data_type_id }}" data-answers="<?php echo htmlspecialchars(json_encode($question->answers), ENT_QUOTES, 'UTF-8'); ?>" data-toggle="modal" data-target="#EditQuestionModal" data-whatever="@mdo"><i class='fa fa-pencil'></i></a>
                                 <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $question->id }}" data-question_name="{{ $question->question_name }}" data-toggle="modal" data-target="#DeleteQuestionModal" data-whatever="@mdo"><i class='fa fa-trash'></i></a>
                               </td>
                             </tr>
                           @endforeach
                        <?php }else { ?>
                          <tr>
                            <th id="yet">
                              <h2>Questions are not added yet</h2>
                            </th>
                          </tr>
                        <?php } ?>
                        </tr>
                    </tbody>
                </table>
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

    $(".data_type_id_add").on('change', function(){
      if($(this).val() == "5f68a1b5b923a" || $(this).val() == "5f68a1c980149" || $(this).val() == "5f68a1ed98c6c"){
        $('.choices_div_add').show();
      }else {
        $('.choices_div_add').hide();
      }
    });

    $(".data_type_id_edit").on('change', function(){
      if($(this).val() == "5f68a1b5b923a" || $(this).val() == "5f68a1c980149" || $(this).val() == "5f68a1ed98c6c"){
        $('.choices_div_edit').show();
      }else {
        $('.choices_div_edit').hide();
      }
    });

    $(".add_more_add").on('click', function(){
      $('.append_choices_add').append('<input type="text" name="answer_name[]" style="border-radius: 5px;" class="form-control appended" placeholder="Enter value" autofocus autocomplete="off"/><br/>')
      $('.appended').focus();
    });

    $(".add_more_edit").on('click', function(){
      $('.append_choices_edit').append('<input type="text" name="answer_name[]" style="border-radius: 5px;" class="form-control appended" placeholder="Enter value" autofocus autocomplete="off"/><br/>')
      $('.appended').focus();
    });

    $(".select_all").change(function(){
    	var status = this.checked;
    	$('.checkbox').each(function(){
    		this.checked = status;
    	});
    });

    $('.checkbox').change(function(){
    	if(this.checked == false){
    		$(".select_all")[0].checked = false;
    	}

    	if ($('.checkbox:checked').length == $('.checkbox').length ){
    		$(".select_all")[0].checked = true;
    	}
    });

    $('#QuestionModal').on('shown.bs.modal', function () {
      $('#QuestionModal').find('#question_form')[0].reset();
      $('#append_errors').hide();
      $('#append_success').hide();
      $('#question_name').focus();
    });


    var question_name_state = false;
    $('.check_question_name').on('blur', function(){
      var question_name = $(this).val();
      var data = {
  			'question_name' : $(this).val(),
  			'question_name_check' : 1
  		};
      if (question_name == '') {
      	question_name_state = false;
      	return;
      }
      $.ajax({
        url:"{{ url('check_question_name_exists') }}",
        type:"post",
        data: data,
        success: function(response){
          $('#append_errors ul').text('');
  				$('#append_success ul').text('');
          if (response == 'taken') {
          	question_name_state = false;
            $('#append_errors').show();
            $('#append_errors ul').append("<li> Sorry... Question name already taken.</li>");
            $('.class_check').prop('disabled', true);
          }else {
          	question_name_state = true;
            $('#append_errors').hide();
            $('.class_check').prop('disabled', false);
          }
        }
      });
    });

  $('#question_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ url('store_data_question') }}",
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
        //   var date = moment(data.created_at).format("D MMM YYYY");
				// 	$('tbody').prepend("<tr class='Category"+data.id+"'>"+
				// 	"<td>" + data.id + "</td>"+
				// 	"<td>" + data.parent_category_name + "</td>"+
				// 	"<td>" + data.category_name + "</td>"+
				// 	"<td>" + '<img src={{ asset("/storage") }}/'+data.category_icon+' width="50px" height="50px">'+ "</td>"+
				// 	"<td>" + date + "</td>"+
				// 	"<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-category_name='"+data.category_name+"' data-category_icon='"+data.category_icon+"' data-parent_category_id='"+data.parent_category_id+"' data-toggle='modal' data-target='#EditCategoryModal' data-whatever='@mdo'>"+
				// 	"<i class='fa fa-pencil'></i> Edit</a> "+
				// 	"<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-category_name='"+data.category_name+"' data-category_icon='"+data.category_icon+"' data-toggle='modal' data-target='#DeleteCategoryModal' data-whatever='@mdo'>"+
				// 	"<i class='fa fa-trash'></i> Delete</a>"+
				// 	"</td>"+
				// 	"</tr>");
					$('#yet').hide();
					$('#append_errors').hide();
					$('#append_success').show();
					$('#append_success ul').append("<li>"+data.success+"</li>");
          $('#QuestionModal').find('#question_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },1000);
					setTimeout(function(){ $('#QuestionModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
          location.reload();
	      }
      },
    });
  });

	$(document).on('click', '.edit_modal', function(){
    $('#EditQuestionModal').find('#edit_question_form')[0].reset();
		$('#fid').val($(this).data('id'));
		$('#edit_fid').val($(this).data('id'));
		$('#edit_question_name').val($(this).data('question_name'));
		$('#edit_question_label').val($(this).data('question_label'));
		$('#edit_question_placeholder').val($(this).data('question_placeholder'));
		$('#edit_question_order').val($(this).data('question_order'));
    $("#edit_data_type_id option[value='"+$(this).data('data_type_id')+"']").prop('selected', true);
    if($(this).data('data_type_id') == '5f68a1b5b923a' || $(this).data('data_type_id') == '5f68a1c980149' || $(this).data('data_type_id') == '5f68a1ed98c6c'){
      $('.choices_div_edit').show();
      $('.append_choices_edit').html('');
      $.each($(this).data('answers'), function(index, value){
        $('.append_choices_edit').append('<input type="text" name="answer_name[]" style="border-radius: 5px;" value="'+value.answer_name+'" class="form-control" autocomplete="off"/><input type="hidden" name="answer_id[]" style="border-radius: 5px;" value="'+value.answer_id+'"/><br/>');
      });
    }else {
      $('.choices_div_edit').hide();
    }

    if($(this).data('question_status') == true){
      $('#edit_question_status').prop('checked', true);
    }else {
      $('#edit_question_status').prop('checked', false);
    }
    if($(this).data('question_mandatory') == true){
      $('#edit_question_mandatory').prop('checked', true);
    }else {
      $('#edit_question_mandatory').prop('checked', false);
    }
    if($(this).data('question_basic_search') == true){
      $('#edit_question_basic_search').prop('checked', true);
    }else {
      $('#edit_question_basic_search').prop('checked', false);
    }
    if($(this).data('question_is_common') == true){
      $('#edit_question_is_common').prop('checked', true);
    }else {
      $('#edit_question_is_common').prop('checked', false);
    }
    if($(this).data('question_advance_search') == true){
      $('#edit_question_advance_search').prop('checked', true);
    }else {
      $('#edit_question_advance_search').prop('checked', false);
    }
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_question_form').on('submit', function(event){
		event.preventDefault();
    $.ajax({
      url:"{{ url('update_data_question') }}",
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
					setTimeout(function(){ $('#EditQuestionModal').modal('hide'); },2000);
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
        url:"{{ url('delete_question_data') }}",
				data:data,
				dataType:"json",
        success:function(data){
					$('#delete_append_success ul').text('');
					$('#delete_append_success').show();
					$('#delete_append_success ul').append("<li>"+data+"</li>");
          $('.Question' + $('.id').text()).remove();
          setTimeout(function(){ $('#delete_append_success').hide(); },1000);
					setTimeout(function(){ $('#DeleteQuestionModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
          locatoin.reload();
        }
    });
  });
});
</script>
<style media="screen">
.close{
  font-size: 1.4rem;
}
</style>
@endsection
