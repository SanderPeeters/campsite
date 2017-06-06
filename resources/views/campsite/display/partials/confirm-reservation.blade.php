@extends('layouts.app')


<title>Campsite - Reserve {{ $campsite->campsite_name }}</title>
@section('description', 'Choose the perfect Campsite and make a reservation.')

@section('content')
    <section id="reservation-form" class="main vh-min-90">
        <div class="container">
            <div class="panel m-t-120 m-b-0 no-border-radius no-border" >
                <div class="panel-body no-padding">
                    <form name="reservationform" ng-controller="ReservationCtrl as reservation">
                        <div class="row">
                            <div class="col-sm-7 col-xs-12">
                                <div class="p-b-20 p-t-20 p-l-20 p-r-20">
                                    <h1 class="color-primary">Make a reservation request</h1>
                                    <h3 class="color-secundary">Chosen Campsite: {{ $campsite->campsite_name }}</h3>
                                    <p>
                                        <strong>Location </strong> <br>
                                        {{ $campsite->street }}, {{ $campsite->city }}
                                    </p>
                                    <p>
                                        <strong>Contact</strong> <br>
                                        {{$campsite->user->name}}
                                    </p>
                                    <div class="form-group">
                                        <label for="extrainfo">Message for the Campsite owner</label>
                                        <textarea name="extrainfo" class="form-control" id="extrainfo" ng-model="reservation.state.reservation.extra_info" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="capacity">Group capacity</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity" ng-model="reservation.state.reservation.capacity">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 col-xs-0">
                                <div class="image--wrapper">
                                    <img src="/img/campsites/{{$campsite->campimages[0]->filename}}" class="full-width" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <datepicker date-format="dd-MM-yyyy" selector="form-control">
                                        <div class="input-group p-t-15">
                                            <input id="startdatereservation" class="form-control" placeholder="Choose date of arrival" ng-model="reservation.state.reservation.start_date" ng-change="reservation.events.nextDate('enddatereservation')"/>
                                            <span class="input-group-addon" style="cursor: pointer"><i class="fa fa-lg fa-calendar"></i></span>
                                        </div>
                                    </datepicker>
                                </div>
                                <div class="col-sm-6">
                                    <datepicker date-format="dd-MM-yyyy" selector="form-control">
                                        <div class="input-group p-t-15">
                                            <input id="enddatereservation" class="form-control" placeholder="Choose date of departure" ng-model="reservation.state.reservation.end_date"/>
                                            <span class="input-group-addon" style="cursor: pointer"><i class="fa fa-lg fa-calendar"></i></span>
                                        </div>
                                    </datepicker>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secundary" data-dismiss="modal" ng-click="reservation.events.makeReservation({{$campsite->id}})">Request reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection