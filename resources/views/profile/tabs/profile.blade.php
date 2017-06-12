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