<div class="card">
    <div class="card-header bg-blue text-light">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Countries</h4>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#CountryModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Country</a>
        </div>
      </div>
    </div>
    <div class="table-responsive small">
        <table class="table table-condensed" id="userTable">
            <thead>
                <tr>
                    <th><span>ID</span></th>
                    <th><span>Country Name</span></th>
                    <th><span>Country Flag</span></th>
                    <th><span>Created at</span></th>
                    <th class="text-center" style="width:110px">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  {{ csrf_field() }}
                 <?php if(isset($countries) && count($countries) > 0){ ?>
                   @foreach($countries as $country)
                     <tr class="Country{{$country->id}}">
                       <td>{{ $country->id }}</td>
                       <td><?php echo $country->country_name; ?></td>
                       <td><img src="<?php echo asset('/storage/'.$country->country_flag_image); ?>" width="50px" height="50px"/></td>
                       <td><?php echo date('d M Y',strtotime($country->created_at)); ?></td>
                       <td class="px-2 text-nowrap">
                         <a href="#" class="edit_modal btn btn-sm btn-save" data-id="{{ $country->id }}" data-country_name="{{ $country->country_name }}" data-country_flag_image="{{ $country->country_flag_image }}" data-toggle="modal" data-target="#EditCountryModal" data-whatever="@mdo"><i class='fa fa-pencil'></i> Edit</a>
                         <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $country->id }}" data-country_name="{{ $country->country_name }}" data-country_flag_image="{{ $country->country_flag_image }}" data-toggle="modal" data-target="#DeleteCountryModal" data-whatever="@mdo"><i class='fa fa-trash'></i> Delete</a>
                       </td>
                     </tr>
                   @endforeach
                <?php }else { ?>
                  <tr>
                    <th id="yet">
                      <h2>Countries are not added yet</h2>
                    </th>
                  </tr>
                <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div style="margin-top: 10px;margin-left: 440px;">
   <ul class="pagination-for-countries justify-content-center">
     {{ $countries->links() }}
   </ul>
</div>
