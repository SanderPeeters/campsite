<h2 class="color-secundary">
    {{ trans('campsite.mycampsite') }}
    <a href="" class="icon-edit pull-right" data-toggle="collapse" data-target="#edit-campsite">
        <img src="/assets/img/icons/icon-edit-green.svg" alt="">
    </a>
</h2>

<div class="row">
    <div class="col-sm-6">
        @include('includes.succes')
        @include('includes.errors')
    </div>
</div>

<div class="collapse" id="edit-campsite">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('campsite.update') }}">
        {{ csrf_field() }}
        <input type="hidden" name="campsiteid" value="{{$campsite->id}}">

        <div class="form-group{{ $errors->has('campsitename') ? ' has-error' : '' }}">

            <div class="col-sm-6">
                <label for="campsitename">{{ trans('forms.labels.campsitename') }}</label>
                <input id="campsitename" type="text" class="form-control" name="campsitename" value="{{ $campsite->campsite_name }}" placeholder="{{ trans('forms.placeholders.campsitename') }}" required autofocus>

            </div>
        </div>

        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">

            <div class="col-sm-6">
                <label for="campsitename">{{ trans('forms.labels.price') }}</label>
                <input id="price" type="number" class="form-control" name="price" value="{{ $campsite->price_per_night }}" placeholder="{{ trans('forms.placeholders.price') }}" required>

            </div>
        </div>

        <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">

            <div class="col-sm-6">
                <label for="campsitename">{{ trans('forms.labels.website') }}</label>
                <input id="website" type="url" class="form-control" name="website" value="{{$campsite->website}}" placeholder="{{ trans('forms.placeholders.price') }}" required>

            </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

            <div class="col-sm-12">
                <label for="campsitename">{{ trans('forms.labels.description') }}</label>
                <text-angular id="description" type="text" name="description">{!!  $campsite->description !!}</text-angular>

            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-6">
                <button type="submit" class="btn btn-secundary btn-block">
                    {{ trans('forms.buttons.update') }}
                </button>
            </div>
        </div>
    </form>

    <hr class="color-secundary">
</div>

<div class="row">
    <div class="col-sm-6">
        <p>
            <strong>{{ trans('forms.labels.name') }}</strong><br>
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
