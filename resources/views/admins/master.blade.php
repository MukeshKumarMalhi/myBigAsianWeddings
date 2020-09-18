@include('admins.a_library')
  @include('admins.header')
<div id="wrapper" class="userid dashboard-page opened vh-100">
  @include('admins.sidebar')
  @yield('content')
</div>
@include('admins.footer')
  </body>
</html>
