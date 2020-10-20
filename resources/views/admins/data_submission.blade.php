@extends('layouts.a_app')

@section('content')

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
                </div>
              </div>
              <div class="table-responsive small">
                <table class="table table-condensed" id="userTable">
                    <thead>
                        <tr>
                            <th><span>ID</span></th>
                            <th><span>Business Name</span></th>
                            <th><span>Category Name</span></th>
                            <!-- <th><span>Email</span></th> -->
                            <th><span>Created at</span></th>
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
                               <!-- <td>{{ $submission->email }}</td> -->
                               <td><?php echo date('d M Y',strtotime($submission->created_at)); ?></td>
                               <td class="px-2 text-nowrap">
                                 <a href="{{ url('/edit_data_submission') }}/{{ $submission->id }}/{{ $submission->category_id }}" class="btn btn-sm btn-warning"><i class='fa fa-eye'></i> Edit Submission</a>
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
});
</script>
<style media="screen">
.close{
  font-size: 1.4rem;
}
</style>
@endsection
