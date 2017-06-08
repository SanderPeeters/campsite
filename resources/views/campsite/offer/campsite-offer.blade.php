@extends('layouts.app')

@section('title', 'Campsite - Offer a Campsite')
@section('description', 'Have a nice campsite with or without a meadow to offer? Join Campsite now!')


@section('content')
    <section id="offer-campsite-section" class="main {{ Auth::user() ? 'vh-min-60' : 'vh-min-90' }}">
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel marg-top-rel no-border-radius no-border">
                    <div class="panel-body no-padding">
                        <div class="row">
                            <div class="col-sm-7 col-xs-12">
                                <div class="p-b-20 p-t-20 p-l-20 p-r-20">
                                    <h1 class="color-primary">Offer a campsite</h1>
                                    @if(!Auth::user())
                                        <h3 class="color-secundary">Already {{$campsites->count()}} campsites were offered on Campsite!</h3>
                                        <p>Are you an owner of an open space, campsite and/or a meadow you want to rent out to youth groups?</p>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <a href="{{ route('login') }}" target="_self">
                                                    <button type="button" class="btn btn-secundary btn-block">
                                                        {{ trans('auth.login') }}
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="{{ route('register') }}" target="_self">
                                                    <button type="button" class="btn btn-secundary-opposite btn-block">
                                                        {{ trans('auth.register') }}
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <h3 class="color-secundary">Follow these few steps to add your Campsite</h3>
                                        <p>Are you an owner of an open space, campsite and/or a meadow you want to rent out to youth groups?</p>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <a href="#create-new-campsite-section">
                                                    <button type="button" id="getStartedButton" class="btn btn-secundary btn-block">
                                                        Get started!
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-xs-6">
                                                <button type="button" class="btn btn-secundary-opposite btn-block" data-toggle="modal" data-target="#howWorksModal">
                                                    How does it work?
                                                </button>
                                            </div>
                                        </div>
                                    @endif
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

    @if(Auth::user())
        <section class="bg--color__main" id="create-new-campsite-section">
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
                                    <div class="p-b-60 p-t-20 p-l-20 p-r-20">
                                        <div ng-include="offer.state.template.url"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#getStartedButton").click(function() {
                $('html,body').animate({
                        scrollTop: $("#create-new-campsite-section").offset().top},
                    'slow');
            });
        });
    </script>
@endsection

<!-- Modal -->
<div id="howWorksModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">How does it work?</h3>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>