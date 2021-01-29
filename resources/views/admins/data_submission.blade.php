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
          <div class="row">
            <div class="col-12">
              <form role="form" id="serach_filter_form">
                <div class="row">
                <div class="form-group col-md-3">
                  <input type="text" name="search_by_keyword" class="form-control rounded" placeholder="Search by keyword" value="{{ ($keyword_search == '' ? '' : $keyword_search) }}">
                </div>
                <div class="form-group col-md-3">
                  <input type="text" name="location_name_searched" placeholder="Search location" class="form-control areaofuk rounded" value="{{ ($search_location == 'UK' ? '' : $search_location) }}" autocomplete="off">
                </div>
                <div class="form-group col-md-2">
                  <select name='category_id_searched' class="form-control category_search_form filters custom-select rounded">
                    <option value="category" selected>Select Category</option>
                    @foreach ($cats as $key => $value)
                      <option value="{{ $value->category_name }}" <?php if($value->category_name == $category_search) echo "selected"; ?>>{{ $value->category_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <select name='ethnicity_id_searched' class="form-control ethnicity_search_form filters custom-select rounded">
                    <option value="" selected>Select Ethnicity</option>
                    @foreach ($ethnicities as $key => $value)
                      <option value="{{ $value->ethnicity_name }}" <?php if($value->ethnicity_name == $ethnicity_search) echo "selected"; ?>>{{ $value->ethnicity_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <button type="button" class="btn btn-warning btn-block" id="form_submit" name="button">Search</button>
                </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <form role="form" action="{{ url('/view_data_submissions') }}" method="get" id="is_null_form">
                <div class="form-check d-inline-block mb-2 mr-2">
                  <input type="checkbox" id="name" name="name" class="form-check-input form-control unchecking" value="is_null" <?php $name_null = ($business_is_null == '' ? '' : 'checked'); echo $name_null;?>> &nbsp;
                  <label class="form-check-label" for="name">Business Name Is NULL</label>
                </div>
                <div class="form-check d-inline-block mb-2 mr-2">
                  <input type="checkbox" id="postcode" name="postcode" class="form-check-input form-control unchecking" value="is_null" <?php $post_null = ($postcode_is_null == '' ? '' : 'checked'); echo $post_null;?>> &nbsp;
                  <label class="form-check-label" for="postcode">Postcode Is NULL</label>
                </div>
                <div class="form-check d-inline-block mb-2 mr-2">
                  <input type="checkbox" id="category" name="category" class="form-check-input form-control unchecking" value="is_null" <?php $category_null = ($category_is_null == '' ? '' : 'checked'); echo $category_null;?>> &nbsp;
                  <label class="form-check-label" for="category">Category Is NULL</label>
                </div>
                <div class="form-check d-inline-block mb-2 mr-2">
                  <input type="checkbox" id="location" name="location" class="form-check-input form-control unchecking" value="is_null" <?php $location_null = ($location_is_null == '' ? '' : 'checked'); echo $location_null;?>> &nbsp;
                  <label class="form-check-label" for="location">Location Is NULL</label>
                </div>
                <div class="form-check d-inline-block mb-2 mr-2">
                  <input type="checkbox" id="ethnicity" name="ethnicity" class="form-check-input form-control unchecking" value="is_null" <?php $ethnicity_null = ($ethnicity_is_null == '' ? '' : 'checked'); echo $ethnicity_null;?>> &nbsp;
                  <label class="form-check-label" for="location">Ethnicity Is NULL</label>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 text-right">
              <h3 class="text-right">
                <span style="color: #0087CB;">
                  Showing {{($submissions->currentpage()-1) * $submissions->perpage() + $submissions->count()}} of {{$submissions->total()}} entries
                </span>
              </h3>
            </div>
          </div>
          <div class="card">
              <!-- <div class="card-header bg-blue text-light">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="mb-0">Data Submissions</h4>
                  </div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a class="btn btn-default btn-yellow" href="{{ url('/view_categories') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Business</a>
                  </div>
                </div>
              </div> -->
              <div class="table-responsive small">
                <table class="table table-condensed" id="userTable">
                    <thead>
                        <tr>
                            <th><span>ID</span></th>
                            <th><span>Business Name</span></th>
                            <th><span>Category</span></th>
                            <th><span>Location</span></th>
                            <th><span>Ethnicity</span></th>
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
                               <td class="px-2 text-nowrap">
                                 @if($submission->category_name == "")
                                  {{ $submission->name }}
                                 @else
                                 <a href="{{ url('/edit_data_submission') }}/{{ $submission->id }}/{{ $submission->category_id }}" style="text-decoration: underline;">{{ $submission->name }}</a>
                                 @endif
                               </td>
                               @if($submission->category_id == NULL)
                               <td>
                                 <div class="form-group add">
                                   <select class="form-control parent_category_id" data-business_listing_id="{{ $submission->id }}" style="border-radius: 5px; width: 60%;" name="parent_category_id">
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
                               <td>{{ $submission->location_name }}</td>
                               @if($submission->ethnicity_id == NULL)
                               <td>
                                 <div class="form-group add">
                                   <select class="form-control parent_ethnicity_id" data-business_listing_id="{{ $submission->id }}" style="border-radius: 5px; width: 60%;" name="parent_ethnicity_id">
                                     <option value="">Select Ethnicity</option>
                                     <?php if(isset($ethnicities) && count($ethnicities) > 0){ ?>
                                       @foreach($ethnicities as $ethnicity)
                                       <option value="{{ $ethnicity->id }}">{{ $ethnicity->ethnicity_name }}</option>
                                       @endforeach
                                     <?php } ?>
                                   </select>
                                 </div>
                               </td>
                               @else
                               <td>{{ $submission->ethnicity_name }}</td>
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
                               <td class="px-2 text-nowrap text-center">
                                 @if($submission->category_name != "")
                                  <a href="{{ url('/edit_data_submission') }}/{{ $submission->id }}/{{ $submission->category_id }}" class="btn btn-sm btn-warning"><i class='fa fa-pencil'></i></a>
                                 @endif
                                 <a href="#" class="delete_modal btn btn-sm btn-danger" data-id="{{ $submission->id }}" data-name="{{ $submission->name }}" data-toggle="modal" data-target="#DeleteBusinessModal" data-whatever="@mdo"><i class='fa fa-trash'></i></a>
                               </td>
                             </tr>
                           @endforeach
                        <?php }else { ?>
                          <tr>
                            <th id="yet">
                              <h2>Submissions not found</h2>
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
               {{ $submissions->appends([
                 'postcode' => app('request')->input('postcode'),
                 'name' => app('request')->input('name'),
                 'location' => app('request')->input('location'),
                 'search_by_keyword' => app('request')->input('search_by_keyword'),
                 'category' => app('request')->input('category')
               ])->links() }}
		         </ul>
		      </div>
        </div>
    </div>

<script type="text/javascript">
  function spaceByhyphen(myStr){
    myStr=myStr.toLowerCase();
    myStr=myStr.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");
    myStr=myStr.replace(/\s+/g, "-");
    return myStr;
  }

  function spaceByhyphenOnly(myStr){
    // myStr=myStr.toLowerCase();
    // myStr=myStr.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");
    myStr=myStr.replace(/\s+/g, "-");
    return myStr;
  }

  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('input.unchecking').on('change', function() {
        $('input.unchecking').not(this).prop('checked', false);
    });

    var path_l = "{{ url('/search_location_admin') }}";
    var locations = $('.areaofuk').typeahead({
      source: function (query, process)
      {
        return $.get(path_l, {query: query}, function(locations){
          return process(locations);
        });
      },
      displayText: function (location)
      {
        return location['location_name']+', '+location['country_name'];
      }
    });

    $(".areaofuk").change(function()
    {
      var location_id = $(".areaofuk").typeahead("getActive");
      $("#location_id").val(location_id.location_id);
      $(".areaofuk").val(location_id.location_name);
    });



    $("#is_null_form").change(function(){
      $(this).submit();
    });

    $("#form_submit").click(function(){
      $(".filters").trigger("change");
    });

    $('.filters').on('change', function (e) {
        var req_arr = [],
            box = {};
            arr = [],
            fdata = [],
            loc = $('<a>', { href: window.location })[0];

        $('input').each(function (i){
          if(this.checked && this.type == 'checkbox'){
            arr.push(this.value);
          }
          else if(this.type == "text" && this.value != "" && this.name != "location_name_searched"){
            box[this.name] = this.value;
          }
        });
        $('select').each(function (i){
          if(this.value != "" && this.name != "category_id_searched"){
            arr.push(this.value);
          }
        });

        req_arr.push(box);
        var size = Object.keys(box).length;

        var req_data = req_arr.filter(v=>v!='');
        var data = arr.filter(v=>v!='');
        var fdata = "";
        var qdata = "";
        data.forEach(function(key,i){
          fdata += "/"+data[i].replace(/\s+/g, '-');
        });

        $.each(req_data, function(key,i){
          if(size == 1){
            $.each(i, function(key, value){
              if(value != ""){
                qdata += "?"+key+"="+value.replace(/\s+/g, '-');
              }
            })
          }else if(size > 1){
            var j = 0;
            $.each(i, function(key, value){
              if(value != "" && j == 0){
                qdata += "?"+key+"="+value.replace(/\s+/g, '-');
              }else {
                qdata += "&"+key+"="+value.replace(/\s+/g, '-');
              }
              j++
            })
          }
        });

        var selected_category = $(".category_search_form option:selected").val();
        var selected_location = $("input[name=location_name_searched]").val();
        var sel_cat = spaceByhyphen(selected_category);

        if(selected_location == ""){
          selected_location = "UK"
        }
        var sel_loc = spaceByhyphenOnly(selected_location);
        // console.log(sel_loc);
        // console.log(qdata);
        // console.log(fdata);
        // return false;
        var url_web = "{{ url('/view_data_submissions') }}";
        var url = url_web+'/wedding-'+sel_cat+'/'+sel_loc+fdata+qdata;
        window.location = url;
    });

    $('.parent_category_id').on('change', function(){
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

    $('.parent_ethnicity_id').on('change', function(){
  		event.preventDefault();
  		var data = {
  			'business_listing_id' : $(this).data('business_listing_id'),
  			'ethnicity_id' : $(this).val()
  		};

      $.ajax({
          type:'POST',
          url:"{{ url('update_ethnicity_data_submission') }}",
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
