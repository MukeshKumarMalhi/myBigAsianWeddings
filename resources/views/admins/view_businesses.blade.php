@extends('layouts.a_app')

@section('content')

    <!-- Page Content -->
    <!-- add business modal -->
      <div class="modal fade" id="BusinessModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Business</h5>
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
            <form method="post" role="form" class="form-horizontal" id="business_form">
              @csrf
              <div class="form-group row add">
                <label for="location_id" class="control-label col-sm-3" style="font-weight: 600;">Location :</label>
                <div class="col-sm-9">
                  <select class="form-control" id="location_id" style="border-radius: 5px;" name="location_id">
                    <option value="">Select Location</option>
                    <?php if(isset($locations) && count($locations) > 0){ ?>
                      @foreach($locations as $location)
                      <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                      @endforeach
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row add">
                <label for="category_id" class="control-label col-sm-3" style="font-weight: 600;">Category :</label>
                <div class="col-sm-9">
                  <select class="form-control" id="category_id" style="border-radius: 5px;" name="category_id">
                    <option value="">Select Category</option>
                    <?php if(isset($categories) && count($categories) > 0){ ?>
                      @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                      @endforeach
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row add">
                <div class="control-label col-sm-3">
                  <label style="font-weight:600;">Features :</label>
                </div>
                <div class="form-group col-md-9">
                    <div  class="" data-toggle="buttons">
                      @foreach($features as $feature)
                          <label for="{{ $feature->id }}" class="btn btn-sm btn-light border d-inline-block mb-2 mr-2">
                              <input id="{{ $feature->id }}" type="checkbox" name="features[]" class="iCheck" value="{{ $feature->id }}">&nbsp; {{ $feature->feature_name }}
                          </label>
                      @endforeach
                  </div>
                </div>
              </div>
              <div class="form-group row add">
                <label for="name" class="control-label col-sm-3" style="font-weight: 600;">Name :</label>
                <div class="col-sm-9">
                  <input type="text" name="name" id="name" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Name" autocomplete="off" autofocus required/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="tagline" class="control-label col-sm-3" style="font-weight: 600;">Tagline :</label>
                <div class="col-sm-9">
                  <input type="text" name="tagline" id="tagline" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Tagline" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="email" class="control-label col-sm-3" style="font-weight: 600;">Email :</label>
                <div class="col-sm-9">
                  <input type="email" name="email" id="email" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Email" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="phone" class="control-label col-sm-3" style="font-weight: 600;">Phone :</label>
                <div class="col-sm-9">
                  <input type="text" name="phone" id="phone" onkeypress="return isNumber(event)" maxlength="20" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Phone Number" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="mobile" class="control-label col-sm-3" style="font-weight: 600;">Mobile :</label>
                <div class="col-sm-9">
                  <input type="text" name="mobile" id="mobile" onkeypress="return isNumber(event)" maxlength="20" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Mobile Number" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="whatsapp" class="control-label col-sm-3" style="font-weight: 600;">WhatsApp :</label>
                <div class="col-sm-9">
                  <input type="text" name="whatsapp" id="whatsapp" onkeypress="return isNumber(event)" maxlength="20" style="border-radius: 5px;" class="form-control" placeholder="Enter Business WhatsApp Number" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="description" class="control-label col-sm-3" style="font-weight: 600;">Description :</label>
                <div class="col-sm-9">
                  <textarea name="description" id="description" style="border-radius: 5px;" class="form-control" placeholder="Enter your description" rows="5" cols="30"></textarea>
                </div>
              </div>
              <div class="form-group row add">
                <label for="website_url" class="control-label col-sm-3" style="font-weight: 600;">Website URL :</label>
                <div class="col-sm-9">
                  <input type="text" name="website_url" id="website_url" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Website URL" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="facebook_url" class="control-label col-sm-3" style="font-weight: 600;">Facebook URL :</label>
                <div class="col-sm-9">
                  <input type="text" name="facebook_url" id="facebook_url" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Facebook URL" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="instagram_url" class="control-label col-sm-3" style="font-weight: 600;">Instagram URL :</label>
                <div class="col-sm-9">
                  <input type="text" name="instagram_url" id="instagram_url" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Instagram URL" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="linkedIn_url" class="control-label col-sm-3" style="font-weight: 600;">LinkedIn URL :</label>
                <div class="col-sm-9">
                  <input type="text" name="linkedIn_url" id="linkedIn_url" style="border-radius: 5px;" class="form-control" placeholder="Enter Business LinkedIn URL" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="twitter_url" class="control-label col-sm-3" style="font-weight: 600;">Twitter URL :</label>
                <div class="col-sm-9">
                  <input type="text" name="twitter_url" id="twitter_url" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Twitter URL" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="youtube_channel_url" class="control-label col-sm-3" style="font-weight: 600;">Youtube Channel URL :</label>
                <div class="col-sm-9">
                  <input type="text" name="youtube_channel_url" id="youtube_channel_url" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Youtube Channel URL" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="address" class="control-label col-sm-3" style="font-weight: 600;">Address :</label>
                <div class="col-sm-9">
                  <textarea name="address" id="address" style="border-radius: 5px;" class="form-control" placeholder="Enter your address" rows="3" cols="30"></textarea>
                </div>
              </div>
              <div class="form-group row add">
                <label for="geo_latitude" class="control-label col-sm-3" style="font-weight: 600;">Geo Latitude :</label>
                <div class="col-sm-9">
                  <input type="text" name="geo_latitude" id="geo_latitude" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Geo Latitude" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="geo_longitude" class="control-label col-sm-3" style="font-weight: 600;">Geo Longitude :</label>
                <div class="col-sm-9">
                  <input type="text" name="geo_longitude" id="geo_longitude" style="border-radius: 5px;" class="form-control" placeholder="Enter Business Geo Longitude" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="business_hours" class="control-label col-sm-3" style="font-weight: 600;">Week Opening Days and Hours :</label>
                <div class="col-sm-9">
                  <div id="container">
                      <div>
                          <div id="businessHoursContainer3"></div>
                          <div style="margin-top: 10px">
                              <button id="btnSerialize" type="button" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Done</button>
                              <textarea id="businessHoursOutput1" name="business_hours_data" class="form-control" style="border-radius: 5px;" rows="8" cols="80"></textarea>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="form-group row add">
                <label for="business_logo" class="control-label col-sm-3" style="font-weight: 600;">Business Logo :</label>
                <div class="col-sm-9">
                  <input type="file" name="business_logo" id="business_logo" style="border-radius: 5px;" class="form-control"  autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row add">
                <label for="business_gallery" class="control-label col-sm-3" style="font-weight: 600;">Upload Business Gallery :</label>
                <div class="col-sm-9">
                  <input type="file" name="business_gallery[]" multiple accept="image/*" id="business_gallery" style="border-radius: 5px;" class="form-control"  autocomplete="off"/>
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
    <!-- add business modal -->
      <!-- delete location modal -->
      <div class="modal fade" style="margin-left: -250px; margin-top: 20px;" id="DeleteBusinessModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <div class="container-fluid py-3" id="businesses">
          <!-- table-->
          <div class="card">
              <div class="card-header bg-blue text-light">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="mb-0">Businesses</h4>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#BusinessModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Business</a>
                  </div>
                  <!-- <div class="col-sm-6" style="text-align: right;">
                  </div> -->
                </div>
              </div>
              <div class="table-responsive small">
                  <table class="table table-condensed" id="userTable">
                      <thead>
                          <tr>
                              <th><span>ID</span></th>
                              <th><span>Category</span></th>
                              <th><span>Location</span></th>
                              <th><span>Business Name</span></th>
                              <th><span>Business Logo</span></th>
                              <th><span>Created at</span></th>
                              <th class="text-center" style="width:110px">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            {{ csrf_field() }}
                           <?php if(isset($businesses) && count($businesses) > 0){ ?>
                             @foreach($businesses as $business)
                               <tr class="Business{{$business->id}}">
                                 <td>{{ $business->id }}</td>
                                 <td>{{ $business->category_name }}</td>
                                 <td>{{ $business->location_name }}</td>
                                 <td>{{ $business->name }}</td>
                                 <td><img src="<?php echo asset('/storage/'.$business->business_logo); ?>" width="50px" height="50px"/></td>
                                 <td><?php echo date('d M Y',strtotime($business->created_at)); ?></td>
                                 <td class="px-2 text-nowrap">
                                   <a href="{{ url('show_business') }}/{{ $business->id }}" class="btn btn-sm btn-warning" ><i class="fa fa-eye" aria-hidden="true"></i> View Details</a>
                                   <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $business->id }}" data-name="{{ $business->name }}" data-business_logo="{{ $business->business_logo }}" data-toggle="modal" data-target="#DeleteBusinessModal" data-whatever="@mdo"><i class='fa fa-trash'></i> Delete</a>
                                 </td>
                               </tr>
                             @endforeach
                          <?php }else { ?>
                            <tr>
                              <th id="yet">
                                <h2>Businesses are not added yet</h2>
                              </th>
                            </tr>
                          <?php } ?>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-businesses justify-content-center">
		           {{ $businesses->links() }}
		         </ul>
		      </div>
        </div>
    </div>

<script type="text/javascript">
  function isNumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }
  var businessHoursManager = $("#businessHoursContainer3").businessHours();
        $("#btnSerialize").click(function() {
            $("textarea#businessHoursOutput1").val(JSON.stringify(businessHoursManager.serialize()));
        });
  var businessHoursManager_edit = $("#businessHoursContainerJson").businessHours();
        $("#btnSerialize_edit").click(function() {
            $("textarea#businessHoursOutput1").val(JSON.stringify(businessHoursManager_edit.serialize()));
        });


(function () {
        // Rainbow.color();
        $("#btnInit").click(function() {
            try{
                var businessHours = jQuery.parseJSON($("#businessHoursData").val());
                $("#businessHoursContainerJson").businessHours({
                    operationTime: businessHours
                });
            }catch(e) {
                alert("JSON non valid: " + e.message);
            }
        });

        var b3 = $("#businessHoursContainer3");
        var businessHoursManagerBootstrap = b3.businessHours({
            postInit: function () {
                b3.find('.operationTimeFrom, .operationTimeTill').bootstrapMaterialDatePicker({
                  format: 'HH:mm',
                  shortTime: true,
                  date: false,
                  time: true,
                  monthPicker: false,
                  year: false,
                  switchOnClick: true
                });
            },
            dayTmpl: '<div class="dayContainer" style="width: 80px;">' +
            '<div data-original-title="" class="colorBox"><input type="checkbox" class="invisible operationState"/></div>' +
            '<div class="weekday"></div>' +
            '<div class="operationDayTimeContainer" style="margin-bottom: 10px;">' +
            '<div class="operationTime input-group">' +
                '<span class="input-group-addon">' +
                    '<i class="fa fa-sun-o"></i>' +
                '</span>' +
            '<input type="text" name="startTime" class="mini-time form-control operationTimeFrom" value=""/></div>' +
            '<div class="operationTime input-group">' +
            '<span class="input-group-addon"><i class="fa fa-moon-o"></i></span><input type="text" name="endTime" class="mini-time form-control operationTimeTill" value=""/></div>' +
            '</div></div>'
        });
    })();

  $(document).ready(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#BusinessModal').on('shown.bs.modal', function () {
      $('#name').focus();
    });

  $('#business_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ url('store_business') }}",
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
          // var date = moment(data.created_at).format("D MMM YYYY");
					// $('tbody').prepend("<tr class='Location"+data.id+"'>"+
					// "<td>" + data.id + "</td>"+
					// "<td>" + data.location_name + "</td>"+
					// "<td>" + data.location_open_time + "</td>"+
					// "<td>" + data.location_close_time + "</td>"+
					// "<td>" + data.location_address + "</td>"+
					// "<td>" + data.location_city + "</td>"+
					// "<td>" + data.location_country + "</td>"+
					// "<td>" + date + "</td>"+
					// "<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-location_name='"+data.location_name+"' data-location_open_time='"+data.location_open_time+"' data-location_close_time='"+data.location_close_time+"' data-location_address='"+data.location_address+"' data-location_city='"+data.location_city+"' data-location_country='"+data.location_country+"' data-toggle='modal' data-target='#EditLocationModal' data-whatever='@mdo'>"+
					// "<i class='fa fa-pencil'></i> Edit</a> "+
					// "<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-location_name='"+data.location_name+"' data-toggle='modal' data-target='#DeleteLocationModal' data-whatever='@mdo'>"+
					// "<i class='fa fa-trash'></i> Delete</a>"+
					// "</td>"+
					// "</tr>");
					$('#yet').hide();
					$('#append_errors').hide();
					$('#append_success').show();
					$('#append_success ul').append("<li>Business Created Successfully.</li>");
          $('#BusinessModal').find('#business_form')[0].reset();
					setTimeout(function(){ $('#append_success').hide(); },2000);
          location.reload();
					// setTimeout(function(){ $('#LocationModal').modal('hide'); },3000);
					// setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					// setTimeout(function(){ $('.modal-backdrop').remove(); },3000);

	      }
      },
    });
  });

  $('#import_excel_form').on('submit', function(event){
		event.preventDefault();

    $.ajax({
      url:"{{ url('store_excel_form') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
			contentType:false,
			cache:false,
			processData:false,
      success:function(data){
				$('#append_errors_excel ul').text('');
				$('#append_success_excel ul').text('');
        if(data.errors)
        {
					$.each(data.errors, function(i, error){
						$('#append_errors_excel').show();
            $('#append_errors_excel ul').append("<li>" + data.errors[i] + "</li>");
        	});
        }else {
					$('#yet').hide();
					$('#append_errors_excel').hide();
					$('#append_success_excel').show();
          $('#append_success_excel ul').append("<li>"+data.success+"</li>");
          $('#ExcelModal').find('#import_excel_form')[0].reset();
					setTimeout(function(){ $('#append_success_excel').hide(); },2000);
          location.reload();
	      }
      },
    });
  });

	$(document).on('click', '.edit_modal', function(){
    $("#btnInit").click();
		$('#fid').val($(this).data('id'));
		$('#edit_fid').val($(this).data('id'));
		// $('#edit_location_name').val($(this).data('location_name'));
		// $('#edit_location_icon').val($(this).data('location_icon'));
		$('#edit_append_errors').hide();
		$('#edit_append_success').hide();
	});

	$('#edit_business_form').on('submit', function(event){
		event.preventDefault();
    $.ajax({
      url:"{{ url('update_business') }}",
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
          // var date = moment(data.created_at).format("D MMM YYYY");
					// $('.Location' + data.id).replaceWith(" "+
					// "<tr class='Location"+data.id+"'>"+
					// "<td>" + data.id + "</td>"+
					// "<td>" + data.location_name + "</td>"+
					// "<td>" + data.location_open_time + "</td>"+
					// "<td>" + data.location_close_time + "</td>"+
					// "<td>" + data.location_address + "</td>"+
					// "<td>" + data.location_city + "</td>"+
					// "<td>" + data.location_country + "</td>"+
					// "<td>" + date + "</td>"+
					// "<td class='px-2 text-nowrap'><a href='#' class='edit_modal btn btn-sm btn-save' data-id='"+data.id+"' data-location_name='"+data.location_name+"' data-location_open_time='"+data.location_open_time+"' data-location_close_time='"+data.location_close_time+"' data-location_address='"+data.location_address+"' data-location_city='"+data.location_city+"' data-location_country='"+data.location_country+"' data-toggle='modal' data-target='#EditLocationModal' data-whatever='@mdo'>"+
					// "<i class='fa fa-pencil'></i> Edit</a> "+
					// "<a href='#' class='delete_modal btn btn-sm btn-danger' data-id='"+data.id+"' data-location_name='"+data.location_name+"' data-toggle='modal' data-target='#DeleteLocationModal' data-whatever='@mdo'>"+
					// "<i class='fa fa-trash'></i> Delete</a>"+
					// "</td>"+
					// "</tr>");
					$('#edit_append_errors').hide();
					$('#edit_append_success').show();
					$('#edit_append_success ul').append("<li>Location Updated Successfully.</li>");
          setTimeout(function(){ $('#edit_append_success').hide(); },3000);
          location.reload();
					// setTimeout(function(){ $('#EditCountryModal').modal('hide'); },3000);
					// setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					// setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
        }
      },
    });
  });

	$(document).on('click', '.delete_modal', function(){
		$('.title').html($(this).data('name'));
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
        url:"{{ url('delete_business') }}",
				data:data,
				dataType:"json",
        success:function(data){
					$('#delete_append_success ul').text('');
					$('#delete_append_success').show();
					$('#delete_append_success ul').append("<li>"+data+"</li>");
          $('.Business' + $('.id').text()).remove();
					setTimeout(function(){ $('#DeleteBusinessModal').modal('hide'); },3000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
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
