@include('website.library')

@if(!isset($user))
  @include('website.header')
@endif
@if(isset($user))
  @include('website.sub_header')
@endif

<!-- Navbar links -->


@yield('content')


@include('website.footer')




</body>
</html>
