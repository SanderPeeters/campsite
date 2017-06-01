@extends('layouts.app')

@section('title', 'Campsite - Search a Campsite')
@section('description', 'Looking for a Campsite for your youth movement?')


@section('content')
    <section id="search-campsite-section" class="main vh-min-90">
        <div class="container">
            <div class="panel marg-top-rel m-b-0 no-border-radius no-border">
                <div class="panel-body no-padding">
                    <div class="row">
                        <div class="col-sm-7 col-xs-12">
                            <div class="p-b-20 p-t-20 p-l-20 p-r-20">
                                <h1 class="color-primary">{{ trans('search.main-title') }}</h1>
                                <h3 class="color-secundary">342 already offered a campsite/meadow</h3>
                                <p>Are you an owner of an open space, campsite and/or a meadow you want to rent out to youth groups?</p>
                                <div class="row">

                                </div>
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
        <div class="container-fluid bg--color__main">
            <div class="row m-t-20 m-b-20 text-center">
                <div class="col-sm-6 col-sm-offset-3">
                    <h3 class="color-white uppercase">{{ trans('search.searchresults') }}</h3>
                    <hr class="color-secundary w-20--p m-t-0">
                </div>
            </div>

            <div id="search-results-section" class="container" ng-controller="SearchCtrl as search">
                <div class="panel no-border-radius no-border m-b-80">
                    <div class="row">
                        <div class="col-sm-4 no-right-padding">
                            <div class="search" ng-cloak>
                                @include('campsite.search.partials.searchbar')
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="results" ng-cloak>
                                @include('campsite.search.partials.results')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('includes.register');

@endsection