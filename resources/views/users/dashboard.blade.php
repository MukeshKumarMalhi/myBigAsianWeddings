@extends('layouts.u_app')
@section('title','Wedding planner')

@section('content')

  <!-- Page Content -->
  <!-- Results -->
  <div class="border-bottom">
      <div class="container pt-3">
          [content]
      </div>
  </div>
  <!-- Page Content End -->

  <script type="text/javascript">
    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
      return true;
    }

    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    });
  </script>
@endsection
