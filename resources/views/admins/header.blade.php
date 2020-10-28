<!-- heading text nav -->
<div class="container-fluid text-light ht py-3" style="background: #2c3e50;">
    <nav class="navbar navbar-expand-md small">
      <a class="navbar-brand" href="#" style="color: #fff; font-size: 18px;">myBigAsianWedding</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <!-- <li class="nav-item link-light">
                    <a class="nav-link" href="#">Order</a>
                </li> -->
                <li class="nav-item link-light">
                    <a href="#"><i class="fal fa-user"></i> {{ Auth::user()->name }}</a> &nbsp; &nbsp;
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fal fa-sign-out-alt"></i> Log out</a>
                    <form id="logout-form" style="display: none;" action="{{ url('/logout') }}" method="POST">
                      @csrf
                    </form>
                </li>
                <li class="nav-item dropdown">
                    <!-- <a href="#" class="nav-link link-light font-weight-bold" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-menu db-dropdown-msg dropdown-menu-right">
                        <a class="dropdown-item small" href="#"><i class="fal fa-user-alt"></i> View profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#"><i class="fal fa-cog"></i> Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fal fa-sign-out-alt"></i> Log out</a>
                        <form id="logout-form" style="display: none;" action="{{ url('/logout') }}" method="POST">
                          @csrf
                        </form>
                    </div> -->
                </li>
            </ul>
        </div>
    </nav>
</div>
