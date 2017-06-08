@extends('layouts.app')

@section('title', 'Campsite - Register')
@section('description', 'Register now and join Campsite for free')

@section('content')
    <section id="section-register" class="main vh-min-90">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel marg-top-rel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12 text-center p-b-20">
                                <h1 class="color-primary">Campsite</h1>
                            </div>
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail address" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('movement_id') ? ' has-error' : '' }}">

                                    <div class="col-md-12">
                                        <select name="movement_id" id="movement_id" class="form-control" value="{{ old('movement_id') }}" placeholder="Youth movement" required>
                                            <option value="" disabled selected>Youth movement</option>
                                            @for ($i = 1; $i < 7; $i++)
                                                <option value="{{$i}}">{{ trans('movements.'.$i) }}</option>
                                            @endfor
                                        </select>
                                        @if ($errors->has('movement_id'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('movement_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-secundary btn-block">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
