$(document).ready(function(){

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
            }
        }
    });
    // End of carousel home page settings

});