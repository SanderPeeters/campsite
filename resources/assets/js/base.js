// Language settings

switch(currentlanguage) {
    case 'en':
        var campsiteinventoryurl = "/en/campsite/offers";
        var campsitesearchurl = "/en/campsite/search";
        var provincesurl = "/en/provinces";
        var statesurl = "/en/states";
        var searchOnProvinceUrl = '/en/search-campsite/';
        var searchpage = '/en/search-campsite';
        var savecampsiteurl = '/en/campsite-offer/store';
        var imagesaveurl = '/en/campsite-offer/images/store';
        var movementsurl = '/en/movements';
        var savingurl = '/en/save-campsite';
        var offerurl = '/en/offer-campsite';
        break;
    case 'nl':
        var campsiteinventoryurl = "/nl/campsite/aanbiedingen";
        var campsitesearchurl = "/nl/campsite/zoek";
        var provincesurl = "/nl/provincies";
        var statesurl = "/nl/gewesten";
        var searchOnProvinceUrl = '/nl/campsite-zoeken/';
        var searchpage = '/nl/campsite-zoeken';
        var savecampsiteurl = '/nl/campsite-offer/opslaan';
        var imagesaveurl = '/nl/campsite-offer/afbeeldingen/opslaan';
        var movementsurl = '/nl/jeugdbewegingen';
        var savingurl = '/nl/campsite-opslaan';
        var offerurl = '/nl/campsite-aanbieden';
        break;
    case 'fr':
        var campsiteinventoryurl = "/fr/campsite/offres";
        var campsitesearchurl = "/fr/campsite/cherche";
        var provincesurl = "/fr/provinces";
        var statesurl = "/fr/régions";
        var searchOnProvinceUrl = '/fr/cherche-campsite/';
        var searchpage = '/fr/cherche-campsite';
        var savecampsiteurl = '/fr/campsite-offer/store';
        var imagesaveurl = '/fr/offre-campsite/images/sauve';
        var movementsurl = '/fr/movements-de-jeunesse';
        var savingurl = '/fr/sauve-campsite';
        var offerurl = '/fr/offre-campsite';
        break;
    default:
        var campsiteinventoryurl = "/en/campsite/offers";
        var campsitesearchurl = "/en/campsite/search";
        var provincesurl = "/en/provinces";
        var statesurl = "/en/states";
        var searchOnProvinceUrl = '/en/search-campsite/';
        var searchpage = '/en/search-campsite';
        var savecampsiteurl = '/en/campsite-offer/store';
        var imagesaveurl = '/en/campsite-offer/images/store';
        var movementsurl = '/en/movements';
        var savingurl = '/en/save-campsite';
}

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