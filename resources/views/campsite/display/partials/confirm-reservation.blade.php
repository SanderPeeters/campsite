@extends('layouts.app')


<title>Campsite - Reserve {{ $campsite->campsite_name }}</title>
@section('description', 'Choose the perfect Campsite and make a reservation.')

@section('content')
    <section id="reservation-form" class="main vh-min-90">
        <div class="container">
            <div class="panel m-t-120 m-b-20 no-border-radius no-border" >
                <div class="panel-body no-padding m-b-60">
                    <form name="reservationform" ng-controller="ReservationCtrl as reservation" class="no-margin" method="POST" action="{{route('reservation.store')}}">
                        {{csrf_field()}}
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
                                        @include('includes.succes')
                                    </div>

                                    <input type="hidden" value="{{$campsite->id}}" name="campsite_id">

                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}" >
                                                <label for="startdatereservation">{{trans('reservation.labels.date-of-arrival')}}</label>
                                                <datepicker date-format="dd-MM-yyyy" selector="form-control" class="p-t-5 p-b-15">
                                                    <div class="input-group">
                                                        <input id="startdatereservation" name="start_date" value="{{ old('start_date') }}" class="form-control" placeholder="dd/mm/yyyy" ng-model="reservation.state.reservation.start_date" ng-change="reservation.events.nextDate('enddatereservation')"/>
                                                        <span class="input-group-addon"><i class="fa fa-lg fa-calendar color-primary"></i></span>
                                                    </div>
                                                </datepicker>
                                                @if ($errors->has('start_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('start_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                                <label for="enddatereservation">{{trans('reservation.labels.date-of-departure')}}</label>
                                                <datepicker date-format="dd-MM-yyyy" selector="form-control" value="{{ old('end_date') }}" class="p-t-5 p-b-15">
                                                    <div class="input-group">
                                                        <input id="enddatereservation" name="end_date" class="form-control" placeholder="dd/mm/yyyy"/>
                                                        <span class="input-group-addon"><i class="fa fa-lg fa-calendar color-primary"></i></span>
                                                    </div>
                                                </datepicker>
                                                @if ($errors->has('end_date'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('end_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" ng-cloak>
                                        <div class="col-sm-6">
                                            <div class="form-group{{ $errors->has('movement') ? ' has-error' : '' }}">
                                                <label for="movement">{{trans('reservation.labels.movement')}}</label>
                                                <select name="movement" id="movement" class="form-control" ng-model="reservation.state.reservation.movement">
                                                    <option value="" disabled selected></option>
                                                    <option ng-repeat="movement in reservation.state.movements" value="##movement.id##">##movement.name##</option>
                                                </select>
                                                @if ($errors->has('movement'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('movement') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                                                <label for="capacity">{{trans('reservation.labels.capacity')}}</label>
                                                <input type="number" class="form-control" id="capacity" value="{{ old('capacity') }}" name="capacity">
                                                @if ($errors->has('capacity'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('capacity') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="extrainfo">{{trans('reservation.labels.message')}}</label>
                                        <textarea name="extrainfo" class="form-control" id="extrainfo" value="{{ old('extrainfo') }}" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secundary pull-right">Request reservation</button>
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
                                    @include('includes.succes')
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection