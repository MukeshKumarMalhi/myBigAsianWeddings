@include('website.library')
<body>

@if(!isset($user))
  @include('website.header')
@endif

@if(isset($user))
  @include('website.sub_header')
@endif
<!-- Page contents -->
  <div class="bg-grey hw-height">
    @yield('content')
  </div>
@include('website.footer')

</body>
</html>
