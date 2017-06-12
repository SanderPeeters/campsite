@extends('layouts.app')


<title>Campsite - {{ $campsite->campsite_name }}</title>
@section('description', 'Looking for a Campsite for your youth movement?')

@section('content')

    <section id="show-campsite-section" class="main vh-min-90" ng-controller="ReservationCtrl as reservation">
        <div class="container">
            <div class="panel m-t-120 m-b-0 no-border-radius no-border" >
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-7 col-xs-12">
                            <h3 class="color-light-grey m-t-0 m-b-0">{{ trans('states.'.$campsite->state->id) }} - {{ trans('provinces.'.$campsite->province->id) }} - {{ $campsite->city }}</h3>
                            <h1 class="color-primary m-t-5">{{ $campsite->campsite_name }}</h1>
                            {!! $campsite->description !!}
                            <p class="color-light-grey">
                                <strong>Location</strong> <br>
                                {{ $campsite->street }}, {{ $campsite->zipcode }} {{ $campsite->city }}
                            </p>
                            <p>
                                <a href="{{ $campsite->website }}" target="_blank" class="color-light-grey">
                                    <strong>{{ trans('campsite.visitwebsite') }}</strong> <br>
                                </a>
                            </p>
                        </div>
                        <div class="col-md-5 col-xs-12">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group" ng-init="reservation.state.saved = {{$saved}}" ng-cloak>
                                        <button class="btn btn-secundary-opposite btn-block" type="button" ng-model="reservation.state.saved" ng-disabled="{{ Auth::guest() }}" ng-click="reservation.events.statusSaveCampsite({{$campsite->id}})">
                                            @if (Auth::guest())
                                                {{ trans('campsite.buttons.save') }}
                                            @else
                                                <div ng-if="!reservation.state.saved">
                                                    {{ trans('campsite.buttons.save') }}
                                                </div>
                                                <div ng-if="reservation.state.saved">
                                                    {{ trans('campsite.buttons.unsave') }}
                                                </div>
                                            @endif
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <a href="{{ route('reservation.showform', ['id' => $campsite->id])}}" target="_self">
                                            <button class="btn btn-secundary btn-block" type="button">
                                                {{ trans('campsite.buttons.reserve') }}
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- owl-carousel -->
                                    <div id="owl-carousel-campsite" class="owl-carousel owl-theme">
                                        @foreach ($campsite->campimages as $value => $image)
                                            <div class="item overlay">
                                                <a href="#gallery" data-slide-to="{{$value}}" target="_self">
                                                    <img src="/img/campsites/{{ $image->filename }}" data-toggle="modal" data-target="#myModal"/>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- /owl-carousel -->
                                </div>
                                <div class="col-sm-12 m-t-40">
                                    <a href="{{ route('search-campsite') }}" target="_self">
                                        <button class="btn btn-secundary btn-block">
                                            {{ trans('campsite.buttons.goback') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs m-t-20">
                        <li class="active"><a data-toggle="tab" href="#location" target="_self"> {{ trans('campsite.location') }} </a></li>
                        <li><a data-toggle="tab" href="#facilities" target="_self"> {{ trans('campsite.facilities') }} </a></li>
                        <li><a data-toggle="tab" href="#reviews" target="_self">{{ trans('campsite.reviews') }} </a></li>
                        <li><a data-toggle="tab" href="#reservations" target="_self">{{ trans('campsite.calendar') }}</a></li>
                    </ul>

                    <div class="tab-content">

                        <div id="location" class="tab-pane fade in active">
                            @include('campsite.display.partials.tab-map')
                        </div>

                        <div id="facilities" class="tab-pane fade in">
                            @include('campsite.display.partials.tab-facilities')
                        </div>

                        <div id="reviews" class="tab-pane fade">
                            @include('campsite.display.partials.tab-reviews')
                        </div>

                        <div id="reservations" class="tab-pane fade">
                            @include('campsite.display.partials.tab-reservation')
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- modalGallery -->
    <div class="dark-modal">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
                    <div class="modal-body">

                        <div id="gallery" class="carousel slide" data-interval="false">
                            <div class="carousel-inner">
                                @foreach($campsite->campimages as $value => $image)
                                    @if($loop->first)
                                        <div class="item active">
                                            <img src="/img/campsites/{{ $image->filename }}" alt="item{{$value}}">
                                        </div>
                                    @else
                                        <div class="item">
                                            <img src="/img/campsites/{{ $image->filename }}" alt="item{{$value}}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="left carousel-control" href="#gallery" role="button" data-slide="prev"><span class="fa fa-arrow-left"></span></a>
                            <a class="right carousel-control" href="#gallery" role="button" data-slide="next"><span class="fa fa-arrow-right"></span></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modalGallery -->

@endsection

@section('scripts')
    <script>
        var map;
        var infowindow;
        var campsite = {!! json_encode($campsite) !!};
        var storetype = 'grocery_or_supermarket';
        var parktype = 'park';
        var healthtype = 'doctor';

        var iconmain = {
            url: '/assets/img/icons/map-marker-green.svg', // url
            scaledSize: new google.maps.Size(50, 50) // scaled size
        };
        var iconstores = {
            url: '/assets/img/icons/map-marker-grey.svg', // url
            scaledSize: new google.maps.Size(30, 30) // scaled size
        };
        var iconpark = {
            url: '/assets/img/icons/map-marker-blue.svg', // url
            scaledSize: new google.maps.Size(30, 30) // scaled size
        };
        var iconhealth = {
            url: '/assets/img/icons/map-marker-red.svg', // url
            scaledSize: new google.maps.Size(30, 30) // scaled size
        };


        function initMap() {
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
            var currentcampsite = new google.maps.LatLng(campsite.latitude, campsite.longitude);

            map = new google.maps.Map(document.getElementById('map'), {
                center: currentcampsite,
                zoom: 14,
                mapTypeControl: false,
                streetViewControl: false,
                scrollwheel: false
            });

            infowindow = new google.maps.InfoWindow();

            function createCampsiteMarker() {
                var marker = new google.maps.Marker({
                    map: map,
                    position: currentcampsite,
                    icon: iconmain
                });

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(campsite.campsite_name);
                    infowindow.open(map, this);
                });
            }
            createCampsiteMarker();

            var healthservice = new google.maps.places.PlacesService(map);
            var storeservice = new google.maps.places.PlacesService(map);
            var parkservice = new google.maps.places.PlacesService(map);

            healthservice.nearbySearch({
                location: currentcampsite,
                radius: 3000,
                type: [healthtype]
            }, callback);

            storeservice.nearbySearch({
                location: currentcampsite,
                radius: 3000,
                type: [storetype]
            }, callback);

            parkservice.nearbySearch({
                location: currentcampsite,
                radius: 3000,
                type: [parktype]
            }, callback);

            //Associate the styled map with the MapTypeId and set it to display.
            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');
        }

        function callback(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            }
        }

        function createMarker(place) {
            var placeLoc = place.geometry.location;
            var icon;
            for (var i=0; i < place.types.length; i++) {
                if (place.types[i] == storetype) {
                    icon = iconstores;
                } else if (place.types[i] == parktype) {
                    icon = iconpark;
                } else if (place.types[i] == healthtype) {
                    icon = iconhealth;
                }
            }
            var marker = new google.maps.Marker({
                map: map,
                position: placeLoc,
                icon: icon
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }
        initMap();
    </script>
@endsection