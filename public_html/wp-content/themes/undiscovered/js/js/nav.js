var fadeStart=$(window).height()/3 // 100px scroll or less will equiv to 1 opacity
  ,fadeUntil=$(window).height() // 200px scroll or more will equiv to 0 opacity
  ,fading = $('.st-home-unit')
;

$ (function () {
  $(window).bind('scroll', function(){
      var offset = $(document).scrollTop()
          ,opacity=0
          ,opacity2=1
      ;
      if( offset<=fadeStart ){
          opacity=1;
          opacity2=0;
      }else if( offset<=fadeUntil ){
          opacity=1-offset/fadeUntil;
          opacity2=offset/fadeUntil;
      }
      fading.css({'opacity': opacity});

      if (offset >= 120) {
        $('.st-navbar').addClass("st-navbar-mini");
      } else if (offset <= 119) {
        $('.st-navbar').removeClass("st-navbar-mini");
      }
  });

});
