$ (function () {

  $('.clients-carousel').owlCarousel({
    items: 4,
    autoPlay: true,
    pagination: false
  });


  $(".testimonials-carousel ul").owlCarousel({
        items: 1,
        navigation: false,
        pagination: true,
        singleItem:true,
        autoPlay: true,
        navigationText: ['<i class="ct-etp etp-arrow-left7"></i>', '<i class="ct-etp etp-arrow-right8"></i>'],
        transitionStyle: "backSlide"
    });


});
