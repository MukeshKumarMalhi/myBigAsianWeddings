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
                       <td>{{ $location->country_name }}</td>
                       <td>{{ $location->location_name }}</td>
                       <td><img src="<?php echo asset('/storage/'.$location->location_icon); ?>" width="50px" height="50px"/></td>
                       <td><?php echo date('d M Y',strtotime($location->created_at)); ?></td>
                       <td class="px-2 text-nowrap">
                         <!-- <a href="#" class="edit_modal btn btn-sm btn-save" data-id="{{ $location->id }}" data-country_id="{{ $location->country_id }}" data-location_name="{{ $location->location_name }}" data-location_icon="{{ $location->location_icon }}" data-toggle="modal" data-target="#EditLocationModal" data-whatever="@mdo"><i class='fa fa-pencil'></i> Edit</a> -->
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
