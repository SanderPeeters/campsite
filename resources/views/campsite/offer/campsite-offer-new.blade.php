@extends('layouts.app')

@section('title', 'Campsite - Offer a Campsite')
@section('description', 'Have a nice campsite with or without a meadow to offer? Join Campsite now!')


@section('content')
    <section id="offer-campsite-section" class="main vh-min-90">
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel no-border-radius no-border">
                    <div class="panel-body no-padding">
                        <div class="row">
                            <div class="col-sm-7 col-xs-12">
                                <div class="p-b-20 p-t-20 p-l-20 p-r-20">
                                    <h1 class="color-primary">Offer a campsite</h1>
                                    <h3 class="color-secundary">Follow these few steps to add your Campsite</h3>
                                    <p>Are you an owner of an open space, campsite and/or a meadow you want to rent out to youth groups?</p>

                                    <a href="" target="_self">
                                        <button type="button" class="btn btn-secundary p-l-25 p-r-25">
                                            How does it work?
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-5 col-xs-0">
                                <div class="image--wrapper">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg--color__main">
        <div class="container">
            <div class="text-center">
                <h3 class="color-white uppercase">create a new campsite</h3>
                <hr class="color-secundary w-20--p m-t-0">
            </div>
            <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0">
                <div class="panel m-t-20 m-b-30 no-border-radius no-border">
                    <div class="panel-body no-padding" ng-controller="OfferCtrl as offer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="p-b-20 p-t-20 p-l-20 p-r-20">
                                    <div ng-include="offer.state.template.url"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection