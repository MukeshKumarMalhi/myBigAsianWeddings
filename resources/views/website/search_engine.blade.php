@extends('layouts.app')
@section('title','Search Filter')

@section('content')

<!-- section 1 free wedding planning app-->
<div class="container py-5">
<div class="row">
    <div class="col-md-4 col-lg-3">
      <div class="card">
        <div class="card-header bg-blue text-light">
          <h4 class="mb-0"><?php echo "Category : ". $sections[0]->category_name."<br/>"; ?></h4>
        </div>
        <div class="table-responsive small p-4" style="font-size: 14px;">
          <div role="form" class="form-horizontal" id="serach_filter_form" action="{{ url('search/wedding') }}-{{ str_replace(' ', '-', strtolower($sections[0]->category_name)) }}">
          <?php
          $arr_names = array();
            foreach ($sections as $key => $value) {
              foreach ($value->questions as $key => $val) {
                array_push($arr_names, $val->question_name);
                echo "<h5>$val->question_label</h5>";
                $select = "";
                if(($val->type == "text" && count($val->listings) == 0)){
                  echo "<input type='$val->type' name='$val->question_name' class='form-control filters' placeholder='$val->question_placeholder'>";
                }
                elseif (($val->type == "text" && isset($val->listings) && count($val->listings) > 0)) {
                  $check = "";
                  foreach ($val->listings as $key => $chk_val) {
                    $check = $chk_val;
                  }
                  echo "<input type='$val->type' name='$val->question_name' class='form-control filters' value='$check'>"."<br/>";
                }
                if($val->type == "select" && count($val->listings) == 0){
                  $select .= "<select name='$val->question_name' class='form-control appended_select filters'><option value=''>Select $val->question_label</option>"."<br/>";
                }
                elseif ($val->type == "select" && count($val->listings) > 0) {
                  // array_push($arr_name_updated, "updated_".$val->question_name);
                  // foreach ($val->listings as $key => $list_selectbox) {
                    $select .= "<select name='$val->question_name' class='form-control appended_select filters'><option value=''>Select $val->question_label</option>"."<br/>";
                  // }
                }
                $options = "";
                foreach ($val->answers as $key => $answer) {
                  if(($val->type == "checkbox" && count($val->listings) == 0) || ($val->type == "radio" && count($val->listings) == 0)){
                    echo "<input type='checkbox' name='$val->question_name' value='$answer->answer_name' class='form-control filters' style='display: inline-block;'> "."$answer->answer_name"."<br/>";
                  }elseif (($val->type == "checkbox" && isset($val->listings) && count($val->listings) > 0) || ($val->type == "radio" && isset($val->listings) && count($val->listings) > 0)) {
                    $check = "";
                    foreach ($val->listings as $key => $chk) {
                      if($chk == $answer->answer_name){
                        $check = "checked";
                      }
                    }
                    echo "<input type='checkbox' name='$val->question_name' value='$answer->answer_name' class='form-control filters' style='display: inline-block;' $check> "."$answer->answer_name"."<br/>";
                  }
                  if($val->type == "select" && count($val->listings) == 0){
                    $options .= "<option value='$answer->answer_name'>"."$answer->answer_name"."</option>";
                  }elseif ($val->type == "select" && count($val->listings) > 0) {
                    $selected = "";
                    foreach ($val->listings as $key => $selecte) {
                      if($selecte == $answer->answer_name){
                        $selected = "selected";
                      }
                    }
                    $options .= "<option value='$answer->answer_name' $selected>"."$answer->answer_name"."</option>";
                  }
                }
                $select .= $options;
                echo "$select"."</select>"."<br/>";
              }
              echo "<hr/>";
            }
          ?>
        </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-lg-9">
      <div class="container-fluid py-1">
          <div class="row no-gutters-8">
            <?php foreach ($businesses as $key => $value): ?>
              <div class="col-md-6 col-lg-4">
                <div class="card bs-supplier-box mb-3">
                  <a href="{{ url('/wedding') }}-{{ strtolower($value->category_name) }}/{{ str_replace(' ', '-', strtolower($value->name)) }}">
                    <div class="card-img-top bs-supplier-img bg-center-url" style="background-image: url('{{ asset('web_asset/images/benedict.jpg') }}');">
                      <div class="bs-star-ratings pt-3 pl-2 text-white font-weight-bold" style="font-size: 12px;background: linear-gradient(rgba(0, 0, 0,0.6) 0%, rgb(0, 0, 0, 0) 100%);">
                        <i class="fas fa-map-marker-alt"></i> Karachi
                      </div>
                    </div>
                  </a>
                  <div class="card-body p-2 text-purple">
                      <h5 class="font-weight-bold">{{ $value->name }}</h5>
                      @if(isset($value->category_name))<p class="font-weight-bold">Category: {{ $value->category_name }} <br/> </p>@endif
                      @if(isset($value->venue_type))<p class="font-weight-bold">Venue type: <br/> @foreach($value->venue_type as $val) {{ $val }} <br/> @endforeach </p>@endif
                      @if(isset($value->no_of_weeding_hosted))<p class="font-weight-bold">No of weeding hosted: <br/> @foreach($value->no_of_weeding_hosted as $v) {{ $v }} <br/> @endforeach </p>@endif
                      @if(isset($value->cultural_experience))<p class="font-weight-bold">Cultural experience: <br/> @foreach($value->cultural_experience as $va) {{ $va }} <br/> @endforeach </p>@endif
                      @if(isset($value->styles))<p class="font-weight-bold">Styles: <br/> @foreach($value->styles as $valu) {{ $valu }} <br/> @endforeach </p>@endif
                      <a href="#" class="brochure_modal_heading btn btn-success link-light px-3 py-2 rounded mb-2 mt-1 text-center d-block" data-business_name_heading="{{ $value->name }}" data-toggle="modal" data-target="#modalBrochure">Request a brochure</a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="pagination-center">
            {{ $businesses->appends([
              'sort_type' => app('request')->input('sort_type')
            ])->links() }}
          </div>
      </div>
    </div>
</div>
</div>

<script type="text/javascript">

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
          else if(this.type == "text" && this.value != ""){
            box[this.name] = this.value;
          }
        });
        $('select').each(function (i){
          if(this.value != ""){
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

        var category_name = "{{ str_replace(' ', '-', strtolower($sections[0]->category_name)) }}";
        var url = 'http://127.0.0.1:8000/search/weeding-'+category_name+fdata+qdata;
        window.location = url;
    });

  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $('#serach_filter_form').on('change', function(){
    //   $(this).submit();
    // });

    // var selected = new Array();
    // var field_name = $(this).attr('name');
    // $('.filters').on('change', function(){
    //     // selected.push(this.name);
    //     selected.push($(this).attr('name'));
    //     console.log(selected);
    // });
    // console.log(selected);

    // var array_temp = new Array();
    // $('#serach_filter_form .filters').on('change', function(){
    //   var field_name = $(this).attr('name');
    //   // var names_array = @json($arr_names);
    //   array_temp.push(field_name);
    //
    //   if(jQuery.inArray(field_name, array_temp) !== -1){
    //     console.log('exists');
    //   }else {
    //     console.log('not exists');
        // for(var i=0; i<names_array.length; i++){
        //   var prices = $('input[name="'+field_name+'"]:checked').map(function () {
        //     return this.value;
        //   }).get().join(',');
        //   var qs = $.param({
        //     price: prices
        //   }, true);
        // }

        // console.log('http://localhost/test/javascript.php?' + qs);
      // }



      // var colors = $('input[type=checkbox][name='+field_name+'[]]:checked').map(function () {
      //     return this.value;
      // }).get().join(',');
      // console.log(colors);
      // var qs = $.param({
      //   price: prices,
      //   colors: colors
      // }, true);

      // console.log('http://localhost/test/javascript.php?' + qs);
      // var names_array = names_array.map(i => 'array_' + i);
      // for(var i=0; i<names_array.length; i++){
      //   var name = names_array[i];
      //   name = new Array();
      // }

      // var array_temp = new Array();
      // if(jQuery.inArray(field_name, names_array) !== -1){
      //   if(jQuery.inArray("array_"+field_name, array_temp) !== -1){
      //     return false;
      //   }else {
      //     array_temp.push("array_"+field_name);
      //   }
      //   var array_v = new Array(array_temp[0]);
      //   $('input[name='+field_name+']:checked').each(function(){
      //      array_v.push($(this).val());
      //   });
      //   console.log(array_v);
      // }else {
      //   console.log('does not exists');
      // }

      // var paramsArray = [];
      // for (var i = 0; i < array_temp.length; i++) {
      //   var pricesParams = createParamList(array_temp[i],field_name);
      //   if(pricesParams){
      //     paramsArray.push(pricesParams);
      //   }
      //   // console.log(pricesParams);
      // }
      // alert('http://127.0.0.1:8000/search/wedding?'+paramsArray.join('&'));
      // return false;
     // });

    // function createParamList(arrayObj, prefix)
    // {
    //   console.log(arrayObj);
    //   // return false;
    //   var result = arrayObj.map(function(obj){return prefix+'='+obj;}).join('&');
    //   return result;
    // }
  });
  </script>


@endsection
