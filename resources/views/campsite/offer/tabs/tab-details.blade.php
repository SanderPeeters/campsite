<h2 class="color-secundary">{{ trans('campsite.mycampsite') }}</h2>

<div class="row">
    <div class="col-sm-6">
        <p>
            <strong>{{ trans('forms.labels.name') }}</strong> <br>
            {{$campsite->campsite_name}}
        </p>
        <p>
            <strong>{{ trans('forms.labels.location') }}</strong> <br>
            {{$campsite->street}},  {{$campsite->zipcode}} {{$campsite->city}} <br>
            {{ trans('provinces.'.$campsite->province_id) }}, {{ trans('states.'.$campsite->state_id) }}
        </p>
        <p>
            <strong>{{ trans('forms.labels.price') }}</strong> <br>
            {{$campsite->price_per_night}} euro
        </p>
        <p>
            <strong>{{ trans('forms.labels.website') }}</strong> <br>
            <a href="{{$campsite->website}}" target="_blank">{{$campsite->website}}</a>
        </p>
    </div>
    <div class="col-sm-6">
        <div id="campsitemap" style="width:100%;height:200px;">

        </div>
        <p class="m-t-20">
            <a href="{{ route('campsite.display', ['id' => $campsite->id]) }}" target="_self">
                {{ trans('campsite.mycampsite') }}
            </a>
        </p>
    </div>
</div>
<p>
    <strong>{{ trans('forms.labels.description') }}</strong>
</p>
{!! $campsite->description !!}
@include('campsite.display.partials.tab-facilities')
