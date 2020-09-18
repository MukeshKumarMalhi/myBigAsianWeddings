<div class="card">
    <div class="card-header bg-blue text-light">
      <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">Features</h4>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#FeatureModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Feature</a>
        </div>
      </div>
    </div>
    <div class="table-responsive small">
        <table class="table table-condensed" id="userTable">
            <thead>
                <tr>
                    <th><span>ID</span></th>
                    <th><span>Parent Feature</span></th>
                    <th><span>Feature Name</span></th>
                    <th><span>Feature Icon</span></th>
                    <th><span>Created at</span></th>
                    <th class="text-center" style="width:110px">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  {{ csrf_field() }}
                 <?php if(isset($features) && count($features) > 0){ ?>
                   @foreach($features as $feature)
                     <tr class="Feature{{$feature->id}}">
                       <td>{{ $feature->id }}</td>
                       <td>{{ $feature->parent_feature_name }}</td>
                       <td>{{ $feature->feature_name }}</td>
                       <td><img src="<?php echo asset('/storage/'.$feature->feature_icon); ?>" width="50px" height="50px"/></td>
                       <td><?php echo date('d M Y',strtotime($feature->created_at)); ?></td>
                       <td class="px-2 text-nowrap">
                         <a href="#" class="edit_modal btn btn-sm btn-save" data-id="{{ $feature->id }}" data-feature_name="{{ $feature->feature_name }}" data-feature_icon="{{ $feature->feature_icon }}" data-parent_feature_id="{{ $feature->parent_feature_id }}" data-toggle="modal" data-target="#EditFeatureModal" data-whatever="@mdo"><i class='fa fa-pencil'></i> Edit</a>
                         <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $feature->id }}" data-feature_name="{{ $feature->feature_name }}" data-feature_icon="{{ $feature->feature_icon }}" data-toggle="modal" data-target="#DeleteFeatureModal" data-whatever="@mdo"><i class='fa fa-trash'></i> Delete</a>
                       </td>
                     </tr>
                   @endforeach
                <?php }else { ?>
                  <tr>
                    <th id="yet">
                      <h2>Features are not added yet</h2>
                    </th>
                  </tr>
                <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div style="margin-top: 10px;margin-left: 440px;">
   <ul class="pagination-for-features justify-content-center">
     {{ $features->links() }}
   </ul>
</div>
