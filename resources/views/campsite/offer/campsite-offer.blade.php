@extends('layouts.app')

@section('title', 'Campsite - Offer a Campsite')
@section('description', 'Have a nice campsite with or without a meadow to offer? Join Campsite now!')


@section('content')
    <section id="offer-campsite-section" class="main vh-min-90">
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                {{-- If user is not logged in, show login/register panel --}}
                @if(!Auth::user())
                    <div class="panel no-border-radius no-border">
                        <div class="panel-body no-padding">
                            <div class="row">
                                <div class="col-sm-7 col-xs-12">
                                    <div class="p-b-20 p-t-20 p-l-20 p-r-20">
                                        <h1 class="color-primary">Offer a campsite</h1>
                                        <h3 class="color-secundary">342 already offered a campsite/meadow</h3>
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
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xs-0">
                                    <div class="image--wrapper">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="panel no-border-radius no-border">
                        <div class="panel-body no-padding">
                            <div class="row">
                                <div class="col-sm-7 col-xs-12">
                                    <div class="p-b-20 p-t-20 p-l-20 p-r-20">
                                        <h1 class="color-primary">Welcome {{ Auth::user()->name }}!</h1>
                                        {{--<h3 class="color-secundary">342 already offered a campsite/meadow</h3>--}}
                                        <p>Please click the start button to create a new Campsite you want to lease.</p>
                                        <p>Or click the My Campsite button to view or edit your existing Campsite!</p>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <a href="{{ route('offer-campsite.new') }}" target="_self">
                                                    <button type="button" class="btn btn-secundary btn-block">
                                                        Start
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="{{ route('register') }}" target="_self">
                                                    <button type="button" class="btn btn-secundary-opposite btn-block">
                                                        My Campsite
                                                    </button>
                                                </a>
                                            </div>
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
                @endif
            </div>
        </div>
    </section>
@endsection