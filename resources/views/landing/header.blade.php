<?php
if(Request::getRequestUri() == "/business-register"){ ?>
  <!-- <div class="bg-top-url bg-dark" style="background-image: url('{{ asset('web_asset/images/bg-header-business.jpg') }}');">
      <div class="container-fluid py-3">
          <div class="row text-light light-link">
              <div class="col-sm-6 text-center text-sm-left"><a href="{{ url('/') }}"><img src="{{ asset('web_asset/images/mybigasianwedding-logo.png') }}" class="img-fluid"></a></div>
              <div class="col-sm-6 text-center text-sm-right"><p><span class="m-3">Are you a Wedding Supplier?</span><a href="{{ url('/business-register') }}" class="btn btn-danger">Register Your Business</a></p></div>
          </div>
      </div>
      <div class="container header-title-top pt-1 pb-80 text-light link-light text-center">
          <h1 class="font-gotham-bold">Business <span class="text-warning">Signup</span></h1>
          <p class="font-gotham-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when ..</p>
      </div>
  </div> -->
<?php }elseif (Request::getRequestUri() == "/congratulations") { ?>
  <div class="bg-top-url bg-dark" style="background-image: url('{{ asset('web_asset/images/bg-header4-2.png') }}');">
      <div class="container-fluid py-3">
          <div class="row text-light light-link">
              <div class="col-sm-6 text-center text-sm-left"><a href="{{ url('/') }}"><img src="{{ asset('web_asset/images/mybigasianwedding-logo.png') }}" class="img-fluid"></a></div>
              <div class="col-sm-6 text-center text-sm-right"><p><span class="m-3">Are you a Wedding Supplier?</span><a href="{{ url('/business-register') }}" class="btn btn-danger">Register Your Business</a></p></div>
          </div>
      </div>
      <div class="container header-title-top pt-1 pb-80 text-light link-light text-center">
        <h1 class="font-gotham-bold">Congratulations</h1>
          <p><span class="text-warning font-gotham-bold">On Joining UK’s Biggest And Most Diversed Wedding Suppliers Database</span><br/>
              We have over <span class="text-warning font-gotham-bold">10 years</span> of experience working in the wedding industry in the UK and as we develop one of the most powerful, artificial intelligence supported and completely FREE wedding planning tool, we want to make sure we provide one-stop wedding planning solution to our users with all the reliable wedding suppliers and vendors available on a single click.</p>
      </div>
  </div>
<?php }elseif (Request::getRequestUri() != "/") { ?>
  <div class="bg-top-url bg-dark" style="background-image: url('{{ asset('web_asset/images/bg-header-business.jpg') }}');">
    <div class="container-fluid py-3">
      <div class="row text-light light-link">
        <div class="col-sm-6 text-center text-sm-left"><a href="{{ url('/') }}"><img src="{{ asset('web_asset/images/mybigasianwedding-logo.png') }}" class="img-fluid"></a></div>
        <div class="col-sm-6 text-center text-sm-right"><p><span class="m-3">Are you a Wedding Supplier?</span><a href="{{ url('/business-register') }}" class="btn btn-danger">Register Your Business</a></p></div>
      </div>
    </div>
    <div class="container header-title-top pt-1 pb-80 text-light link-light text-center">
      <h1 class="font-gotham-bold">Business <span class="text-warning">Signup</span></h1>
      <p class="font-gotham-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when ..</p>
    </div>
  </div>
<?php } ?>
