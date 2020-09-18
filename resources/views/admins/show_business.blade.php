@extends('layouts.a_app')

@section('content')

    <!-- Page Content -->
    <!-- edit Location modal -->
      <div class="modal fade" id="EditBusinessModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document" style="max-width: 1000px !important;">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="exampleModalLabel">Edit Business</h5>
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
      				<form method="post" role="form" class="form-horizontal" id="edit_business_form" enctype="multipart/form-data">
      					@csrf
      					<div class="form-group row add">
      						<label for="fid" class="control-label col-sm-3" style="font-weight: 500;">ID :</label>
      						<div class="col-sm-9">
      							<input type="text" id="fid" name="fid" style="border-radius: 5px;" class="form-control" disabled/>
      							<input type="hidden" id="edit_fid" name="edit_fid">
      						</div>
      					</div>
                <div class="form-group row add">
                  <label for="edit_location_id" class="control-label col-sm-3" style="font-weight: 600;">Location :</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="edit_location_id" style="border-radius: 5px;" name="edit_location_id">
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
                  <label for="edit_category_id" class="control-label col-sm-3" style="font-weight: 600;">Category :</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="edit_category_id" style="border-radius: 5px;" name="edit_category_id">
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
                                <input id="{{ $feature->id }}" type="checkbox" name="edit_features[]" class="iCheck" value="{{ $feature->id }}">&nbsp; {{ $feature->feature_name }}
                            </label>
                        @endforeach
                    </div>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="edit_name" class="control-label col-sm-3" style="font-weight: 600;">Name :</label>
                  <div class="col-sm-9">
                    <input type="text" name="edit_name" id="edit_name" style="border-radius: 5px;" class="form-control" autocomplete="off" autofocus required/>
                  </div>
                </div>
                <div class="form-group row add">
                  <label for="business_hours" class="control-label col-sm-3" style="font-weight: 600;">Week Opening Days and Hours :</label>
                  <div class="col-sm-9">
                    <div id="businessHoursContainerJson"></div>
                    <button id="btnInit" type="button" class="btn btn-primary" style="display: none;">Init</button>
                    <textarea id="businessHoursData" class="form-control" style="border-radius: 5px; display: none;" rows="8" cols="80">
                    </textarea>
                    <div id="businessHoursContainer3"></div>
                      <button id="btnSerialize" type="button" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Done</button>
                      <textarea id="businessHoursOutput1" name="edit_business_hours_data" class="form-control" style="border-radius: 5px;" rows="8" cols="80"></textarea>
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

    <div id="page-content-wrapper">

        <div class="container-fluid py-3" id="users">
          <!-- table-->
          <div class="card">
            <div class="media border p-3">
              <div class="text-center row" style="margin-right: 5px;">
                <div class="col-sm-12">
                  <img src="<?php echo asset('/storage/'.$business->business_logo); ?>" alt="{{ $business->name }}" class="mr-3 mt-3 rounded-circle" style="width:210px;">
                  <h4>{{ $business->name }} {{ $business->tagline }}</h4>
                </div>
              </div>
              <div class="media-body">
                <div class="row">
                  <div class="col-sm-12" style="text-align: right;">
                    <a href="#" class="edit_modal btn btn-default btn-save" data-toggle="modal" data-target="#EditBusinessModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Business</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <h4>Business Info</h4>
                    <table class="table table-user-information">
                      <tbody>
                        <tr>
                          <th>Email:</th>
                          <td>1</td>
                        </tr>
                        <tr>
                          <th>CNIC:</th>
                          <td>2</td>
                        </tr>
                        <tr>
                          <th>Company:</th>
                          <td>3</td>
                        </tr>
                        <tr>
                          <th>Designation:</th>
                          <td>4</td>
                        </tr>
                        <tr>
                          <th>Contact:</th>
                          <td>5</td>
                        </tr>
                        <tr>
                          <th>Address:</th>
                          <td>6</td>
                        </tr>
                        <tr>
                          <th>Availability:</th>
                          <td>7</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div id="append_membership_data">
                  </div>
                  <div class="col-sm-6">
                    <h4>Business Info</h4>
                    <table class="table table-user-information">
                      <tbody style="text-align: left;">
                        <tr>
                          <th>Type:</th>
                          <td>8</td>
                        </tr>
                        <tr>
                          <th>Status:</th>
                          <td>9</td>
                        </tr>
                        <tr>
                          <th>Start Date:</th>
                          <td>10</td>
                        </tr>
                        <tr>
                          <th>Expiry Date:</th>
                          <td>11</td>
                        </tr>
                        <tr>
                          <th>Comments:</th>
                          <td>12</td>
                        </tr>
                        <tr>
                          <th>Given Amount:</th>
                          <td>Rs.</td>
                        </tr>
                        <tr>
                          <th>Due Amount:</th>
                          <td>Rs.</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
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

  var businessHoursManager = $("#businessHoursContainerJson").businessHours();
        $("#btnSerialize").click(function() {
            $("textarea#businessHoursOutput1").val(JSON.stringify(businessHoursManager.serialize()));
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

        var b3 = $("#businessHoursContainerJson");
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

    $('#UserModal').on('shown.bs.modal', function () {
      $('#name').focus();
    });
    $('#MemberModal').on('shown.bs.modal', function () {
      $('#amount').focus();
    });

    $(document).on('click', '.edit_modal', function(){
      // var data_h = "{{ $business->business_hours[0]->business_hours_json }}";
      // console.log(JSON.parse(data_h));
      $("#btnInit").click();
      $('#businessHoursData').val()
  		$('#fid').val($(this).data('id'));
  		$('#edit_fid').val($(this).data('id'));
  		// $('#edit_location_name').val($(this).data('location_name'));
  		// $('#edit_location_icon').val($(this).data('location_icon'));
  		$('#edit_append_errors').hide();
  		$('#edit_append_success').hide();
  	});
});
</script>
<style media="screen">
.close{
  font-size: 1.4rem;
}
.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad {
  margin-top:20px;
}

.status_suspend{
  color: #fff;
  background-color: #dc3545;
  border-color: #dc3545;
  padding: .25rem .5rem;
  font-size: 16px;
  line-height: 1.5;
  border-radius: .2rem;
}
.status_confirmed{
  color: #fff;
  background-color: #28a745;
  border-color: #28a745;
  padding: .25rem .5rem;
  font-size: 16px;
  line-height: 1.5;
  border-radius: .2rem;
}
.status_temporary{
  color: #212529;
  background-color: #ffc107;
  border-color: #ffc107;
  padding: .25rem .5rem;
  font-size: 16px;
  line-height: 1.5;
  border-radius: .2rem;
}
</style>
@endsection
