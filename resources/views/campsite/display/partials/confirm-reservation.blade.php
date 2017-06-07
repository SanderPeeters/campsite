@extends('layouts.app')


<title>Campsite - Reserve {{ $campsite->campsite_name }}</title>
@section('description', 'Choose the perfect Campsite and make a reservation.')

@section('content')
    <section id="reservation-form" class="main vh-min-90">
        <div class="container">
            <div class="panel m-t-120 m-b-20 no-border-radius no-border" >
                <div class="panel-body no-padding m-b-60">
                    <form name="reservationform" ng-controller="ReservationCtrl as reservation" class="no-margin">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="p-b-60 p-t-20 p-l-20 p-r-20">
                                    <h1 class="color-primary">{{trans('reservation.main-title')}}</h1>

                                    <div class="show-mobile">
                                        <h3 class="color-secundary">Chosen Campsite: {{ $campsite->campsite_name }}</h3>
                                        <p>
                                            <strong>Location </strong> <br>
                                            {{ $campsite->street }}, {{ $campsite->city }}
                                        </p>
                                        <p>
                                            <strong>Contact</strong> <br>
                                            {{$campsite->user->name}}
                                        </p>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="startdatereservation">{{trans('reservation.labels.date-of-arrival')}}</label>
                                                <datepicker date-format="dd-MM-yyyy" selector="form-control" class="p-t-5 p-b-15">
                                                    <div class="input-group">
                                                        <input id="startdatereservation" class="form-control" placeholder="dd/mm/yyyy" ng-model="reservation.state.reservation.start_date" ng-change="reservation.events.nextDate('enddatereservation')"/>
                                                        <span class="input-group-addon"><i class="fa fa-lg fa-calendar color-primary"></i></span>
                                                    </div>
                                                </datepicker>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="enddatereservation">{{trans('reservation.labels.date-of-departure')}}</label>
                                                <datepicker date-format="dd-MM-yyyy" selector="form-control" class="p-t-5 p-b-15">
                                                    <div class="input-group">
                                                        <input id="enddatereservation" class="form-control" placeholder="dd/mm/yyyy" ng-model="reservation.state.reservation.end_date"/>
                                                        <span class="input-group-addon"><i class="fa fa-lg fa-calendar color-primary"></i></span>
                                                    </div>
                                                </datepicker>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" ng-cloak>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="movementtype">{{trans('reservation.labels.movement')}}</label>
                                                <select name="movementtype" id="movementtype" class="form-control" ng-model="reservation.state.reservation.movement" validator="required">
                                                    <option value="" disabled selected hidden>Choose your youth movement</option>
                                                    <option ng-repeat="movement in reservation.state.movements" value="##movement.id##">##movement.name##</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="capacity">{{trans('reservation.labels.capacity')}}</label>
                                                <input type="number" class="form-control" id="capacity" name="capacity" ng-model="reservation.state.reservation.capacity" validator="required, number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="extrainfo">{{trans('reservation.labels.message')}}</label>
                                        <textarea name="extrainfo" class="form-control" id="extrainfo" ng-model="reservation.state.reservation.extra_info" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secundary pull-right" data-dismiss="modal" validation-submit="reservationform" ng-click="reservation.events.makeReservation({{$campsite->id}})">Request reservation</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="image--wrapper">
                                    <img src="/img/campsites/{{$campsite->campimages[0]->filename}}" class="full-width" alt="">
                                </div>
                                <div class="hidden-mobile">
                                    <h3 class="color-secundary">Chosen Campsite: {{ $campsite->campsite_name }}</h3>
                                    <p>
                                        <strong>Location </strong> <br>
                                        {{ $campsite->street }}, {{ $campsite->city }}
                                    </p>
                                    <p>
                                        <strong>Contact</strong> <br>
                                        {{$campsite->user->name}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection