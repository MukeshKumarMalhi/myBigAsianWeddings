@extends('layouts.a_app')

@section('content')

    <!-- Page Content -->
    <!-- add Category modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="CategoryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:200%;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
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
            <form method="post" role="form" class="form-horizontal" id="category_form">
              @csrf
              <div class="form-group row add">
                <label for="category_name" class="control-label col-sm-3" style="font-weight: 600;">Name :</label>
                <div class="col-sm-9">
                  <input type="text" name="category_name" id="category_name" style="border-radius: 5px;" class="form-control" placeholder="Enter Category Name" autocomplete="off" autofocus required/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="parent_category_id" class="control-label col-sm-3" style="font-weight: 600;">Parent Category :</label>
                <div class="col-sm-9">
                  <select class="form-control" id="parent_category_id" style="border-radius: 5px;" name="parent_category_id">
                    <option value="">Select Parent Category</option>
                    <?php if(isset($cats) && count($cats) > 0){ ?>
                      @foreach($cats as $cat)
                      <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                      @endforeach
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row add">
    						<label for="category_icon" class="control-label col-sm-3" style="font-weight: 600;">Upload Category Icon :</label>
    						<div class="col-sm-9">
    							<input type="file" class="form-control image" id="category_icon" name="category_icon" style="border-radius: 5px;">
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
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="EditCategoryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
      		<div class="modal-content" style="width:200%;">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
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
      				<form method="post" role="form" class="form-horizontal" id="edit_category_form" enctype="multipart/form-data">
      					@csrf
      					<div class="form-group row add">
      						<label for="fid" class="control-label col-sm-3" style="font-weight: 600;">ID :</label>
      						<div class="col-sm-9">
      							<input type="text" id="fid" name="fid" style="border-radius: 5px;" class="form-control" disabled/>
      							<input type="hidden" id="edit_fid" name="edit_fid">
      						</div>
      					</div>
      					<div class="form-group row add">
      						<label for="edit_category_name" class="control-label col-sm-3" style="font-weight: 600;">Name :</label>
      						<div class="col-sm-9">
      							<input type="text" id="edit_category_name" name="edit_category_name" style="border-radius: 5px;" class="form-control" autofocus required/>
      						</div>
      					</div>
                <div class="form-group row add">
                  <label for="edit_parent_category_id" class="control-label col-sm-3" style="font-weight: 600;">Parent Category :</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="edit_parent_category_id" style="border-radius: 5px;" name="edit_parent_category_id">
                      <option value="">Select Parent Category</option>
                      <?php if(isset($cats) && count($cats) > 0){ ?>
                        @foreach($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                      <?php } ?>
                    </select>
                  </div>
                </div>
      					<div class="form-group row add">
      						<label for="edit_category_icon" class="control-label col-sm-3" style="font-weight: 600;">Category Icon :</label>
      						<div class="col-sm-6">
      							<input type="file" class="form-control image" id="edit_category_icon" name="edit_category_icon" autocomplete="off" style="border-radius: 5px;">
      						</div>
                  <div class="col-sm-3" id="show_image"></div>
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
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeleteCategoryModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <h4 class="mb-0">Categories</h4>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#CategoryModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Category</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive small">
                  <table class="table table-condensed" id="userTable">
                      <thead>
                          <tr>
                              <th><span>ID</span></th>
                              <th><span>Parent Category</span></th>
                              <th><span>Category Name</span></th>
                              <th><span>Category Icon</span></th>
                              <th><span>Created at</span></th>
                              <th class="text-center" style="width:110px">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            {{ csrf_field() }}
                           <?php if(isset($categories) && count($categories) > 0){ ?>
                             @foreach($categories as $category)
                               <tr class="Category{{$category->id}}">
                                 <td>{{ $category->id }}</td>
                                 <td>{{ $category->parent_category_name }}</td>
                                 <td>{{ $category->category_name }}</td>
                                 <td><img src="<?php echo asset('storage/'.$category->category_icon); ?>" width="50px" height="50px"/></td>
                                 <td><?php echo date('d M Y',strtotime($category->created_at)); ?></td>
                                 <td class="px-2 text-nowrap">
                                   <a href="#" class="edit_modal btn btn-sm btn-save" data-id="{{ $category->id }}" data-category_name="{{ $category->category_name }}" data-category_icon="{{ $category->category_icon }}" data-parent_category_id="{{ $category->parent_category_id }}" data-toggle="modal" data-target="#EditCategoryModal" data-whatever="@mdo"><i class='fa fa-pencil'></i> Edit</a>
                                   <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $category->id }}" data-category_name="{{ $category->category_name }}" data-category_icon="{{ $category->category_icon }}" data-toggle="modal" data-target="#DeleteCategoryModal" data-whatever="@mdo"><i class='fa fa-trash'></i> Delete</a>
                                 </td>
                               </tr>
                             @endforeach
                          <?php }else { ?>
                            <tr>
                              <th id="yet">
                                <h2>Categories are not added yet</h2>
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
		           {{ $categories->links() }}
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

    $('#CategoryModal').on('shown.bs.modal', function () {
      $('#category_name').focus();
    });

  $('#category_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ url('store_category') }}",
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
          var date = moment(data.created_at).format("D MMM YYYY");
					$('tbody').prepend("<tr class='Category"+data.id+"'>"+
					"<td>" + data.id + "</td>"+
					"<td>" + data.parent_category_name + "</td>"+
					"<td>" + data.category_name + "</td>"+
					"<td>" + '<img src={{ asset("/storage") }}/'+data.category_icon+' width="50px" height="50px">'+ "</td>"+
					"<td>" + date + "</td>"+
					"<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-category_name='"+data.category_name+"' data-category_icon='"+data.category_icon+"' data-parent_category_id='"+data.parent_category_id+"' data-toggle='modal' data-target='#EditCategoryModal' data-whatever='@mdo'>"+
					"<i class='fa fa-pencil'></i> Edit</a> "+
					"<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-category_name='"+data.category_name+"' data-category_icon='"+data.category_icon+"' data-toggle='modal' data-target='#DeleteCategoryModal' data-whatever='@mdo'>"+
					"<i class='fa fa-trash'></i> Delete</a>"+
					"</td>"+
					"</tr>");
					$('#yet').hide();
					$('#append_errors').hide();
					$('#append_success').show();
					$('#append_success ul').append("<li>Category Created Successfully.</li>");
          $('#CategoryModal').find('#category_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },1000);
					setTimeout(function(){ $('#CategoryModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);

	      }
      },
    });
  });

	$(document).on('click', '.edit_modal', function(){
		$('#fid').val($(this).data('id'));
		$('#edit_fid').val($(this).data('id'));
		$('#edit_category_name').val($(this).data('category_name'));
    $('#show_image').html('<img src={{ asset("/storage") }}/'+$(this).data('category_icon')+' width="155px" height="150px">');
    $("#edit_parent_category_id option[value='"+$(this).data('parent_category_id')+"']").prop('selected', true);
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_category_form').on('submit', function(event){
		event.preventDefault();
    $.ajax({
      url:"{{ url('update_category') }}",
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
          var date = moment(data.created_at).format("D MMM YYYY");
					$('.Category' + data.id).replaceWith(" "+
					"<tr class='Category"+data.id+"'>"+
					"<td>" + data.id + "</td>"+
					"<td>" + data.parent_category_name + "</td>"+
					"<td>" + data.category_name + "</td>"+
					"<td>" + '<img src={{ asset("/storage") }}/'+data.category_icon+' width="50px" height="50px">'+ "</td>"+
					"<td>" + date + "</td>"+
					"<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-category_name='"+data.category_name+"' data-category_icon='"+data.category_icon+"' data-parent_category_id='"+data.parent_category_id+"' data-toggle='modal' data-target='#EditCategoryModal' data-whatever='@mdo'>"+
					"<i class='fa fa-pencil'></i> Edit</a> "+
					"<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-category_name='"+data.category_name+"' data-category_icon='"+data.category_icon+"' data-toggle='modal' data-target='#DeleteCategoryModal' data-whatever='@mdo'>"+
					"<i class='fa fa-trash'></i> Delete</a>"+
					"</td>"+
					"</tr>");
					$('#edit_append_errors').hide();
					$('#edit_append_success').show();
					$('#edit_append_success ul').append("<li>Category Updated Successfully.</li>");
          setTimeout(function(){ $('#edit_append_success').hide(); },1000);
					setTimeout(function(){ $('#EditCategoryModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
        }
      },
    });
  });

	$(document).on('click', '.delete_modal', function(){
		$('.title').html($(this).data('category_name'));
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
        url:"{{ url('delete_category') }}",
				data:data,
				dataType:"json",
        success:function(data){
					$('#delete_append_success ul').text('');
					$('#delete_append_success').show();
					$('#delete_append_success ul').append("<li>"+data+"</li>");
          $('.Category' + $('.id').text()).remove();
          setTimeout(function(){ $('#delete_append_success').hide(); },1000);
					setTimeout(function(){ $('#DeleteCategoryModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
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
