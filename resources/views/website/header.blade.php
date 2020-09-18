<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-light nav-hw-top" id="mydiv">
    <div class="container small">
        <a class="navbar-brand d-md-block mr-0" href="/" style="color: #000;">myBigAsianWeeding</a>

        @if(!Auth::check())
           <ul class="nav mx-auto mr-sm-0">
            <li class="pl-lg-1 pr-lg-1"><a href="/business_login" class="btn btn-default">Business login</a></li>
            <li class="pl-lg-1 pr-lg-1"><a href="/login" class="btn btn-default">Login</a></li>
            <li class="pl-lg-1 pr-lg-1"><a href="{{ url('/signup') }}" class="btn btn-default">Signup</a></li>
        </ul>
        @endif

        @if(Auth::check())
           <ul class="nav mx-auto mr-sm-0">
            <li class="pl-lg-1 pr-lg-1">
              <a class="dropdown-item small" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fal fa-sign-out-alt"></i> Logout</a>
                <form id="logout-form" style="display: none;" action="{{ url('/logout') }}" method="POST">
                  @csrf
                </form>
            </li>
        </ul>
        @endif

    </div>
</nav> -->

<!-- Header -->
<header class="fixed-top-not">
    <div class="bg-lightgrey small">
        <div class="container-fluid clearfix py-1 text-center text-md-right text-purple">
            <strong>0255</strong> WEDDING SUPPLIERS
            <a href="#libs-your-business" class="btn btn-sm btn-dark py-1 mx-2 rounded">Add Busigness</a>
            <a href="#business-login" class="link-purple">Business Login</a>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-light text-left">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('web_asset/images/my-big-asian-wedding-logo2.png') }}" class="img-fluid"></a>
            <button class="navbar-toggler bg-purple text-light rounded-0" type="button" data-toggle="bs-collapse" data-target="#collapsibleNavbar"><i class="fal fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="nav bs-menu link-purple navbar-nav ml-lg-auto justify-content-lg-end">
                    <li class="nav-item dropdown dropdown-hover">
                        <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ></span>
                        <a class="nav-link" href="wedding_venues.html">Wedding Venues</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="wedding-venues/ballrooms/">Ballrooms</a></li>
                            <li><a class="dropdown-item" href="wedding-venues/barns/">Barns</a></li>
                            <li><a class="dropdown-item" href="wedding-venues/castles/">Castles</a></li>
                            <li><a class="dropdown-item" href="wedding-venues/church/">Church</a></li>
                            <li><a class="dropdown-item" href="wedding-venues/halls/">Halls</a></li>
                            <li><a class="dropdown-item" href="wedding-venues/marquee/">Marquee</a></li>
                            <li><a class="dropdown-item" href="wedding-venues/resorts/">Resorts</a></li>
                            <li><a class="dropdown-item" href="wedding-venues/tents/">Tents</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown dropdown-hover">
                        <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                        <a class="nav-link" href="wedding_suppliers.html">Wedding Suppliers</a>
                        <ul class="dropdown-menu small list-unstyled">
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ></span>
                                <a href="category/accessories/" class="dropdown-item">Accessories</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/accessories/eyewear/">Eyewear</a></li>
                                    <li><a class="dropdown-item" href="category/accessories/hair-pieces/">Hair-Pieces</a></li>
                                    <li><a class="dropdown-item" href="category/accessories/hats-and-fascinators/">Hats and Fascinators</a></li>
                                    <li><a class="dropdown-item" href="category/accessories/tiaras/">Tiaras</a></li>
                                    <li><a class="dropdown-item" href="category/accessories/veils/">Veils</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ></span>
                                <a href="category/accommodation/" class="dropdown-item">Accommodation</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/accommodation/bed-and-breakfast/">Bed-and-Breakfast</a></li>
                                    <li><a class="dropdown-item" href="category/accommodation/hotels/">Hotels</a></li>
                                    <li><a class="dropdown-item" href="category/accommodation/pubs/">Pubs</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ></span>
                                <a href="category/beauty-and-spa/" class="dropdown-item">Beauty &amp; Spa</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/beauty-and-spa/hair-stylists/">Hair Stylist</a></li>
                                    <li><a class="dropdown-item" href="category/beauty-and-spa/makeup-artists/">Makeup-Artists</a></li>
                                    <li><a class="dropdown-item" href="category/beauty-and-spa/men-salons/">Men Salons</a></li>
                                    <li><a class="dropdown-item" href="category/beauty-and-spa/spas/">Spas</a></li>
                                    <li><a class="dropdown-item" href="category/beauty-and-spa/women-salons/">Women Salons</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ></span>
                                <a href="category/bridal-and-womens-wear/" class="dropdown-item">Bridal and Women’s Wear</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/bridal-and-womens-wear/bride-dresses/">Bride Dresses</a></li>
                                    <li><a class="dropdown-item" href="category/bridal-and-womens-wear/bridesmaids-dresses/">Bridesmaids dresses</a></li>
                                    <li><a class="dropdown-item" href="category/bridal-and-womens-wear/flower-girls-dresses/">Flower Girls Dresses</a></li>
                                    <li><a class="dropdown-item" href="category/bridal-and-womens-wear/lingerie/">Lingerie</a></li>
                                    <li><a class="dropdown-item" href="category/bridal-and-womens-wear/shoes/">Shoes</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ></span>
                                <a href="category/decor/" class="dropdown-item">Decor</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/decor/event-styling/">Event Styling</a></li>
                                    <li><a class="dropdown-item" href="category/decor/furniture/">Furniture</a></li>
                                    <li><a class="dropdown-item" href="category/decor/lights/">Lights</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="dropdown-item" href="category/dress-cleaning/">Dress Cleaning</a>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ></span>
                                <a href="category/entertainment/" class="dropdown-item">Entertainment</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/entertainment/bands/">Bands</a></li>
                                    <li><a class="dropdown-item" href="category/entertainment/choreography/">Choreography</a></li>
                                    <li><a class="dropdown-item" href="category/entertainment/dj-and-music/">DJ-and-Music</a></li>
                                    <li><a class="dropdown-item" href="category/entertainment/fire-works/">Fire-Work</a></li>
                                    <li><a class="dropdown-item" href="category/entertainment/jukebox/">Jukebox</a></li>
                                    <li><a class="dropdown-item" href="category/entertainment/magicians/">Magicians</a></li>
                                    <li><a class="dropdown-item" href="category/entertainment/photo-booths/">Photo Booths</a></li>
                                    <li><a class="dropdown-item" href="category/entertainment/wedding-entertainer/">Weddings Entertainers</a></li>
                                    <li><a class="dropdown-item" href="category/fire-works-entertainment/">Fires Work Entertainment</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                <a href="category/food/" class="dropdown-item">Food</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/food/catering/">Catering</a></li>
                                    <li><a class="dropdown-item" href="category/food/chocolate-fountain/">Chocolate Fountain</a></li>
                                    <li><a class="dropdown-item" href="category/food/drinks/">Drinks</a></li>
                                    <li><a class="dropdown-item" href="category/food/wedding-cakes/">Weddings Cakes</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                <a href="category/fragrance/" class="dropdown-item">Fragrance</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/fragrance/for-men/">For-Men</a></li>
                                    <li><a class="dropdown-item" href="category/fragrance/for-women/">For-Women</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                <a href="category/gifts/" class="dropdown-item">Gifts</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/gifts/wedding-albums/">Weddings Albums</a></li>
                                    <li><a class="dropdown-item" href="category/gifts/wedding-favours/">Weddings Favours</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                <a href="category/groom-and-mens-wear/" class="dropdown-item">Groom and men’s wear</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/groom-and-mens-wear/best-man-suits/">Best Man Suits</a></li>
                                    <li><a class="dropdown-item" href="category/groom-and-mens-wear/boutonnieres/">Boutonnieres</a></li>
                                    <li><a class="dropdown-item" href="category/groom-and-mens-wear/cufflinks/">Cufflinks</a></li>
                                    <li><a class="dropdown-item" href="category/groom-and-mens-wear/groom-suits/">Groom suits</a></li>
                                    <li><a class="dropdown-item" href="category/groom-and-mens-wear/page-boys/">Page Boys</a></li>
                                    <li><a class="dropdown-item" href="category/groom-and-mens-wear/shoes-groom-and-mens-wear/">Shoes</a></li>
                                    <li><a class="dropdown-item" href="category/groom-and-mens-wear/ties/">Ties</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                <a href="category/jewellery/" class="dropdown-item">Jewellery</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/jewellery/crowns/">Crowns</a></li>
                                    <li><a class="dropdown-item" href="category/jewellery/earrings/">Earrings</a></li>
                                    <li><a class="dropdown-item" href="category/jewellery/necklaces/">Necklaces</a></li>
                                    <li><a class="dropdown-item" href="category/jewellery/wedding-rings/">Wedding-Rings</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                <a href="category/miscellaneous/" class="dropdown-item">Miscellaneous</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="category/miscellaneous/priests/">Priests</a></li>
                                    <li><a class="dropdown-item" href="category/miscellaneous/props-hire/">Props-Hire</a></li>
                                    <li><a class="dropdown-item" href="category/miscellaneous/wedding-apps/">Weddings Apps</a></li>
                                    <li><a class="dropdown-item" href="category/miscellaneous/wedding-speech-designers/">Weddings Speech designers</a></li>
                                    <li><a class="dropdown-item"href="category/miscellaneous/wedding-websites/">Weddings Websites</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="dropdown-item" href="category/photography/">Photography</a>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                <a href="category/travel/" class="dropdown-item">Travel</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="category/travel/destination-weddings/">Destination Weddings</a></li>
                                        <li><a class="dropdown-item" href="category/travel/honeymoon/">Honeymoon</a></li>
                                    </ul>
                            </li>
                            <li>
                                <a class="dropdown-item" href="category/videography/">Videography</a>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                <a href="category/wedding-florists/" class="dropdown-item">Weddings Florists</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="category/wedding-florists/bridal-bouquets/">Bridal Bouquets</a></li>
                                    </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                <a class="dropdown-item" href="category/wedding-invitations/" class="dropdown-item">Wedding Invitation Cards</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="category/wedding-invitations/e-cards/">E-Cards</a></li>
                                        <li><a class="dropdown-item" href="category/wedding-invitations/invitation-cards/">Invitations Cards</a></li>
                                    </ul>
                            </li>
                            <li>
                                <a class="dropdown-item" href="category/wedding-planners/">Weddings Planners</a>
                            </li>
                            <li class="dropdown-submenu">
                                <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ></span>
                                <a class="dropdown-item" href="category/wedding-transport/" class="dropdown-item">Wedding Transport</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="category/wedding-transport/horse-carriages/">Horse Carriages</a></li>
                                        <li><a class="dropdown-item" href="category/wedding-transport/limousines/">Limousines</a></li>
                                        <li><a class="dropdown-item" href="category/wedding-transport/vintage-cars/">Vintage Car</a></li>
                                    </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reviews.html">Planning Tools</a>
                    </li>
                    <li class="nav-item dropdown dropdown-hover">
                        <span class="dropdown-icon-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ></span>
                        <a class="nav-link" href="events.html">Ideas & Inspiration</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/inspiration/celebrity-weddings/">Celebrity Weddings</a></li>
                                <li><a class="dropdown-item" href="/inspiration/guest-blogs/">Guest Blogs</a></li>
                                <li><a class="dropdown-item" href="/inspiration/latest-trends/">Latest Trends</a></li>
                                <li><a class="dropdown-item" href="/inspiration/tips-ideas/">Tips &amp; Ideas</a></li>
                            </ul>
                    </li>
                </ul>
                @if(!Auth::check())
                  <ul class="nav bs-menu  navbar-nav justify-content-lg-end">
                      <li class="nav-item ">
                          <a class="btn btn-dark btn-purple link-light rounded" href="{{ url('/signup') }}">Sign up</a>
                          <a class="btn btn-dark btn-purple link-light rounded" href="{{ url('/login') }}">Log in</a>
                      </li>
                  </ul>
                @endif
                @if(Auth::check())
                   <ul class="nav mx-auto mr-sm-0">
                    <li class="pl-lg-1 pr-lg-1">
                      <a class="dropdown-item small" href="{{ url('/logout') }}" ><i class="fal fa-sign-out-alt"></i> Logout</a>
                      <!-- <a class="dropdown-item small" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fal fa-sign-out-alt"></i> Logout</a>
                          <form id="logout-form" style="display: none;" action="{{ url('/logout') }}" method="POST">
                          @csrf
                        </form> -->
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </nav>
</header>
