
  (function ($) {
  
  "use strict";

    // NAVBAR
    $('.navbar-nav .nav-link').click(function(){
        $(".navbar-collapse").collapse('hide');
    });

    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();

        if (scroll >= 50) {
            $(".navbar").addClass("sticky-nav");
        } else {
            $(".navbar").removeClass("sticky-nav");
        }
    });

    // BACKSTRETCH SLIDESHOW
    $('#section_1').backstretch([
      "images/slide/9607102311_f0f6370107_o.jpg", 
      "images/slide/food-donations-box-isolated-white-background-31427220.jpg",
      "images/slide/surface-1x5jnhtlp3Y-unsplash.jpg",
      "images/slide/volunteer-work-young-happy-volunteers-medical-masks-holding-food-donations-box-woman-showing-thumb-up-copy-space-package-236228966.jpg"
    ],  {duration: 2000, fade: 750});
    
  })(window.jQuery);


