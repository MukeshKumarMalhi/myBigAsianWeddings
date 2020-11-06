<?php
if(Request::getRequestUri() == "/business-register"){ ?>
  <div class="bg-top-url bg-dark" style="background-image: url('{{ asset('web_asset/images/bg-header-business.jpg') }}');">
      <div class="container-fluid py-3">
          <div class="row text-light light-link">
              <div class="col-sm-6 text-center text-sm-left"><img src="{{ asset('web_asset/images/mybigasianwedding-logo.png') }}" class="img-fluid"></div>
              <div class="col-sm-6 text-center text-sm-right"><p><span class="m-3">Are you a Wedding Supplier?</span><a href="{{ url('/business-register') }}" class="btn btn-danger">Register Your Business</a></p></div>
          </div>
      </div>
      <div class="container header-title-top pt-1 pb-80 text-light link-light text-center">
          <h1 class="font-gotham-bold">Business <span class="text-warning">Signup</span></h1>
          <p class="font-gotham-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when ..</p>
      </div>
  </div>
<?php }elseif (Request::getRequestUri() == "/congratulations") { ?>
  <div class="bg-top-url bg-dark" style="background-image: url('{{ asset('web_asset/images/bg-header4.jpg') }}');">
      <div class="container-fluid py-3">
          <div class="row text-light light-link">
              <div class="col-sm-6 text-center text-sm-left"><img src="{{ asset('web_asset/images/mybigasianwedding-logo.png') }}" class="img-fluid"></div>
              <div class="col-sm-6 text-center text-sm-right"><p><span class="m-3">Are you a Wedding Supplier?</span><a href="{{ url('/business-register') }}" class="btn btn-danger">Register Your Business</a></p></div>
          </div>
      </div>
      <div class="container header-title-top pt-1 pb-80 text-light link-light text-center">
          <h1 class="font-gotham-bold">Congratulations</h1>
          <p class="font-gotham-bold text-warning">On Joining Uk’s Biggest And Most Diversed<br/>Wedding Suppliers Database</p>
      </div>
  </div>
<?php }elseif (Request::getRequestUri() != "/") { ?>
  <div class="bg-top-url bg-dark" style="background-image: url('{{ asset('web_asset/images/bg-header-business.jpg') }}');">
    <div class="container-fluid py-3">
      <div class="row text-light light-link">
        <div class="col-sm-6 text-center text-sm-left"><img src="{{ asset('web_asset/images/mybigasianwedding-logo.png') }}" class="img-fluid"></div>
        <div class="col-sm-6 text-center text-sm-right"><p><span class="m-3">Are you a Wedding Supplier?</span><a href="{{ url('/business-register') }}" class="btn btn-danger">Register Your Business</a></p></div>
      </div>
    </div>
    <div class="container header-title-top pt-1 pb-80 text-light link-light text-center">
      <h1 class="font-gotham-bold">Business <span class="text-warning">Signup</span></h1>
      <p class="font-gotham-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when ..</p>
    </div>
  </div>
<?php } ?>
