<div class="card">
    <div class="card-header bg-blue text-light">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Businesses</h4>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#BusinessModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Business</a>
        </div>
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
                         <a href="{{ url('show_business') }}/{{ $business->id }}" class="edit_modal btn btn-sm btn-save" ><i class="fa fa-eye" aria-hidden="true"></i> View Details</a>
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
