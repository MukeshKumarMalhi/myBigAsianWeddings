@extends('layouts.l_app')
@section('title','Congatulations')

@section('content')
<div class="overflow-hidden">
    <div class="container py-5">
        <div class="border px-4 mt-4 bg-discount-packages" style="margin: auto; max-width: 1200px;">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-8">
                    <div class="py-4">
                        <h2 class="text-warning font-gotham-bold mb-4">Make An Impression On Your Client</h2>
                        <p>While our users are our top priority, we do acknowledge that all the business suppliers and vendors need to be well-equipped with the creative visuals, strong social media presence, impractful website and other digital marketing tools to impress your potential clients and grow your business. For this very reason, we are offering you over <span class="text-warning font-gotham-bold">50%</span> discount tools build and grow the digital presence of your business.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="text-center">
                        <img src="{{ asset('web_asset/images/Group 2080.png') }}" class="img-fluid margin-negetive" alt="50%Off Discount On All Packages">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .margin-negetive{margin-top:-20px;margin-bottom:-20px;}
    .bg-discount-packages{background-color: #ffffff; position:relative; width:90%;}
    .bg-discount-packages:before{content:''; display:block;position:absolute; z-index: -1; transform: translate(-50%,-50%) rotate(-180deg); left:0;top:0; width: 140px; height: 75px;background-image: url(web_asset/images/group-2114.png); background-repeat:no-repeat;}
    .bg-discount-packages:after{content:''; display:block;position:absolute; z-index: -1; transform: translate(-50%,-50%); left:100%;top:100%;width: 140px; height: 75px;background-image: url(web_asset/images/group-2114.png); background-repeat:no-repeat;}
</style>

<div class="container py-4">
    <h2 class="font-gotham-bold">Graphic Design</h2>
    <p>Visual branding is the most important step for any business since its the first thing which leaves an impact on your potential clientele. Please make sure you have strong brand identity and supporting visuals ready to attract your customers.</p>
    <div class="row text-center">
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Logo Design.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Logo Design</h4>
                    <p>Get a custom designed unique logo for your brand to stand out from the crowd.</p>
                    <h4 class="font-gotham-bold"><del>£150</del> <span style="color: #e41f25;">£70</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Brand Identity Design.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Brand Identity Design</h4>
                    <p>Impress your customers with a complete set of professionally designed branding items</p>
                    <h4 class="font-gotham-bold"><del>£150</del> <span style="color: #e41f25;">£70</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Leaflet  Flyer Design.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Leaflet / Flyer Design</h4>
                    <p>Promote your business through attention grabbing leaflet / flyer design to target local clientele.</p>
                    <h4 class="font-gotham-bold"><del>£120</del> <span style="color: #e41f25;">£50</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Digital Brochure Design.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Digital Brochure Design</h4>
                    <p>Email or whatsapp your beautifully designed 6 page digital brochure to your potential clients to make an impression and make a sale.</p>
                    <h4 class="font-gotham-bold"><del>£250</del> <span style="color: #e41f25;">£120</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
    </div>

</div>

<div class="container py-4">
    <h2 class="font-gotham-bold">Website / Mobile App Development</h2>
    <p>In this digital world you need to be equipped with all the assets to always stay ahead from your competitors. Our talented developers can develop user-friendly mobile-responsive websites or apps for your brand to put you in direct contact with your clientele.</p>
    <div class="row text-center">
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Customisable Website.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Customisable Website</h4>
                    <p>We can design and develop a 5 page customisable mobile responsive and SEO friendly website for you to highlight your services and establish your online presence.</p>
                    <h4 class="font-gotham-bold"><del>£500</del> <span style="color: #e41f25;">£250</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Shopify eCommerce Website.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Shopify eCommerce Website</h4>
                    <p>Are you planning to sell your services or wedding related products online? Let us setup the most powerful eCommerce website for you to increase your online sales.</p>
                    <h4 class="font-gotham-bold"><del>£800</del> <span style="color: #e41f25;">£400</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Domain and Web Hosting.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Domain and Web Hosting</h4>
                    <p>We offer .co.uk and .com domain names along with web hosting space on UK's most powerful servers. Just tell us the domain and we'll register it for you to host your websites. *Annual fees</p>
                    <h4 class="font-gotham-bold"><del>£180</del> <span style="color: #e41f25;">£90</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Mobile App.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Mobile App</h4>
                    <p>We can design and develop iOS and Android mobile apps for your business to make sure your clients can do live chat, place orders and track their deliveries using their smartphones.</p>
                    <h4 class="font-gotham-bold"><del>£1,500</del> <span style="color: #e41f25;">£750</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
    </div>
</div>
<div class="container pt-4 pb-5">
    <h2 class="font-gotham-bold">Digital and Social Media Marketing</h2>
    <p>Nothing sells on its own until you market it correctly in today's highly competitive world. Our digital marketing experts are at your service to make sure you can expand your online audience and use digital / social media platforms to sell your services and grow your business.</p>
    <div class="row text-center">
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Social Media Posts Designs.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Social Media Posts Designs</h4>
                    <p>We'll do the research, develop the content and design one month social media content for you. Up to 24 social media posts included.</p>
                    <h4 class="font-gotham-bold"><del>£300</del> <span style="color: #e41f25;">£150</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Social Media Management.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Social Media Management</h4>
                    <p>Let the experts manage your social media accounts on monthly basis to make sure all the comments and messages are promptly responded.</p>
                    <h4 class="font-gotham-bold"><del>£300</del> <span style="color: #e41f25;">£150</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Google PPC Ads.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Google PPC Ads</h4>
                    <p>We can help you run paid Google PPC campaigns in your local area to make sure you budget is efficiently spent to get maximum leads.</p>
                    <h4 class="font-gotham-bold"><del>£400</del> <span style="color: #e41f25;">£200</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card rounded-0 border-0 bg-grey bs-product-box">
                <div class="card-img-top bg-center-url" style="background-image: url('web_asset/images/Instagram  Facebook Campaigns.jpg');"></div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="font-gotham-medium">Instagram / Facebook Campaigns</h4>
                    <p>We know what audience to target for social media boosting. Let us run your paid campaigns on Instagram and Facebook to capture new leads.</p>
                    <h4 class="font-gotham-bold"><del>£400</del> <span style="color: #e41f25;">£200</span></h4>
                </div>
                <a href="#" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target=".interested-popup">Interested</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<!-- interested-popup -->
<div class="modal fade interested-popup" tabindex="-1" role="dialog" aria-labelledby="Review-popupLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content bg-warning">
            <a class="close" data-dismiss="modal"><i class="fal fa-times"></i></a>
            <form method="post" id="intrested_in_graphics_design_form" role="form" class="form-horizontal">
              @csrf
                <div class="p-5">
                    <div class="form-group text-center">
                        <img src="web_asset/images/mybigasianwedding-logo.png" class="img-fluid">
                        <h2 class="font-gotham-medium">Discuss your project with us here</h2>
                        <h4 class="font-gotham-medium">Send us an email using the following form and receive a guaranteed response within 24 hours.</h4>
                    </div>
                    <div class="append_response mb-3" style="color: #e41f25 !important; border-color: #e41f25; border: 1px solid; padding: 15px 0px 0px 0px; border-radius: 5px; display: none;">
                      <ul style="list-style: none;"></ul>
                    </div>
                    <div class="append_success mb-3" style="border: 1px solid; padding: 15px 0px 0px 0px; border-radius: 5px; display: none;">
                      <ul style="list-style: none;"></ul>
                    </div>
                     <div class="row">
                        <div class="form-group col-sm-6">
                            <input id="full_name" type="text" name="full_name" class="form-control border-right-0" placeholder="Your Name" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="email" name="email" class="form-control border-right-0" placeholder="Email" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="text" name="phone" class="form-control border-right-0" placeholder="Phone Number" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <select name="best_time_to_call" class="form-control bs-sec border-right-0" aria-invalid="false" required>
                                <option value="">Best time to call</option>
                                <option value="Morning">Morning</option>
                                <option value="Afternoon">Afternoon</option>
                                <option value="Evening">Evening</option>
                                <option value="Night">Night</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="font-gotham-bold h4 mb-3">Interested in</label>
                        <div class="row bs-custom-checkbox border-light">
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Logo Design" value="Logo Design">
                                  <label class="form-check-label pl-1" for="Logo Design"> Logo Design</label>
                                </div>
                            </div>
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Brand Identity Design" value="Brand Identity Design">
                                  <label class="form-check-label pl-1" for="Brand Identity Design">Brand Identity Design</label>
                                </div>
                            </div>
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Leaflet / Flyer Design" value="Leaflet / Flyer Design">
                                  <label class="form-check-label pl-1" for="Leaflet / Flyer Design">Leaflet / Flyer Design</label>
                                </div>
                            </div>
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Digital Brochure Design" value="Digital Brochure Design">
                                  <label class="form-check-label pl-1" for="Digital Brochure Design">Digital Brochure Design</label>
                                </div>
                            </div>
                        <!-- </div>
                        <div class="row bs-custom-checkbox border-light"> -->
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Customisable Website" value="Customisable Website">
                                  <label class="form-check-label pl-1" for="Customisable Website">Customisable Website</label>
                                </div>
                            </div>
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Shopify eCommerce Website" value="Shopify eCommerce Website">
                                  <label class="form-check-label pl-1" for="Shopify eCommerce Website">Shopify eCommerce Website</label>
                                </div>
                            </div>
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Domain and Web Hosting" value="Domain and Web Hosting">
                                  <label class="form-check-label pl-1" for="Domain and Web Hosting">Domain and Web Hosting</label>
                                </div>
                            </div>
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Mobile App" value="Mobile App">
                                  <label class="form-check-label pl-1" for="Mobile App">Mobile App</label>
                                </div>
                            </div>
                        <!-- </div>
                        <div class="row bs-custom-checkbox border-light"> -->
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Social Media Posts Designs" value="Social Media Posts Designs">
                                  <label class="form-check-label pl-1" for="Social Media Posts Designs">Social Media Posts Designs</label>
                                </div>
                            </div>
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Social Media Management" value="Social Media Management">
                                  <label class="form-check-label pl-1" for="Social Media Management">Social Media Management</label>
                                </div>
                            </div>
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Google PPC Ads" value="Google PPC Ads">
                                  <label class="form-check-label pl-1" for="Google PPC Ads">Google PPC Ads</label>
                                </div>
                            </div>
                            <div class="form-group col-3 col-md-3">
                                <div class="form-check">
                                  <input class="form-check-input" name="intrested_in[]" type="checkbox" id="Instagram / Facebook Campaigns" value="Instagram / Facebook Campaigns">
                                  <label class="form-check-label pl-1" for="Instagram / Facebook Campaigns">Instagram / Facebook Campaigns</label>
                                </div>
                            </div>
                        </div>

                    <div class="form-group text-center">
                        <button class="btn btn-danger">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  var bs_date_date = $('.countdown').data('date');
  var bs_countDownDate = new Date(bs_date_date).getTime();
  var bs_x = setInterval(function() {
      var bs_now = new Date().getTime();
      var bs_distance = bs_countDownDate - bs_now;

      var bs_days = Math.floor(bs_distance / (1000 * 60 * 60 * 24));
      var bs_hours = Math.floor((bs_distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var bs_minutes = Math.floor((bs_distance % (1000 * 60 * 60)) / (1000 * 60));
      var bs_seconds = Math.floor((bs_distance % (1000 * 60)) / 1000);

      $('.countdown>.countdown-running').html("<span class='days'>" + bs_days + "<span>Days</span> </span> <span class='hours'>" + bs_hours + "<span>Hrs </span></span> <span class='minutes'>"
    + bs_minutes + "<span>Mins </span></span> <span class='seconds'>" + bs_seconds + "<span>Secs </span></span>");

      if (bs_distance < 0) {
          clearInterval(bs_x);
          $('.countdown>.countdown-running').hide();
          $('.countdown>.countdown-ending').show();
      }
  }, 1000);

  // $('.piechart').easyPieChart({
  //     barColor:'#F9A832',
  //     trackColor: '#F6F6F6',
  //     lineCap:'square',
  //     lineWidth: 50,
  //     size  : 400,
  // });
  $('#intrested_in_graphics_design_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('/store_intrested_in_graphics_desgin') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('.append_response ul').text('');
        $('.append_success ul').text('');
        if(data.failure){
          $.each(data.failure, function(i, error){
            $('.append_response').show();
            $('.append_response ul').append("<li><i class='fas fa-exclamation-circle'> " + data.errors[i] + "</i></li>");
          });
        }else if (data.errors) {
          $.each(data.errors, function(j, error){
            $('.append_response').show();
            $('.append_response ul').append("<li><i class='fas fa-exclamation-circle'> " + data.errors[j] + "</i></li>");
          });
        }else if (data.success) {
          $('.append_response').hide();
          $('.append_success').show();
          $('.append_success ul').append("<li><i class='fas fa-check'></i> " + data.success + "</i></li>");
          $('#intrested_in_graphics_design_form')[0].reset();
          setTimeout(function(){ $('#append_success').hide(); },3000);
					setTimeout(function(){ $('.interested-popup').modal('hide'); },3000);
					setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
					setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
        }
      },
    });
  });
});
</script>
<style media="screen">
  .form-check-label{
    vertical-align: text-top;
  }
</style>
@endsection
