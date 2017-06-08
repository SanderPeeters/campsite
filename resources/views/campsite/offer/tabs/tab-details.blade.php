
<h2 class="color-secundary">My profile</h2>
<div class="row">
    <div class="col-sm-3">
        <p>
            <strong>Name</strong> <br>
            {{$campsite->user->name}}
        </p>
    </div>
    <div class="col-sm-3">
        <p>
            <strong>E-mail</strong> <br>
            {{$campsite->user->email}}
        </p>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-xs-6">
                <p>
                    <strong>Youth movement</strong> <br>
                    {{ trans('movements.'. $campsite->user->movement_id) }}
                </p>
            </div>
            <div class="col-xs-6">
                <img src="/assets/img/defaults/{{ $campsite->user->movement->filename }}" style="width:20%">
            </div>
        </div>
    </div>
</div>

<hr class="color-secundary">

<h2 class="color-secundary">My Campsite</h2>

<div class="row">
    <div class="col-sm-6">
        <p>
            <strong>Name</strong> <br>
            {{$campsite->campsite_name}}
        </p>
        <p>
            <strong>Location</strong> <br>
            {{$campsite->street}},  {{$campsite->zipcode}} {{$campsite->city}} <br>
            {{ trans('provinces.'.$campsite->province_id) }}, {{ trans('states.'.$campsite->state_id) }}
        </p>
        <p>
            <strong>Price per night</strong> <br>
            {{$campsite->price_per_night}} euro
        </p>
        <p>
            <strong>Website</strong> <br>
            {{$campsite->website}}
        </p>
    </div>
    <div class="col-sm-6">
        <div id="campsitemap" style="width:100%;height:200px;">

        </div>
    </div>
</div>
<p>
    <strong>Description</strong>
</p>
{!! $campsite->description !!}
@include('campsite.display.partials.tab-facilities')
