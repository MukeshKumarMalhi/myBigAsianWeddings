@extends('layouts.a_app')

@section('content')

<!-- delete submission modal -->
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
<!-- delete submission modal end -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid py-3" id="submissions">
          <!-- table-->
          <div class="card">
              <div class="card-header bg-blue text-light">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="mb-0">Data Submissions</h4>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a class="btn btn-default btn-yellow" href="{{ url('/view_categories') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Business</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive small">
                <table class="table table-condensed" id="userTable">
                    <thead>
                        <tr>
                            <th><span>ID</span></th>
                            <th><span>Business Name</span></th>
                            <th><span>Category Name</span></th>
                            <th><span>Created By (Date:)</span></th>
                            <th><span>Updated By (Date:)</span></th>
                            <th class="text-center" style="width:110px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          {{ csrf_field() }}
                         <?php if(isset($submissions) && count($submissions) > 0){ ?>
                           @foreach($submissions as $submission)
                             <tr class="Submission{{$submission->id}}">
                               <td>{{ $submission->id }}</td>
                               <td class="px-2 text-nowrap"><a href="{{ url('/edit_data_submission') }}/{{ $submission->id }}/{{ $submission->category_id }}" style="text-decoration: underline;">{{ $submission->name }}</a></td>
                               @if($submission->category_id == NULL)
                               <td>
                                 <div class="form-group add">
                                   <select class="form-control" id="parent_category_id" data-business_listing_id="{{ $submission->id }}" style="border-radius: 5px; width: 60%;" name="parent_category_id">
                                     <option value="">Select Category</option>
                                     <?php if(isset($cats) && count($cats) > 0){ ?>
                                       @foreach($cats as $cat)
                                       <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                       @endforeach
                                     <?php } ?>
                                   </select>
                                 </div>
                               </td>
                               @else
                               <td>{{ $submission->category_name }}</td>
                               @endif
                               <td>
                                 @if($submission->created_at != null)
                                  {{ $submission->created_by_user }} (<?php echo date('d M Y',strtotime($submission->created_at)); ?>)
                                 @endif
                               </td>
                               <td>
                                 @if($submission->updated_at != null)
                                  {{ $submission->updated_by_user }} (<?php echo date('d M Y',strtotime($submission->updated_at)); ?>)
                                 @endif
                               </td>
                               <td class="px-2 text-nowrap">
                                 <a href="{{ url('/edit_data_submission') }}/{{ $submission->id }}/{{ $submission->category_id }}" class="btn btn-sm btn-warning"><i class='fa fa-pencil'></i></a>
                                 <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $submission->id }}" data-name="{{ $submission->name }}" data-toggle="modal" data-target="#DeleteBusinessModal" data-whatever="@mdo"><i class='fa fa-trash'></i></a>
                               </td>
                             </tr>
                           @endforeach
                        <?php }else { ?>
                          <tr>
                            <th id="yet">
                              <h2>Submissions are not added yet</h2>
                            </th>
                          </tr>
                        <?php } ?>
                        </tr>
                    </tbody>
                </table>
              </div>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-submission justify-content-center">
               {{ $submissions->links() }}
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

    $('#parent_category_id').on('change', function(){
  		event.preventDefault();
  		var data = {
  			'business_listing_id' : $(this).data('business_listing_id'),
  			'category_id' : $(this).val()
  		};

      $.ajax({
          type:'POST',
          url:"{{ url('update_category_data_submission') }}",
  				data:data,
  				dataType:"json",
          success:function(data){
  					alert(data);
            location.reload();
          }
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
          url:"{{ url('delete_business_listing') }}",
          data:data,
          dataType:"json",
          success:function(data){
            $('#delete_append_success ul').text('');
            $('#delete_append_success').show();
            $('#delete_append_success ul').append("<li>"+data+"</li>");
            setTimeout(function(){ $('#DeleteBusinessModal').modal('hide'); },2000);
            setTimeout(function(){ $('body').removeClass('modal-open'); },1000);
            setTimeout(function(){ $('.modal-backdrop').remove(); },1000);
            location.reload();
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
