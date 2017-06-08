$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();

    // Carousel on home page settings
    $('#owl-carousel-home').owlCarousel({
        loop:true,
        margin:40,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            900:{
                items:3
            },
            1440:{
                items:4
            }
        }
    });
    // End of carousel home page settings

    // Carousel on campsite page settings
    $('#owl-carousel-campsite').owlCarousel({
        loop:true,
        margin:40,
        dots: true,
        addClassActive: true,
        items: 1
    });

    $(document).bind('keyup', function(e) {
        if(e.which == 39){
            $('.carousel').carousel('next');
        }
        else if(e.which == 37){
            $('.carousel').carousel('prev');
        }
    });

    // End of carousel campsite page settings

});