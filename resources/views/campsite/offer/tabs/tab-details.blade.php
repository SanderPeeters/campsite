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
