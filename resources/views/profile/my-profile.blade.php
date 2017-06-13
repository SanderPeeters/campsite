@extends('layouts.app')

@section('title', 'Campsite - Offer a Campsite')
@section('description', 'View or edit your profile and view your reservations and saved Campsites')

@section('content')
    <section class="main vh-min-90">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel m-t-120 no-border-radius no-border">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#profile" target="_self">{{ trans('profile.myprofile') }}</a></li>
                                <li><a data-toggle="tab" href="#reservations" target="_self">{{ trans('profile.myreservations') }}</a></li>
                                <li><a data-toggle="tab" href="#savings" target="_self">{{ trans('profile.savedcampsites') }}</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="profile" class="tab-pane fade in active">
                                    @include('profile.tabs.profile')
                                </div>
                                <div id="reservations" class="tab-pane fade">
                                    @include('profile.tabs.reservations')
                                </div>
                                <div id="savings" class="tab-pane fade">
                                    @include('profile.tabs.savings')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection