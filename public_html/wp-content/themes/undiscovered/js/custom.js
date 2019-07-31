(function($) {

	$(document).ready(function() {
		 // Focuses on first input textbox after it loads the window.
		 $('[data-toggle="modal"]').click(function(e) {
		  e.preventDefault();
		  var product_id = $(this).attr('id');
		  $.post('wp-admin/admin-ajax.php', {action:'my_action',product_id:product_id} , function(data){
		  		$('#load-modal-content').html(data);
		  });
		 });
	});


  $(document).ready(function() {
      $("[data-toggle='toggle']").click(function() {
        var selector = $(this).data("target");
        $(selector).toggleClass('in');
      });
  });
	
  $(document).ready(function() {
    $("#menu-item-123,#menu-item-158").click(function() {
      $('html, body').animate({
          scrollTop: $("#buzz").offset().top
      }, 1000);
    });
    $("#menu-item-124,#menu-item-160").click(function() {
      $('html, body').animate({
          scrollTop: $("#pigs").offset().top
      }, 1000);
    });
    $("#menu-item-125, #menu-item-159").click(function() {
      $('html, body').animate({
          scrollTop: $("#poultry").offset().top
      }, 1000);
    });
    $("#menu-item-126 , #menu-item-161").click(function() {
      $('html, body').animate({
          scrollTop: $("#sheep").offset().top
      }, 1000);
    });
    $("#menu-item-127 , #menu-item-162").click(function() {
      $('html, body').animate({
          scrollTop: $("#vegetables").offset().top
      }, 1000);
    });
  });

  $(document).ready(function(){
     $('#menu-item-1530 > a').click(function(e){
        e.preventDefault();

     });
  });

//animate.css
// $(window).scroll(function() {
//   $(".animation").each( function(i) {
//       if( $(window).scrollTop() > $(this).offset().top - 500) {
//               setTimeout(function(){
//                 $(this).addClass('os-animation animated fadeInUp').css('opacity',1);
//               }, 1000);
//       } else {
//           $(this).css('opacity',0);
//       }
//   }); 
// });
$(document).ready(function() {
    var template_url = $('#directory-url').attr('data');
    $('#owl-slidersheep').owlCarousel({
            loop:true,
            autoplay :20000,
                    autoplaySpeed:3000,
                    navSpeed:3000,  
            navSpeed:3000,
            autoplayHoverPause:true, 
            pagination: false,
            margin:-1,
            nav:true,
            navText: ["<img src='"+template_url+"/img/img-right.png' class='nav-prev-bot'>","<img src='"+template_url+"/img/img-right.png' class='nav-next-bot'>"],
         
            responsive:{
                0:{
                    items:1,
                    nav:false,
                }, 
                600:{
                    items:1,
                    nav:false,
                },
                1024:{
                    items:1,
                    nav:true,
                    loop:true,
                    autoplayTimeout:8000 
                    
                },
                1366:{
                    items:1,
                    nav:true,
                    loop:true,
                    autoplayTimeout:8000 
                    
                }
            }
        });
  });
$(document).ready(function() {
     $('.col-md-2.logo-container , #menu-menu-1').addClass('os-animation animated fadeInUp');
     $('.banner-effect').css('opacity',0);
     setTimeout(function(){
      $('.banner-effect').addClass('os-animation animated fadeInUp').css('opacity',1);
     }, 500);

     $('.product-remove > .remove').click(function(){
        jQuery.post('wp-admin/admin-ajax.php', {action:'reload_cart'} , function(data){
          $('.count-cart').html('('+data+')');
          alert(data);
      });
     });
});

})( jQuery );
	function addCart(product_id){
      var host = "http://"+window.location.hostname;
		  jQuery.post(host+'/wp-admin/admin-ajax.php', {action:'addCart',product_id:product_id} , function(data){
          jQuery('.count-cart').html('('+data+')');
		  		alert("Successfully added to Cart");
		  });
	}

(function($) {
  /**
   * Copyright 2012, Digital Fusion
   * Licensed under the MIT license.
   * http://teamdf.com/jquery-plugins/license/
   *
   * @author Sam Sehnert
   * @desc A small plugin that checks whether elements are within
   *     the user visible viewport of a web browser.
   *     only accounts for vertical position, not horizontal.
   */

  $.fn.visible = function(partial) {
    
      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;
    
    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };
    
  $(window).scroll(function(event) {
  
  $(".featured-product-content > .col-md-3").each(function(i, el) {
    var el = $(el);
    el.css('opacity',0);
    if (el.visible(true)) {
      setTimeout(function(){
      el.addClass("os-animation animated fadeInUp").css('opacity',1); 
       }, 500 * (i + 1));
    } 
  });

  $(".animation").each(function(i, el) {
    var el = $(el);
    el.css('opacity',0);
    if (el.visible(true)) {
      setTimeout(function(){
      el.addClass("os-animation animated fadeInUp").css('opacity',1); 
       }, 500 * (i + 1));
    } 
  });

  $("#buzz .align-box").each(function(i, el) {
    var el = $(el);
    el.css('opacity',0);
    if (el.visible(true)) {
      setTimeout(function(){
      el.addClass("os-animation animated fadeInUp").css('opacity',1); 
       }, 500 * (i + 1));
    } 
  });

  $("#poultry .align-box").each(function(i, el) {
    var el = $(el);
    el.css('opacity',0);
    if (el.visible(true)) {
      setTimeout(function(){
      el.addClass("os-animation animated fadeInUp").css('opacity',1); 
       }, 500 * (i + 1));
    } 
  });

  $("#pigs .align-box").each(function(i, el) {
    var el = $(el);
    el.css('opacity',0);
    if (el.visible(true)) {
      setTimeout(function(){
      el.addClass("os-animation animated fadeInUp").css('opacity',1); 
       }, 500 * (i + 1));
    } 
  });

  $("#sheep .align-box").each(function(i, el) {
    var el = $(el);
    el.css('opacity',0);
    if (el.visible(true)) {
      setTimeout(function(){
      el.addClass("os-animation animated fadeInUp").css('opacity',1); 
       }, 500 * (i + 1));
    } 
  });

  $("#vegetables .align-box").each(function(i, el) {
    var el = $(el);
    el.css('opacity',0);
    if (el.visible(true)) {
      setTimeout(function(){
      el.addClass("os-animation animated fadeInUp").css('opacity',1); 
       }, 500 * (i + 1));
    } 
  });

  $(".blog-container").each(function(i, el) {
    var el = $(el);
    el.css('opacity',0);
    if (el.visible(true)) {
      el.addClass("os-animation animated fadeInUp").css('opacity',1); 
    } 
  });

  });

})(jQuery);


