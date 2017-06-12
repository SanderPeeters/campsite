<h2 class="color-secundary">My profile</h2>
<div class="row">
    <div class="col-sm-3">
        <p>
            <strong>Name</strong> <br>
            {{Auth::user()->name}}
        </p>
    </div>
    <div class="col-sm-3">
        <p>
            <strong>E-mail</strong> <br>
            {{Auth::user()->email}}
        </p>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-xs-6">
                <p>
                    <strong>Youth movement</strong> <br>
                    {{ trans('movements.'. Auth::user()->movement_id) }}
                </p>
            </div>
            <div class="col-xs-6">
                <img src="/assets/img/defaults/{{ Auth::user()->movement->filename }}" style="width:20%">
            </div>
        </div>
    </div>
</div>

<hr class="color-secundary">

<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#editprofile" target="_self">
                    Edit my profile</a>
            </h4>
        </div>
        <div id="editprofile" class="panel-collapse collapse">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('profile.update') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Name" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="E-mail address" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('movement_id') ? ' has-error' : '' }}">

                        <div class="col-md-6">
                            <select name="movement_id" id="movement_id" class="form-control" value="{{ Auth::user()->movement_id }}" placeholder="Youth movement" required>
                                <option value="" disabled selected>Youth movement</option>
                                @for ($i = 1; $i < 7; $i++)
                                    <option value="{{$i}}" {{ $i == Auth::user()->movement_id ? 'selected' : '' }}>{{ trans('movements.'.$i) }}</option>
                                @endfor
                            </select>
                            @if ($errors->has('movement_id'))
                                <span class="help-block">
                            <strong>{{ $errors->first('movement_id') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-secundary btn-block">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#changepassword" target="_self">
                    Change password</a>
            </h4>
        </div>
        <div id="changepassword" class="panel-collapse collapse">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('profile.changepassword') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">

                        <div class="col-md-6">
                            <input id="old_password" type="password" class="form-control" name="old_password" placeholder="Old password" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-secundary btn-block">
                                Change
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        @include('includes.succes')
        @include('includes.errors')
    </div>
</div>