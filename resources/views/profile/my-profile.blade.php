@extends('layouts.app')

@section('title', 'Campsite - Offer a Campsite')
@section('description', 'Have a nice campsite with or without a meadow to offer? Join Campsite now!')

@section('content')
    <section class="main vh-min-90">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel m-t-120 no-border-radius no-border">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#profile" target="_self">My profile</a></li>
                                <li><a data-toggle="tab" href="#savings" target="_self">Saved Campsites</a></li>
                                <li><a data-toggle="tab" href="#reservations" target="_self">My reservations</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="profile" class="tab-pane fade in active">
                                    @include('profile.tabs.profile')
                                </div>
                                <div id="savings" class="tab-pane fade">
                                    @include('profile.tabs.savings')
                                </div>
                                <div id="reservations" class="tab-pane fade">
                                    @include('profile.tabs.reservations')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection