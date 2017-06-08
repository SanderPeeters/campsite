@extends('layouts.app')

@section('title', 'Campsite - Login')
@section('description', 'Login to your account on Campsite')

@section('content')

    <section id="section-login" class="main vh-min-90">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel marg-top-rel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12 text-center p-b-20">
                                <h1 class="color-primary">Campsite</h1>
                            </div>
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail address" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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

                                {{--<div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>--}}

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-secundary btn-block">
                                            Login
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <div class="col-md-12">
                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                            Forgot Your Password?
                                        </a>
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
