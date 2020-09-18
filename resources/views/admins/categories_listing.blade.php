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
                    <!-- <th class="text-center" style="width:110px">Action</th> -->
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
                       <td><img src="<?php echo asset('/storage/'.$category->category_icon); ?>" width="50px" height="50px"/></td>
                       <td><?php echo date('d M Y',strtotime($category->created_at)); ?></td>
                       <td class="px-2 text-nowrap">
                         <!-- <a href="#" class="edit_modal btn btn-sm btn-save" data-id="{{ $category->id }}" data-category_name="{{ $category->category_name }}" data-category_icon="{{ $category->category_icon }}" data-parent_category_id="{{ $category->parent_category_id }}" data-toggle="modal" data-target="#EditCategoryModal" data-whatever="@mdo"><i class='fa fa-pencil'></i> Edit</a> -->
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
