@extends('layouts.app')

@section('content')

    <!-- Section intro with searchfield -->
    <section id="home-intro" class="main vh-min-100">
        <div class="container">
            <div class="section--centered">
                <form action="">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="image--home m-b-30 m-t-20">
                                <img src="assets/img/logo/Campsite_logo_white.png" alt="Logo from Campsite">
                            </div>
                            {{--<h3 class="m-b-20">Find the perfect campsite</h3>--}}
                        </div>
                    </div>
                    <div class="row bg--transparent">
                        <div class="col-sm-12 p-t-15">
                            <input type="text" class="form-control" placeholder="Country / Region / Place / Campsite ">
                        </div>
                        <div class="col-sm-4 p-t-10">
                            <input type="text" class="form-control" placeholder="# Persons">
                        </div>
                        <div class="col-sm-4 p-t-10">
                            <input type="text" class="form-control" placeholder="From dd/mm/yy">
                        </div>
                        <div class="col-sm-4 p-t-10 p-b-10">
                            <input type="text" class="form-control" placeholder="Until dd/mm/yy">
                        </div>
                        <div class="col-sm-12 p-b-15">
                            <button type="submit" class="btn btn-block btn-main">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row m-t-60">
                    <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
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
                    <div class="item card">
                        <div class="card--img">
                            <a href="http://placehold.it" target="_self">
                                <img src="http://placehold.it/340x260">
                            </a>
                        </div>
                        <div class="card--info">
                            <p>Belgium - Haunait - Tournai</p>
                            <a href="http://placehold.it" target="_self">
                                <h3>JC Liénart</h3>
                            </a>
                        </div>
                    </div>
                    <div class="item card">
                        <div class="card--img">
                            <a href="http://placehold.it" target="_self">
                                <img src="http://placehold.it/340x260">
                            </a>
                        </div>
                        <div class="card--info">
                            <p>Belgium - Haunait - Tournai</p>
                            <a href="http://placehold.it" target="_self">
                                <h3>Camping de l'Ourthe</h3>
                            </a>
                        </div>
                    </div>
                    <div class="item card">
                        <div class="card--img">
                            <a href="http://placehold.it" target="_self">
                                <img src="http://placehold.it/340x260">
                            </a>
                        </div>
                        <div class="card--info">
                            <p>Belgium - Haunait - Tournai</p>
                            <a href="http://placehold.it" target="_self">
                                <h3>Camping de l'Orient</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center m-b-40">
                <a href="" target="_self">
                    <button type="button" class="btn btn-tertiary">
                        Browse more
                    </button>
                </a>
            </div>
        </div>
    </section>

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
@endsection
