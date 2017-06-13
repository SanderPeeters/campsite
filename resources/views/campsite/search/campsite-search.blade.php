@extends('layouts.app')

@section('title', 'Campsite - Search a Campsite')
@section('description', 'Looking for a Campsite for your youth movement?')


@section('content')
    <section id="search-campsite-section" class="main vh-min-90" ng-controller="SearchCtrl as search" ng-init="search.events.getAllCampsites()">
        <div class="container">
            <div class="panel m-t-120 m-b-0 no-border-radius no-border" >
                <div class="panel-body no-padding">
                    <div class="row">
                        <div class="col-sm-7 col-xs-12">
                            <div class="p-b-20 p-t-20 p-l-20 p-r-20" ng-cloak>
                                <h1 class="color-primary">{{ trans('search.main-title') }}</h1>
                                <h3 class="color-secundary">{{$numberofcampsites}} {{ trans( 'search.campsites-available') }}</h3>
                                <p>{{ trans('search.intro-text') }}</p>
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
        <div class="container-fluid bg--color__main p-b-120">
            <div class="row m-t-20 m-b-20 text-center">
                <div class="col-sm-6 col-sm-offset-3">
                    <h3 class="color-white uppercase">{{ trans('search.searchresults') }}</h3>
                    <hr class="color-secundary w-20--p m-t-0">
                    <h4 class="color-white" ng-cloak> ##search.state.number_of_campsites## {{ trans('search.numberoffound') }}</h4>
                </div>
            </div>

            <div id="search-results-section" class="container" ng-init="search.handlers.getAllCampsites()">
                <div class="panel no-bg no-border-radius no-border m-b-20">
                    <div class="row">
                        <div class="col-sm-4 no-padding-small no-right-padding whitebg">
                            <div class="search" ng-cloak>
                                {{--<div class="show-mobile">
                                    <div class="p-b-10">
                                        <a href="" data-toggle="collapse" data-target="#searchbar">Show/hide filters</a>
                                    </div>
                                    <div id="searchbar" class="collapse">
                                        @include('campsite.search.partials.searchbar')
                                    </div>
                                </div>
                                <div class="hide-mobile">
                                    @include('campsite.search.partials.searchbar')
                                </div>--}}
                                @include('campsite.search.partials.searchbar')
                            </div>
                        </div>
                        <div class="col-sm-8 no-padding-small whitebg">
                            <div class="results" ng-cloak>
                                @include('campsite.search.partials.results')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--<div class="row m-t-20 m-b-80 text-center" ng-cloak>
                <div class="col-sm-6 col-sm-offset-3">
                    <p class="color-white">{{ trans('pagination.page') }} ##search.state.current_page## {{ trans('pagination.of') }} ##search.state.number_of_pages##</p>
                    <button class="btn btn-white" ng-disabled="!search.state.paginate_previousurl" ng-click="search.events.changePage(search.state.paginate_previousurl)">{{trans('pagination.previous')}}</button>
                    <button class="btn btn-white" ng-disabled="!search.state.paginate_nexturl" ng-click="search.events.changePage(search.state.paginate_nexturl)">{{trans('pagination.next')}}</button>
                </div>
            </div>--}}

        </div>
    </section>

    @include('includes.register');

@endsection
