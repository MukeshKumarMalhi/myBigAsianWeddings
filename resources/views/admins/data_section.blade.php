@extends('layouts.a_app')

@section('content')

    <!-- Page Content -->
    <!-- add Category modal -->
      <div class="modal fade" id="SectionModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 1000px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Section</h5>
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
            <form method="post" role="form" class="form-horizontal" id="section_form">
              @csrf
              <div class="form-group row add">
                <label for="section_name" class="control-label col-sm-3" style="font-weight: 600;">Section Name :</label>
                <div class="col-sm-9">
                  <input type="text" name="section_name" id="section_name" style="border-radius: 5px;" class="form-control" placeholder="Enter Section Name" autocomplete="off" autofocus required/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="section_sub_heading" class="control-label col-sm-3" style="font-weight: 600;">Section Sub Heading :</label>
                <div class="col-sm-9">
                  <input type="text" name="section_sub_heading" id="section_sub_heading" style="border-radius: 5px;" class="form-control" placeholder="Enter Section Sub Heading" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="categories" class="control-label col-sm-3" style="font-weight: 600;">Select Categories :</label>
                <div class="col-sm-9">
                  <input type="checkbox" class="select_all"> Select All
                  <br />
                  <br />
                  <div class="container-fluid">
                  <?php if(isset($cats) && count($cats) > 0){ ?>
                    <div class="row">
                    @foreach($cats as $cat)
                    <div class="col-md-4">
                    <input type="checkbox" class="checkbox" name="categories[]" value="{{ $cat->id }}"> {{ $cat->category_name }}
                    </div>
                    @endforeach
                    </div>
                  <?php } ?>
                </div>
                </div>
              </div>
              <div class="form-group row add">
                <label for="section_order" class="control-label col-sm-3" style="font-weight: 600;">Section Order :</label>
                <div class="col-sm-9">
                  <input type="text" name="section_order" id="section_order" style="border-radius: 5px;" class="form-control" placeholder="Enter Section Order e.g. 1,2 or 3...." autocomplete="off" required/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="section_basic_search" class="control-label col-sm-3" style="font-weight: 600;">Basic Search :</label>
                <div class="col-sm-9">
                  <input type="checkbox" name="section_basic_search" id="section_basic_search" value="true" style="border-radius: 5px;" class="form-control"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="section_advance_search" class="control-label col-sm-3" style="font-weight: 600;">Advance Search :</label>
                <div class="col-sm-9">
                  <input type="checkbox" name="section_advance_search" id="section_advance_search" value="true" style="border-radius: 5px;" class="form-control"/>
                </div>
              </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-save" id="add">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
      </div>
      </div>
    <!-- add Category modal -->
    <!-- edit Category modal -->
      <div class="modal fade" id="EditSectionModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document" style="max-width: 1000px;">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit Section</h5>
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
      				<form method="post" role="form" class="form-horizontal" id="edit_section_form">
      					@csrf
      					<div class="form-group row add">
      						<label for="fid" class="control-label col-sm-3" style="font-weight: 600;">ID :</label>
      						<div class="col-sm-9">
      							<input type="text" id="fid" name="fid" style="border-radius: 5px;" class="form-control" disabled/>
      							<input type="hidden" id="edit_fid" name="edit_fid">
      						</div>
      					</div>
                <div class="form-group row add">
                  <label for="edit_section_name" class="control-label col-sm-3" style="font-weight: 600;">Section Name :</label>
                  <div class="col-sm-9">
                    <input type="text" name="edit_section_name" id="edit_section_name" style="border-radius: 5px;" class="form-control" placeholder="Enter Section Name" autocomplete="off" autofocus required/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_section_sub_heading" class="control-label col-sm-3" style="font-weight: 600;">Section Sub Heading :</label>
                  <div class="col-sm-9">
                    <input type="text" name="edit_section_sub_heading" id="edit_section_sub_heading" style="border-radius: 5px;" class="form-control" placeholder="Enter Section Sub Heading" autocomplete="off"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="parent_category_id" class="control-label col-sm-3" style="font-weight: 600;">Select Categories :</label>
                  <div class="col-sm-9 all_checks">
                    <input type="checkbox" class="select_all"> Select All
                    <br />
                    <br />
                    <div class="container-fluid">
                    <?php if(isset($cats) && count($cats) > 0){ ?>
                      <div class="row">
                      @foreach($cats as $cat)
                      <div class="col-md-4">
                      <input type="checkbox" class="checkbox" name="categories[]" value="{{ $cat->id }}"> {{ $cat->category_name }}
                    </div>
                      @endforeach
                      </div>
                    <?php } ?>
                  </div>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_section_order" class="control-label col-sm-3" style="font-weight: 600;">Section Order :</label>
                  <div class="col-sm-9">
                    <input type="text" name="edit_section_order" id="edit_section_order" style="border-radius: 5px;" class="form-control" placeholder="Enter Section Order e.g. 1,2 or 3...." autocomplete="off" required/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_section_status" class="control-label col-sm-3" style="font-weight: 600;">Section Status :</label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="edit_section_status" id="edit_section_status" value="true" style="border-radius: 5px;" class="form-control"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_section_basic_search" class="control-label col-sm-3" style="font-weight: 600;">Basic Search :</label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="edit_section_basic_search" id="edit_section_basic_search" value="true" style="border-radius: 5px;" class="form-control"/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_section_advance_search" class="control-label col-sm-3" style="font-weight: 600;">Advance Search :</label>
                  <div class="col-sm-9">
                    <input type="checkbox" name="edit_section_advance_search" id="edit_section_advance_search" value="true" style="border-radius: 5px;" class="form-control"/>
                  </div>
                </div>
      				</div>
      				<div class="modal-footer">
      					<button type="submit" class="edit btn btn-save">Update</button>
      					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      				</div>
      			</form>
      		</div>
      	</div>
      </div>
      <!-- edit Category modal end -->
      <!-- delete Category modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeleteSectionModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <div class="container-fluid py-3" id="categories">
          <!-- table-->
          <div class="card">
              <div class="card-header bg-blue text-light">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="mb-0">Data Section</h4>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#SectionModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Section</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive small">
                <table class="table table-condensed" id="userTable">
                    <thead>
                        <tr>
                            <th><span>ID</span></th>
                            <th><span>Section Name</span></th>
                            <th><span>Order no#</span></th>
                            <th><span>Categories</span></th>
                            <th><span>Created at</span></th>
                            <th class="text-center" style="width:110px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          {{ csrf_field() }}
                         <?php if(isset($sections) && count($sections) > 0){ ?>
                           @foreach($sections as $section)
                             <tr class="Section{{$section->id}}">
                               <td>{{ $section->id }}</td>
                               <td class="px-2 text-nowrap"><a href="{{ url('/show_section') }}/{{ $section->id }}" style="text-decoration: underline;">{{ $section->section_name }}</a></td>
                               <td>{{ $section->section_order }}</td>
                               <td>
                                 <?php
                                  $cat_ids = array();
                                  foreach ($section->categories as $key => $val) {
                                    array_push($cat_ids, $val->category_id);
                                    echo "$val->category_name, ";
                                  }
                                 ?>
                               </td>
                               <td><?php echo date('d M Y',strtotime($section->created_at)); ?></td>
                               <td class="px-2 text-nowrap">
                                 <a href="#" class="edit_modal btn btn-sm btn-save" data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}" data-section_sub_heading="{{ $section->section_sub_heading }}" data-section_order="{{ $section->section_order }}" data-section_status="{{ $section->section_status }}" data-section_basic_search="{{ $section->section_basic_search }}" data-section_advance_search="{{ $section->section_advance_search }}" data-section_advance_search="{{ $section->section_advance_search }}" data-categories="<?php echo htmlspecialchars(json_encode($cat_ids), ENT_QUOTES, 'UTF-8'); ?>" data-toggle="modal" data-target="#EditSectionModal" data-whatever="@mdo"><i class='fa fa-pencil'></i></a>
                                 <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}" data-toggle="modal" data-target="#DeleteSectionModal" data-whatever="@mdo"><i class='fa fa-trash'></i></a>
                                 <a href="{{ url('/show_section') }}/{{ $section->id }}" class="btn btn-sm btn-warning"><i class='fa fa-eye'></i></a>
                                 <!-- <a href="{{ url('/fill_section') }}/{{ $section->id }}" class="btn btn-sm btn-success"><i class="fas fa-edit" aria-hidden="true"></i> Fill </a> -->
                               </td>
                             </tr>
                           @endforeach
                        <?php }else { ?>
                          <tr>
                            <th id="yet">
                              <h2>Sections are not added yet</h2>
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

  $('#section_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ url('store_data_section') }}",
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
          $('#SectionModal').find('#section_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },1000);
					setTimeout(function(){ $('#SectionModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
          location.reload();
	      }
      },
    });
  });

	$(document).on('click', '.edit_modal', function(){
    $('#EditSectionModal').find('#edit_section_form')[0].reset();
		$('#fid').val($(this).data('id'));
		$('#edit_fid').val($(this).data('id'));
		$('#edit_section_name').val($(this).data('section_name'));
		$('#edit_section_sub_heading').val($(this).data('section_sub_heading'));
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
