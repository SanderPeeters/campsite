@extends('layouts.app')

@section('title', 'Campsite - Offer a Campsite')
@section('description', 'Have a nice campsite with or without a meadow to offer? Join Campsite now!')

@section('content')
    <section id="section-my-campsite" class="main vh-min-90">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel m-t-120 no-border-radius no-border">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#details" target="_self">{{ trans('campsite.details') }}</a></li>
                                <li><a data-toggle="tab" href="#menu1" target="_self">{{ trans('reservation.title') }}</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="details" class="tab-pane fade in active">
                                    @include('campsite.offer.tabs.tab-details')
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    @include('campsite.offer.tabs.tab-reservations')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        var campsite = {!! json_encode($campsite) !!};
        var currentcampsite = new google.maps.LatLng(campsite.latitude, campsite.longitude);
        var iconmain = {
            url: '/assets/img/icons/map-marker-green.svg', // url
            scaledSize: new google.maps.Size(50, 50) // scaled size
        };

        var styledMapType = new google.maps.StyledMapType(
            [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#444444"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#134352"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ],
            {name: 'Map'});

        function initMap(){
            map = new google.maps.Map(document.getElementById('campsitemap'), {
                center: currentcampsite,
                zoom: 14,
                mapTypeControl: false,
                streetViewControl: false,
                scrollwheel: false
            });
        }
        initMap();

        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');

        function createCampsiteMarker() {
            var marker = new google.maps.Marker({
                map: map,
                position: currentcampsite,
                icon: iconmain
            });
        }
        createCampsiteMarker();

    </script>
@endsection