(function(b){b.fn.bcSwipe = function(c){var f = {threshold: 50};c && b.extend(f, c);this.each(function() {function c(a) {1 == a.touches.length && (d = a.touches[0].pageX, e = !0, this.addEventListener("touchmove", g,{passive: true}))}function g(a){e && (a = d - a.touches[0].pageX, Math.abs(a) >= f.threshold && (h(), 0 < a ? b(this).carousel("next") : b(this).carousel("prev")))}function h(){this.removeEventListener('touchmove', g, {passive: true});d = null;e = !1;}var e = !1,d;this.addEventListener('touchstart', c, {passive: true});});return this}})(jQuery);
$(document).ready(function(){$('.carousel').bcSwipe({ threshold: 50 });});

$(".menu-press").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("closed");
});
jQuery(document).ready(function($){
	$('[data-toggle="offcanvas"]').on('click', function () {
    	$('.offcanvas-collapse').toggleClass('open')
  	})

	// var $header_height = $("header.fixed-top-not");
 //    var $header = $header_height.height();
 //    var $headercover = $("body");
 //    // $headercover.css('padding-top', $header);
 //    $(document).scroll(function () {
 //      $header = $header_height.height();
 //      // $headercover.css('padding-top', $header);
 //      $header_height.toggleClass('is-scrolling', $(this).scrollTop() > $header_height.height());
 //    });

    var $windowheight = $(window).height();
	var $header = $("header.fixed-top-not");
	var $header_height = $header.height();
	var $headercover = $("body");
	var $contentcover = $(".content");
	var $footer = $("footer");
	var $footerheight = $footer.height();
	var nh = $header_height + $footerheight;
	var nh2 = $windowheight - nh;
	    // $headercover.css('padding-top', $header_height);
	    $contentcover.css('min-height', nh2);
	    $(document).scroll(function () {
	        $header_height = $header.height();
	        // $headercover.css('padding-top', $header_height);
	        $header.toggleClass('is-scrolling', $(this).scrollTop() > $header.height());
	    });




	$( ".st_trending-now-display-area" ).each(function( index ) {
	    (function($set){
	        setInterval(function(){
	            var $cur1 = $set.find('.st-animated').removeClass('st-animated st-fadeInLeft d-inline-block');
	            var $next1 = $cur1.next().length?$cur1.next():$set.children().eq(0);
	            $cur1;
	            $next1.addClass('st-animated st-fadeInLeft d-inline-block');
	        },3000);
	    })($(this));
	});

	$st_owl = $('.owl-carousel.st-carousel-1');
	$st_owl.owlCarousel({
	    loop:true,
	    margin:15,
	    nav:true,
	    navText: ["<div><i class='far fa-angle-left'></i></div>","<div><i class='far fa-angle-right'></i></div"],
	    autoplay:true,
	    dots: false,
	    responsiveClass:true,
	    responsive:{
	        0:{items:2,},
	        768:{items:3},
	        992:{items:4},
	        1200:{items:5}
	    }
	});

	$st_owl = $('.owl-carousel.st-carousel-2');
	$st_owl.owlCarousel({
	    // loop:true,
	    loop:true,
	    margin:15,
	    nav:false,
	    autoplay:true,
	    dots: true,
	    dotsContainer: '.owl-custom-dot1',
	    responsiveClass:true,
	    responsive:{
	        0:{items:1},
	        768:{items:2},
	        992:{items:3},
	        1200:{items:3}
	    }
	});
	$st_owl = $('.owl-carousel.st-carousel-2b');
	$st_owl.owlCarousel({
	    // loop:true,
	    loop:true,
	    margin:15,
	    nav:false,
	    autoplay:true,
	    dots: true,
	    dotsContainer: '.owl-custom-dot2',
	    responsiveClass:true,
	    responsive:{
	        0:{items:1},
	        768:{items:2},
	        992:{items:3},
	        1200:{items:3}
	    }
	});
	$st_owl = $('.owl-carousel.st-carousel-2c');
	$st_owl.owlCarousel({
	    margin:15,
	    nav:false,
	    items:true,
	    autoWidth:true,
	    dots: false,
	    responsiveClass:true,
	});

	$st_owl = $('.owl-carousel.st-carousel-2d');
	$st_owl.owlCarousel({
	    margin:15,
	    nav:true,
	    items:2,
	    navText: ["<div><i class='far fa-angle-left fa-2x'></i></div>","<div><i class='far fa-angle-right fa-2x'></i></div"],
	    dots: false,
	    responsiveClass:true,
	    responsive:{
	        0:{items:2},
	        480:{items:3},
	        768:{items:4},
	        992:{items:5},
	        1200:{items:6}
	    }
	});
	var leftPos = $(".st-timeline");
	$(".st-timeline-hand .btn.tl-next").click(function () {
		leftPos.animate({ scrollLeft: ((leftPos.width() / 2)) + leftPos.scrollLeft(),})
	});
	$(".st-timeline-hand .btn.tl-prev").click(function () {
	   leftPos.animate({ scrollLeft: -((leftPos.width() / 2)) + leftPos.scrollLeft(),})
	});

    var radiocheck = $("input[id=radio-check]:checked").val();
	var radiotime = $("input[id=radio-times]:checked").val();
    if(radiocheck == 'check'){
        $('.wedding-website-collaspe-db').show();
    }else if(radiotime == 'times'){
        $('.wedding-website-collaspe-db').hide();
    }

	$(".wedding-website-db .st-website-button input[type='radio']").on('change', function(){
        radiocheck = $("input[id=radio-check]:checked").val();
    	radiotime = $("input[id=radio-times]:checked").val();
        if(radiocheck == 'check'){
            $('.wedding-website-collaspe-db').slideDown();
        }else if(radiotime == 'times'){
            $('.wedding-website-collaspe-db').slideUp();
        }
    });


	$('[data-toggle="tooltip"]').tooltip({html: true,});


    $(".datepicker").datepicker({dateFormat: "dd/MM/yy",
    	beforeShow: function(input, inst){
    		var input_width= $(this).width();
        	inst.dpDiv.css({minWidth : input_width +'px'});
    	}
	});

	$(".form-group.bs-form-db .form-control").focus(function(e){
        $(this).parent().addClass("input-group-focus");
    }).blur(function(e){
        $(this).parent().removeClass("input-group-focus");
    });

	$('select.st-selectcustom-ul').each(function(e) {
		$.widget("custom.stselectmenu", $.ui.selectmenu, {
	            _renderItem: function(ul, item) {
	                var li = $("<li>"),
	                wrapper = $("<div>",{text: item.label});
	                if(item.disabled){
	                    li.addClass("ui-state-disabled");
	                }
	                $("<span>",{style: item.element.attr("data-style"), "class":""  +item.element.attr("data-class") }).appendTo(wrapper);
	                return li.append(wrapper).appendTo(ul);
	            },
	        });
	        $(this).stselectmenu({
	            select: function(event, ui){
	                $("#" + this.id + "st-selected").attr("class","st-option-selected " + ui.item.element.data("class"));
	            },
	            create: function(event, ui){
	                var widget=$(this).stselectmenu("widget");
	                console.log($(this).children(":first").data("class"));

	                $span = $('<span id="' + this.id + 'st-selected" class="st-option-selected '  +$(this).children(":first").data("class") +'">').appendTo(widget);
	            },
	        })
	    $(this).stselectmenu().stselectmenu("menuWidget").addClass( "ui-menu-icons customicons" );
    });

    $( "#slider-range" ).slider({
    	range: true, min: 100000, max: 500000, values: [ 100000, 300000 ],step: 5000,
      	create: function() {
			var $max = $(this).slider('values', 1);
			var $min = $(this).slider('values', 0);
			var $num1 =  100000;
			$( "#input-price3tot" ).val($num1 + $max - $min);
			$( "#input-price3tot-text" ).text($num1 + $max - $min);
		},
		slide: function( event, ui ) {
        	var $max_min = ui.values[1] - ui.values[0];
        	var $num2 =  100000;
          	$( "#input-price3tot" ).val($max_min + $num2);
          	$( "#input-price3tot-text" ).text($max_min + $num2);
      	}
    });

    function spaceByhyphen(myStr){
      myStr=myStr.toLowerCase();
      myStr=myStr.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");
      myStr=myStr.replace(/\s+/g, "-");
      return myStr;
    }

	$(document).ready(function(){
	  $('.c-radio-ratings .c-radio-inline').on('mouseover', function(){
	      var onStar = parseInt($(this).find("input").attr('value'), 10);
	        $(this).parent().children('.c-radio-inline').each(function(e1){
	            if (e1 < onStar) {
	                $(this).addClass('hover');
	            }else {
	                $(this).removeClass('hover');
	            }
	    });
	  }).on('mouseout', function(){
	        $(this).parent().children('.c-radio-inline').each(function(e1){
	            $(this).removeClass('hover');
	        });
	  });
	  $('.c-radio-ratings .c-radio-inline').on('click', function(){
	      var onStar = parseInt($(this).find("input").attr('value'), 10);
	      var stars = $(this).parent().children('.c-radio-inline');
	      for (i = 0; i < stars.length; i++) {
	          $(stars[i]).removeClass('selected');
	      }
	      for (i = 0; i < onStar; i++) {
	          $(stars[i]).addClass('selected');
	      }
	  });
	});

	// ------------------------------------------------------- //
 	// Multi Level dropdowns
	// ------------------------------------------------------ //
	var dropdownmenui = 1;
	var dropdownmenuiclick = 1;
	$("ul.dropdown-menu>li>[data-toggle='dropdown']").click(function(event) {
		event.preventDefault();
		event.stopPropagation();
		dropdownmenui++;
		if (dropdownmenui > 1) {
			console.info(dropdownmenui);
			dropdownmenui = 1;
			$(this).parents('.dropdown-menu').find('.show').removeClass("show");
		}
		$(this).siblings().toggleClass("show");
		if (!$(this).next().hasClass('show')) {
		  $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
		}
		$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		  $('.dropdown-submenu>.show').removeClass("show");
		});
	});
  // ------------------------------------------------------- //
 	// sigup side1-8.
	// ------------------------------------------------------ //
  jQuery.validator.addMethod("notEqualTo",function(value, element, param) {
        var notEqual = true;
        value = $.trim(value);
        for (i = 0; i < param.length; i++) {
            if (value == $.trim($(param[i]).val())) { notEqual = false; }
        }
        return this.optional(element) || notEqual;
    },
    "You can not use same email address as your partner's email."
    );

                    $st_owl_steps = $('.owl-carousel.bs-carousel-steps');
                    $st_owl_steps.owlCarousel({
                        animateOut: 'bs-zoomOut',
                        animateIn: 'bs-zoomIn',
                        loop:false,
                        margin:0,
                        dots: true,
                        dotsData: true,
                        mouseDrag: false,
                        touchDrag: false,
                        freeDrag:true,
                        autoplay:false,
                        items:1,
                        itemClass: 'owl-item bs-owl-item-box',
                    });
                    $('.StepSkip').click(function() {
                        $st_owl_steps.trigger('next.owl.carousel');
                    });

                  var form2 = $('#steps-form');

                    $(".StepNextBtn").click(function(){
                        form2.validate({
                          // errorElement: 'span',
                          errorClass: 'help-block',
                          highlight: function(element, errorClass, validClass) {
                            $(element).closest('.form-group').addClass("has-error");
                          },
                          unhighlight: function(element, errorClass, validClass) {
                            $(element).closest('.form-group').removeClass("has-error");
                          },
                          // rules:{
                          //         phone: {
                          //           number: true,
                          //         },
                          //         guestcount: {
                          //           number: true,
                          //         },
                          //         partner_email: {
                          //           required:true,
                          //           email:true,
                          //               remote: {
                          //                   url: "/checkEmail",
                          //                   type: "post",
                          //                   dataType: 'json',
                          //                    data: {
                          //                      partner_email : function () {
                          //                           return $("input[name='partner_email']").val();
                          //                       }
                          //                   },
                          //                   dataFilter: function (data) {
                          //                       var json = JSON.parse(data);
                          //                       if (json.msg == "false") {
                          //                           return "\"" + "That email is taken" + "\"";
                          //                       } else {
                          //                           return 'true';
                          //                       }
                          //                   }
                          //               }
                          //         },
                          //         my_email: {
                          //           required:true,
                          //           notEqualTo: ['#partner-email'],
                          //           email:true,
                          //
                          //             remote: {
                          //                   url: "/checkEmail",
                          //                   type: "post",
                          //                   dataType: 'json',
                          //                    data: {
                          //                      partner_email : function () {
                          //                           return $("input[name='my_email']").val();
                          //                       }
                          //                   },
                          //                   dataFilter: function (data) {
                          //                       var json = JSON.parse(data);
                          //                       if (json.msg == "false") {
                          //                           return "\"" + "That email is taken" + "\"";
                          //                       } else {
                          //                           return 'true';
                          //                       }
                          //                   }
                          //               }
                          //         },
                          //         confirm_password: {
                          //           equalTo: "#pwd",
                          //       },
                          //         password: {
                          //           minlength: 4,
                          //       },
                          //   },
                          //    messages: {
                          //        name: "Name can not be blank ",
                          //        email: {
                          //            required: "Email can not be blank",
                          //            email: "Your email address must be in the format of name@domain.com",
                          //            remote:"Email address taken.."
                          //        },
                          //        phone: {
                          //            required: "Number can not be blank",
                          //            number: "Please enter a number"
                          //        },
                          //
                          //    },
                        });
                        if (form2.valid() === true){
                          if ($('.step1').is(":visible")){
                            $st_owl_steps.trigger('next.owl.carousel');
                          }else if ($('.step3').is(":visible")){
                            $st_owl_steps.trigger('next.owl.carousel');
                          }else{
                            $st_owl_steps.trigger('next.owl.carousel');
                          }
                        }
                    });
                    $('.StepPrevBtn').click(function(){
                        if($('.step2').is(":visible")){
                            $st_owl_steps.trigger('prev.owl.carousel', [300]);
                        }else{
                            $st_owl_steps.trigger('prev.owl.carousel', [300]);
                        }
                    });

                    $('#steps-form .step8 button.btn').click(function() {
                        $st_owl_steps.trigger('next.owl.carousel');
                    });
                    $('#confirmed').click(function(){
                        $("#signup-popup").modal('hide');
                    });



                    var VenueBookedfunction=function(){
                            var isChecked = $("input[class='VenueBooked']:checked").val();
                             if(isChecked==1){
                                $('#venuename').attr('required',true);
                                $('#areaofpk').removeAttr('required');
                             }
                             else{
                                $('#areaofpk').attr('required',true);
                                $('#venuename').removeAttr('required');
                             }
                               var isChecked = $("input[id='doitlate']:checked").val();
                               if(isChecked=="on"){
                                $('#venuename').removeAttr('required');
                                $('#areaofpk').removeAttr('required');
                               }

                    }

                    $('.VenueBooked').on('change',VenueBookedfunction);

                         $('#doitlate').change(function(){

                            var isChecked = $("input[id='doitlate']:checked").val();
                           if(isChecked=="on"){
                            $('#venuename').removeAttr('required');
                            $('#areaofpk').removeAttr('required');
                           }
                           else{
                            VenueBookedfunction();
                           }
                         });


                    $('#know-yet').change(function(){

                        var isChecked = $("input[id='know-yet']:checked").val();
                            if(isChecked=="on"){
                                $('.guestcount').removeAttr('required');
                            }
                            else{
                                $('.guestcount').attr('required',true);
                            }
                    });


                    $('.tabweddingyear').click(function(){

                        $(".step5-radiobox1").addClass('show active');
                        $(".step5-radiobox2").removeClass('show active');
                        $(".step5-radiobox3").removeClass('show active');
                    });


                    $('.tabweddingmonth').click(function(){

                        $(".step5-radiobox1").removeClass('show active');
                        $(".step5-radiobox2").addClass('show active');
                        $(".step5-radiobox3").removeClass('show active');
                    });


                    $('.tabweddingday').click(function(){

                        $(".step5-radiobox1").removeClass('show active');
                        $(".step5-radiobox2").removeClass('show active');
                        $(".step5-radiobox3").addClass('show active');
                    });

                    // $(".datepicker-show").datepicker({ dateFormat: "dd" });
                    // $('#step5-date').change(function(){
                    //     $('.datepicker-show').datepicker('setDate', $(this).val());
                    // });
                    // $('.datepicker-show').change(function(){
                    //     $('#step5-date').attr('value',$(this).val());
                    //      $('.selectweek').prop('checked', false);
                    //     $('.selectweek').removeAttr('required');
                    //     $(".weeklabel").removeClass('active');
                    // });


                    $('.otherweddingyear').change(function(){

                        val=$('.otherweddingyear').val();

                        if(val==""){
                         $('.weddingyear').attr('required',true);
                        }
                        else{

                         $('.weddingyear').removeAttr('required');
                         $('.weddingyear').prop('checked', false);
                         $(".yearlabel").removeClass('active');

                         // var a = $('.tabweddingyear').parent('a');
                         // var a2 = $('.tabweddingmonth').parent('a');
                         var a = $('.tabweddingyear');
                         var a2 = $('.tabweddingmonth');
                         a.removeClass('active');
                         a2.addClass('active');
                         a2.attr('disabled',false);
                         a2.css('cursor','pointer');
                         $(".step5-radiobox1").removeClass('show active');
                         $(".step5-radiobox2").addClass('show active');
                        }
                    });

                    $('.weddingyear').change(function(){
                        $(".otherweddingyear option").prop("selected", false);
                         // var a = $('.tabweddingyear').parent('a');
                         // var a2 = $('.tabweddingmonth').parent('a');
                         var a = $('.tabweddingyear');
                         var a2 = $('.tabweddingmonth');
                         a.removeClass('active');
                         a2.addClass('active');
                         a2.attr('disabled',false);
                         a2.css('cursor','pointer');
                         $(".step5-radiobox1").removeClass('show active');
                         $(".step5-radiobox2").addClass('show active');
                    });


                    $('#undecided_year').click(function(){
                      $('.weddingyear').removeAttr('required');
                    });


                    $('#undecided_month').click(function(){
                      $('.selectseason').removeAttr('required');
                    });



                    $('.selectseason').change(function(){
                        $('.selectmonth').prop('checked', false);
                        $(".monthlabel").removeClass('active');

                         // var a = $('.tabweddingmonth').parent('a');
                         // var a2 = $('.tabweddingday').parent('a');
                         var a = $('.tabweddingmonth');
                         var a2 = $('.tabweddingday');
                         a2.attr('disabled',false);
                         a2.css('cursor','pointer');
                         a.removeClass('active');
                         a2.addClass('active');
                         $(".step5-radiobox2").removeClass('show active');
                         $(".step5-radiobox3").addClass('show active');

                    });

                    $('.selectmonth').change(function(){
                        $('.selectseason').prop('checked', false);
                        $('.selectseason').removeAttr('required');
                        $(".seasonlabel").removeClass('active');

                         // var a = $('.tabweddingmonth').parent('a');
                         // var a2 = $('.tabweddingday').parent('a');

                         var a = $('.tabweddingmonth');
                         var a2 = $('.tabweddingday');
                         a.removeClass('active');
                         a2.addClass('active');
                         a2.attr('disabled',false);
                         a2.css('cursor','pointer');
                         $(".step5-radiobox2").removeClass('show active');
                         $(".step5-radiobox3").addClass('show active');

                    });



                    $('.selectweek').change(function(){
                        $('.datepicker-show').prop('checked', false);
                    });


                    $('.undecided_budget').change(function(){
                        $('.budget').removeAttr('required');
                    });

                    $('.wedding-date-setting-btn').on('click', function(event) {
                        $('#setting-date-popup').modal(open);
                    });

                    // $("#signup-popup").modal({
                    //     backdrop: 'static',
                    //     keyboard: false
                    // });

                    var path_l = "/search_location";
                    var locations = $('.areaofp').typeahead({
                      source: function (query, process)
                      {
                        return $.get(path_l, {query: query}, function(locations){
                          return process(locations);
                        });
                      },
                      displayText: function (location)
                      {
                        return location['location_name']+', '+location['country_name'];
                      }
                    });
                    $(".areaofp").change(function()
                    {
                        var location_id = $(".areaofp").typeahead("getActive");
                        if(location_id){
                          $(".location_id_searched").val('');
                          $(".location_name_searched").val('');
                          $(".location_id_searched").val(location_id.location_id);
                          $(".location_name_searched").val(location_id.location_name);
                        }
                    });

                    var path_b = "/search_business";
                    var businesses = $('.areaofb').typeahead({
                      source: function (query, process)
                      {
                        return $.get(path_b, {query: query}, function(businesses){
                          return process(businesses);
                        });
                      },
                      displayText: function (business)
                      {
                        return business.business_name + ", " +business.category_name+", "+business.location_name;
                      }
                    });
                    $(".areaofb").change(function()
                    {
                        var business_id = $(".areaofb").typeahead("getActive");
                        if(business_id){
                          $(".business_id_searched").val(business_id.business_id);
                          $(".business_name_searched").val(business_id.business_name);
                        }
                    });

                    var selected_cat = [];
                    $(".category_search_form").change(function()
                    {
                      selected_c = $(this).children("option:selected").text();
                      selected_c_id = $(this).children("option:selected").val();
                      selected_cat.push(selected_c);
                      selected_cat.push(selected_c_id);
                      $(".category_name_searched").val(selected_c);
                    });

                    $('.sub_header_search_form').on('submit', function(event){
                  		event.preventDefault();
                      var selected_category = "";
                      var selected_cat_id = "";
                      if(selected_cat.length == 0){
                        selected_category = $(".category_search_form option:selected").text();
                        selected_cat_id = $(".category_search_form option:selected").val();
                      }else {
                        showCat = selected_cat.filter(Boolean);
                        selected_category = showCat[0];
                        selected_cat_id = showCat[1];
                      }

                      var selected_location = $(".location_name_searched").val();
                      if(selected_location == ""){
                        selected_location = "UK"
                      }
                      var selected_business = $(".business_name_searched").val();
                      if(selected_business == ""){
                        selected_business = "venue-name"
                      }

                      var sel_cat = spaceByhyphen(selected_category);
                      var sel_loc = spaceByhyphen(selected_location);
                      var sel_bus = spaceByhyphen(selected_business);



                      window.location.href="/search/weeding-"+sel_cat+"/"+sel_loc;
                    });

                    $('input:radio[name="selectyear"]').on('change', function() {
                      var d_year = $(this).val();
                      $('.append_date').text('');
                      $('.append_date').append(d_year);
                    });

                    $('.otherweddingyear').on('change', function() {
                      var d_year = $(this).val();
                      $('.append_date').text('');
                      $('.append_date').append(d_year);
                    });

                    $('input:radio[name="selectseason"]').on('change', function() {
                      $('.date_selector').hide();
                      var d_season = $(this).val();

                      var checkBoxClassesYear = [];
                      y_d = $('select[name="otheryear"] option').filter(':selected').val();
                      checkBoxClassesYear.push(y_d);
                      y_d = $('input:radio[name="selectyear"]:checked').val();
                      checkBoxClassesYear.push(y_d);

                      showYear = checkBoxClassesYear.filter(Boolean);
                      new_yd = showYear[0];

                      $('.append_date').text('');
                      $('.append_date').append(new_yd+' '+d_season+' ');

                    });

                    $('input:radio[name="selectmonth"]').on('change', function() {
                      $('.date_selector').show();
                      var d_month = $(this).val();

                      var checkBoxClassesYear = [];
                      y_d = $('select[name="otheryear"] option').filter(':selected').val();
                      checkBoxClassesYear.push(y_d);
                      y_d = $('input:radio[name="selectyear"]:checked').val();
                      checkBoxClassesYear.push(y_d);

                      showYear = checkBoxClassesYear.filter(Boolean);
                      new_yd = showYear[0];

                      $('.append_date').text('');
                      $('.append_date').append(new_yd+' '+d_month+' ');

                      var months = {'January' : '1', 'February' : '2', 'March' : '3', 'April' : '4', 'May' : '5', 'June' : '6', 'July' : '7', 'August' : '8', 'September' : '9', 'October' : '10', 'November' : '11', 'December' : '12'};
                      $.each( months, function( key, value ) {
                        if(key == d_month){
                          var startDate = new Date(new_yd, value-1);
                          $(".datepicker-show").datepicker("setDate", startDate);
                        }
                      });
                    });

                    $('input:radio[name="selectweek"]').on('change', function() {
                      var d_day = $(this).val();
                      var checkBoxClassesYear = [];
                      y_d = $('select[name="otheryear"] option').filter(':selected').val();
                      checkBoxClassesYear.push(y_d);
                      y_d = $('input:radio[name="selectyear"]:checked').val();
                      checkBoxClassesYear.push(y_d);

                      showYear = checkBoxClassesYear.filter(Boolean);
                      new_yd = showYear[0];

                      var checkBoxClassesMonth = [];
                      m_d = $('input:radio[name="selectseason"]:checked').val();
                      checkBoxClassesMonth.push(m_d);
                      m_d = $('input:radio[name="selectmonth"]:checked').val();
                      checkBoxClassesMonth.push(m_d);

                      showMonth = checkBoxClassesMonth.filter(Boolean);
                      new_md = showMonth[0];

                      $('.append_date').text('');
                      $('.append_date').append('A '+d_day+' in '+new_md+' '+new_yd);
                      $('.wedding-date-setting-btn').val('');
                      $('.wedding-date-setting-btn').val('A '+d_day+' in '+new_md+' '+new_yd);
                      $('.weeding_date').val('');
                      $('.weeding_date').val('A '+d_day+' in '+new_md+' '+new_yd);
                      $('.weeding_year').val(new_yd);
                      $('.weeding_month_season').val(new_md);
                      $('.weeding_day_date').val(d_day);
                    });

                    $(".datepicker-show").datepicker({ dateFormat: "dd" });
                    $('#step5-date').change(function(){
                        $('.datepicker-show').datepicker('setDate', $(this).val());
                    });
                    $('.datepicker-show').change(function(){
                        $('#step5-date').attr('value',$(this).val());
                         $('.selectweek').prop('checked', false);
                        $('.selectweek').removeAttr('required');
                        $(".weeklabel").removeClass('active');
                    });

                    $('.datepicker-show').on('change', function() {

                      var d_day = $(this).val();
                      var checkBoxClassesYear = [];
                      y_d = $('select[name="otheryear"] option').filter(':selected').val();
                      checkBoxClassesYear.push(y_d);
                      y_d = $('input:radio[name="selectyear"]:checked').val();
                      checkBoxClassesYear.push(y_d);

                      showYear = checkBoxClassesYear.filter(Boolean);
                      new_yd = showYear[0];

                      var checkBoxClassesMonth = [];
                      m_d = $('input:radio[name="selectseason"]:checked').val();
                      checkBoxClassesMonth.push(m_d);
                      m_d = $('input:radio[name="selectmonth"]:checked').val();
                      checkBoxClassesMonth.push(m_d);

                      showMonth = checkBoxClassesMonth.filter(Boolean);
                      new_md = showMonth[0];

                      $('.append_date').text('');
                      $('.append_date').append(d_day+' '+new_md+' '+new_yd);
                      $('.wedding-date-setting-btn').val('');
                      $('.wedding-date-setting-btn').val(d_day+' '+new_md+' '+new_yd);
                      $('.weeding_date').val('');
                      $('.weeding_date').val(d_day+' '+new_md+' '+new_yd);
                      $('.weeding_year').val(new_yd);
                      $('.weeding_month_season').val(new_md);
                      $('.weeding_day_date').val(d_day);
                    });

                    // $('#steps-form').on('submit', function(event){
                  	// 	event.preventDefault();
                    //   $.ajax({
                    //     url:"{{ url('/complete_profile') }}",
                    //     method:"POST",
                  	// 		data:new FormData(this),
                    //     dataType:"JSON",
                  	// 		contentType:false,
                  	// 		cache:false,
                  	// 		processData:false,
                  	// 		success:function(data){
                  	// 			$('#append_errors ul').text('');
                  	// 			$('#append_success ul').text('');
                    //       if(data.errors)
                    //       {
                  	// 				$.each(data.errors, function(i, error){
                  	// 					$('#append_errors').show();
                    //           $('#append_errors ul').append("<li>" + data.errors[i] + "</li>");
                    //       	});
                    //       }else {
                  	// 				$('#append_errors').hide();
                  	// 				$('#append_success').show();
                  	// 				$('#congrats').append('Congratulations, your profile is updated');
                    //       }
                    //     },
                    //   });
                    // });


                    $('#update-date-ajax').on('submit', function(event){
                  		event.preventDefault();
                      $.ajax({
                        url:"/update_date_ajax",
                        method:"POST",
                  			data:new FormData(this),
                        dataType:"JSON",
                  			contentType:false,
                  			cache:false,
                  			processData:false,
                  			success:function(data){
                          if(data.weeding_date == "" || data.weeding_days_remaining == ""){
                            $('.weeding_date_ajax').text('');
                            $('.weeding_date_ajax').text('No weeding date yet ');
                            $('.weeding_days_count_ajax').text('');
                          }else {
                            $('.weeding_date_ajax').text('');
                            $('.weeding_date_ajax').text(data.weeding_date);
                            $('.weeding_days_count_ajax').text('');
                            $('.weeding_days_count_ajax').text(data.weeding_days_remaining+' days to go!');
                          }
                          $('#setting-date-popup').modal('hide');
                          $('#modalEditSetting').modal('show');
                          $('body').addClass('modal-open2');
                          // location.reload();
                        },
                      });
                    });

});
