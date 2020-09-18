$(document).ready(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $(document).on('click', '.pagination-for-locations a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#locations').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-countries a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#countries').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-categories a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#categories').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-features a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#features').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

  $(document).on('click', '.pagination-for-businesses a',function(event){
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'json',
      success: function(result){
        if(result.status == 'ok'){
          $('#businesses').html(result.listing);
        }else {
          alert("Error when get Pagination");
        }
      }
    });
  });

});
