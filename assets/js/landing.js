(function ($) {
    "use strict";
$('.demo-imgs .hover-link .html').on('click', function () {
    // debugger
    var type = $(this).attr("data-attr");
    var boxed = "";
    console.log(type)
    if ($(".page-wrapper").hasClass("landing-page")) {
        boxed = "landing-page";
    }
    

    window.open('http://admin.pixelstrap.com/viho/theme/index.html', '_blank');
});


$('.layout-slider').owlCarousel({       
    items:4,
    loop:true,
    margin: 30,
    nav: false,
    autoplay: false,
    autoplayTimeout:5000,
    autoplayHoverPause:false,
     responsive: {
         320:{
            items:1
        },
        600:{
            items:2
         },
        1366:{
            items:3
        },

        1660: {
            items:4
         }
        
    }
});
    $('.prooduct-details-box .close').on('click', function (e) {
        var tets = $(this).parent().parent().parent().parent().addClass('d-none');
        console.log(tets);
    })
   })(jQuery);