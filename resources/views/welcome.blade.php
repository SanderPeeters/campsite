@extends('layouts.app')

@section('title', 'Campsite - Home')
@section('description', 'Campsite, the website for youth movements to find their unique camping spot.')

@section('content')

    <!-- Section intro with searchfield -->
    <section id="home-intro" class="main vh-min-80">
        <div class="container">
            <div class="section--centered" ng-controller="SearchCtrl as map">
                <div class="row">
                    <div class="col-sm-2 col-sm-offset-5 col-xs-6 col-xs-offset-3">
                        <div class="image--home">
                            <img src="assets/img/logo/Campsite_logo_white.png" alt="Logo from Campsite">
                        </div>
                    </div>
                </div>
                {{--<h3 >Find the perfect campsite</h3>--}}
                {{--<div class="row m-t-20">
                    <div class="col-sm-6 col-sm-offset-3">
                        <a href="{{route('search-campsite')}}" target="_self">
                            <img src="assets/img/bg/Belgium.svg" alt="" style="width: 100%;">
                        </a>
                    </div>
                </div>--}}
                <div class="row m-t-20">
                    <div class="col-sm-6 col-sm-offset-3">
                        {{--<object id="belgiummap" type="image/svg+xml" data="assets/img/bg/Belgium.svg">
                            Your browser does not support SVG
                        </object>--}}
                        {!! file_get_contents('assets/img/bg/Belgium.svg') !!}
                    </div>
                </div>
                <div class="row m-t-60 m-b-30">
                    <div class="col-xs-4 col-xs-offset-4">
                        <a href="" target="_self">
                            <button type="button" class="btn btn-transparent btn-block">
                                How it works?
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($campsites->count())
        <section id="top-campsites-section">
            <div class="container-fluid">
                <div class="row m-b-20 text-center">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h3 class="color-light-grey uppercase">popular campsites</h3>
                        <hr class="color-primary w-20--p m-t-0">
                    </div>
                </div>
                <div class="m-b-40">
                    <div id="owl-carousel-home" class="owl-carousel owl-theme">
                        @foreach($campsites as $campsite)
                            <div class="item card">
                                <div class="card--img">
                                    <a href="{{  route('campsite.display', [ 'id' => $campsite[0]->id ]) }}" target="_self">
                                        @if (count($campsite[0]->campimages))
                                            <img src="/img/campsites/{{$campsite[0]->campimages[0]->filename}}">
                                        @else
                                            <img src="/assets/img/defaults/default-campsite-1.jpg">
                                        @endif
                                    </a>
                                </div>
                                <div class="card--info">
                                    <p>{{ $campsite[0]->state->name }} - {{$campsite[0]->province->name }} - {{$campsite[0]->city}}</p>
                                    <a href="{{  route('campsite.display', [ 'id' => $campsite[0]->id ]) }}" target="_self">
                                        <h3>{{$campsite[0]->campsite_name}}</h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row text-center m-b-40">
                    <a href="" target="_self">
                        <button type="button" class="btn btn-tertiary p-t-5 p-b-5 p-l-25 p-r-25">
                            Browse more
                        </button>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Section why use our service-->
    <section id="why-use-service" class="bg--color__main p-t-40">
        <div class="container text-center">
            <div class="row m-b-20">
                <div class="col-sm-6 col-sm-offset-3">
                    <h3 class="color-white uppercase">why use our service</h3>
                    <hr class="color-secundary w-20--p m-t-0">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0 p-b-40">
                    <div class="icon">
                        <img src='assets/img/icons/text-document.svg' alt="">
                    </div>
                    <h3 class="color-secundary font--bold">Easy paperworks</h3>
                    <p class="color-secundary">
                        When you register, all documents and forms regarding insurance etc. can be obtained here on the website or with the owner.
                    </p>
                </div>
                <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0 p-b-40">
                    <div class="icon">
                        <img src='assets/img/icons/thumb-up.svg' alt="">
                    </div>
                    <h3 class="color-secundary font--bold">Register for free</h3>
                    <p class="color-secundary">
                        Easy register/log in with Facebook or on the website. For people who search a campsite or who wants to offer a site/meadow.
                    </p>
                </div>
                <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0 p-b-40">
                    <div class="icon">
                        <img src='assets/img/icons/tent.svg' alt="">
                    </div>
                    <h3 class="color-secundary font--bold">Verified campsites</h3>
                    <p class="color-secundary">
                        We assure you that our campsites and meadows are verified and insured.
                        We’re proud of being scam-free!
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('includes.register')

@endsection
