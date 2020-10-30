@include('website.library')
@if(!isset($user))
  @include('website.header')
@endif
@yield('content')
@include('website.footer')




</body>
</html>
