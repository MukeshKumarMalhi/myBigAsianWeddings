@extends('layouts.a_app')

@section('content')

    <!-- Page Content -->
    <!-- add business modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="LocationModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:200%;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
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
            <form method="post" role="form" class="form-horizontal" id="location_form">
              @csrf
              <div class="form-group row add">
                <label for="location_name" class="control-label col-sm-2" style="font-weight: 600;">Name :</label>
                <div class="col-sm-10">
                  <input type="text" name="location_name" id="location_name" style="border-radius: 5px;" class="form-control" placeholder="Enter Location Name" autocomplete="off" autofocus required/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="country_id" class="control-label col-sm-2" style="font-weight: 600;">Country :</label>
                <div class="col-sm-10">
                  <select class="form-control" id="country_id" style="border-radius: 5px;" name="country_id">
                    <option value="">Select Country</option>
                    <?php if(isset($countries) && count($countries) > 0){ ?>
                      @foreach($countries as $country)
                      <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                      @endforeach
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row add">
    						<label for="location_icon" class="control-label col-sm-2" style="font-weight: 600;">Location Icon :</label>
    						<div class="col-sm-10">
    							<input type="file" class="form-control image" id="location_icon" accept="image/*" name="location_icon" style="border-radius: 5px;">
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
    <!-- add Location modal -->
    <!-- edit Location modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="EditLocationModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
      		<div class="modal-content" style="width:200%;">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit Location</h5>
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
      				<form method="post" role="form" class="form-horizontal" id="edit_location_form" enctype="multipart/form-data">
      					@csrf
      					<div class="form-group row add">
      						<label for="fid" class="control-label col-sm-2" style="font-weight: 500;">ID :</label>
      						<div class="col-sm-10">
      							<input type="text" id="fid" name="fid" style="border-radius: 5px;" class="form-control" disabled/>
      							<input type="hidden" id="edit_fid" name="edit_fid">
      						</div>
      					</div>
      					<div class="form-group row add">
      						<label for="edit_location_name" class="control-label col-sm-2" style="font-weight: 600;">Name :</label>
      						<div class="col-sm-10">
      							<input type="text" id="edit_location_name" name="edit_location_name" style="border-radius: 5px;" class="form-control" autofocus required/>
      						</div>
      					</div>
                <div class="form-group row add">
                  <label for="edit_country_id" class="control-label col-sm-2" style="font-weight: 600;">Country :</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="edit_country_id" style="border-radius: 5px;" name="edit_country_id">
                      <option value="">Select Country</option>
                      <?php if(isset($countries) && count($countries) > 0){ ?>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                        @endforeach
                      <?php } ?>
                    </select>
                  </div>
                </div>
      					<div class="form-group row add">
      						<label for="edit_location_icon" class="control-label col-sm-2" style="font-weight: 600;">Location Icon :</label>
      						<div class="col-sm-7">
      							<input type="file" class="form-control image" accept="image/*" id="edit_location_icon" name="edit_location_icon" autocomplete="off" style="border-radius: 5px;">
      						</div>
                  <div class="col-sm-3" id="show_image">
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
      <!-- edit location modal end -->
      <!-- delete location modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeleteLocationModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <!-- edit location modal end -->

    <div id="page-content-wrapper">

        <div class="container-fluid py-3" id="locations">
          <!-- table-->
          <div class="card">
              <div class="card-header bg-blue text-light">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="mb-0">Locations</h4>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#LocationModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Location</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive small">
                  <table class="table table-condensed" id="userTable">
                      <thead>
                          <tr>
                              <th><span>ID</span></th>
                              <th><span>Country</span></th>
                              <th><span>Location Name</span></th>
                              <th><span>Location Icon</span></th>
                              <th><span>Created at</span></th>
                              <th class="text-center" style="width:110px">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            {{ csrf_field() }}
                           <?php if(isset($locations) && count($locations) > 0){ ?>
                             @foreach($locations as $location)
                               <tr class="Location{{$location->id}}">
                                 <td>{{ $location->id }}</td>
                                 <td>{{ $location->country_id }}</td>
                                 <td>{{ $location->location_name }}</td>
                                 <td><img src="<?php echo asset('/storage/'.$location->location_icon); ?>" width="50px" height="50px"/></td>
                                 <td><?php echo date('d M Y',strtotime($location->created_at)); ?></td>
                                 <td class="px-2 text-nowrap">
                                   <a href="#" class="edit_modal btn btn-sm btn-save" data-id="{{ $location->id }}" data-location_name="{{ $location->location_name }}" data-location_icon="{{ $location->location_icon }}" data-country_id="{{ $location->country_id }}" data-toggle="modal" data-target="#EditLocationModal" data-whatever="@mdo"><i class='fa fa-pencil'></i> Edit</a>
                                   <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $location->id }}" data-location_name="{{ $location->location_name }}" data-location_icon="{{ $location->location_icon }}" data-toggle="modal" data-target="#DeleteLocationModal" data-whatever="@mdo"><i class='fa fa-trash'></i> Delete</a>
                                 </td>
                               </tr>
                             @endforeach
                          <?php }else { ?>
                            <tr>
                              <th id="yet">
                                <h2>Locations are not added yet</h2>
                              </th>
                            </tr>
                          <?php } ?>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-locations justify-content-center">
		           {{ $locations->links() }}
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

    $('#LocationModal').on('shown.bs.modal', function () {
      $('#location_name').focus();
    });

  $('#location_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ url('store_location') }}",
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
					$('tbody').prepend("<tr class='Location"+data.id+"'>"+
					"<td>" + data.id + "</td>"+
					"<td>" + data.country_name + "</td>"+
					"<td>" + data.location_name + "</td>"+
          "<td>" + '<img src={{ asset("/storage") }}/'+data.location_icon+' width="50px" height="50px">'+ "</td>"+
					"<td>" + date + "</td>"+
					"<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-location_name='"+data.location_name+"' data-location_icon='"+data.location_icon+"' data-country_id='"+data.country_id+"' data-toggle='modal' data-target='#EditLocationModal' data-whatever='@mdo'>"+
					"<i class='fa fa-pencil'></i> Edit</a> "+
					"<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-location_name='"+data.location_name+"' data-location_icon='"+data.location_icon+"' data-toggle='modal' data-target='#DeleteLocationModal' data-whatever='@mdo'>"+
					"<i class='fa fa-trash'></i> Delete</a>"+
					"</td>"+
					"</tr>");
					$('#yet').hide();
					$('#append_errors').hide();
					$('#append_success').show();
					$('#append_success ul').append("<li>Location Created Successfully.</li>");
          $('#LocationModal').find('#location_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },1000);
					setTimeout(function(){ $('#LocationModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);

	      }
      },
    });
  });

	$(document).on('click', '.edit_modal', function(){
		$('#fid').val($(this).data('id'));
		$('#edit_fid').val($(this).data('id'));
		$('#edit_location_name').val($(this).data('location_name'));
    $('#show_image').html('<img src={{ asset("/storage") }}/'+$(this).data('location_icon')+' width="155px" height="150px">');
    $("#edit_country_id option[value='"+$(this).data('country_id')+"']").prop('selected', true);
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_location_form').on('submit', function(event){
		event.preventDefault();
    $.ajax({
      url:"{{ url('update_location') }}",
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
					$('.Location' + data.id).replaceWith(" "+
					"<tr class='Location"+data.id+"'>"+
					"<td>" + data.id + "</td>"+
          "<td>" + data.country_name + "</td>"+
					"<td>" + data.location_name + "</td>"+
					"<td>" + '<img src={{ asset("/storage") }}/'+data.location_icon+' width="50px" height="50px">'+ "</td>"+
					"<td>" + date + "</td>"+
					"<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-location_name='"+data.location_name+"' data-location_icon='"+data.location_icon+"' data-country_id='"+data.country_id+"' data-toggle='modal' data-target='#EditLocationModal' data-whatever='@mdo'>"+
					"<i class='fa fa-pencil'></i> Edit</a> "+
					"<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-location_name='"+data.location_name+"' data-location_icon='"+data.location_icon+"' data-toggle='modal' data-target='#DeleteLocationModal' data-whatever='@mdo'>"+
					"<i class='fa fa-trash'></i> Delete</a>"+
					"</td>"+
					"</tr>");
					$('#edit_append_errors').hide();
					$('#edit_append_success').show();
					$('#edit_append_success ul').append("<li>Location Updated Successfully.</li>");
          setTimeout(function(){ $('#edit_append_success').hide(); },1000);
					setTimeout(function(){ $('#EditLocationModal').modal('hide'); },2000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },2000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },2000);
        }
      },
    });
  });

	$(document).on('click', '.delete_modal', function(){
		$('.title').html($(this).data('location_name'));
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
        url:"{{ url('delete_location') }}",
				data:data,
				dataType:"json",
        success:function(data){
					$('#delete_append_success ul').text('');
					$('#delete_append_success').show();
					$('#delete_append_success ul').append("<li>"+data+"</li>");
          $('.Location' + $('.id').text()).remove();
          setTimeout(function(){ $('#delete_append_success').hide(); },1000);
					setTimeout(function(){ $('#DeleteLocationModal').modal('hide'); },2000);
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
