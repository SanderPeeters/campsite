@if($campsite->buildings)
    <h2 class="color-secundary m-b-20">{{ trans('campsite.buildings') }} <span class="smaller-font">({{ $campsite->buildings->count() }})</span></h2>
    <div class="row">
        <div class="col-sm-12">
            @foreach($campsite->buildings as $building)
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered text-center">
                        <tbody>
                        <tr>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.capacity') }}">
                                    <img src="/assets/img/icons/icon-users-group.svg" class="table--icon" alt="Icon representing the maximum capacity of a group">
                                </p>
                                <p>{{ $building->capacity }}</p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.beds') }}">
                                    <img src="/assets/img/icons/icon-bed.svg" class="table--icon" alt="Icon representing the amount of beds available">
                                </p>
                                <p>{{ $building->beds }}</p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.showers') }}">
                                    <img src="/assets/img/icons/icon-shower.svg" class="table--icon" alt="Icon representing the amount of showers available">
                                </p>
                                <p>{{ $building->showers }}</p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.toilets') }}">
                                    <img src="/assets/img/icons/icon-toilet.svg" class="table--icon" alt="Icon representing the amount of toilets available">
                                </p>
                                {{ $building->toilets }}
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.electricity') }}">
                                    <img src="/assets/img/icons/icon-plug.svg" class="table--icon" alt="Icon representing the availability of electricity">
                                </p>
                                <p>
                                    {{ $building->has_electricity ? 'Yes' : 'No' }}
                                </p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.water') }}">
                                    <img src="/assets/img/icons/icon-tap.svg" class="table--icon" alt="Icon representing the availability of water">
                                </p>
                                <p>
                                    {{ $building->has_water ? 'Yes' : 'No' }}
                                </p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.kitchen') }}">
                                    <img src="/assets/img/icons/icon-pot.svg" class="table--icon" alt="Icon representing the availability of a kitchen">
                                </p>
                                <p>
                                    {{ $building->has_kitchen ? 'Yes' : 'No' }}
                                </p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.wifi') }}">
                                    <img src="/assets/img/icons/icon-wifi.svg" class="table--icon" alt="Icon representing the availability of wifi">
                                </p>
                                <p>
                                    {{ $building->has_wifi  ? 'Yes' : 'No' }}
                                </p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.wheelchair') }}">
                                    <img src="/assets/img/icons/icon-disabled-green.svg" class="table--icon" alt="Icon representing the accessibility for wheelchair users">
                                </p>
                                <p>
                                    {{ $building->wheelchair_accessible  ? 'Yes' : 'No' }}
                                </p>
                            </td>
                        </tr>
                        @if ($building->extra_info)
                            <tr>
                                <td colspan="9">
                                    <p class="text-left p-b-5 p-t-5 p-l-5 p-r-5">
                                        {{ $building->extra_info }}
                                    </p>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                @if (!Auth::guest())
                    @if (Auth::user()->campsite && Auth::user()->campsite->id == $campsite->id)
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ route('campsite.building.delete', ['id' => $building->id])}}" target="_self">
                                    <button type="button" class="btn btn-danger pull-right m-b-20">
                                        <i class="fa fa-times" aria-hidden="true"></i> {{ trans('forms.buttons.removebuilding') }}
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach

            @if (!Auth::guest())
                @if (Auth::user()->campsite && Auth::user()->campsite->id == $campsite->id)
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="" data-toggle="collapse" data-target="#new-building">
                                <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('forms.buttons.newbuilding') }}
                            </a>
                        </div>
                    </div>

                    <div class="collapse" id="new-building">
                        <form action="{{ route('campsite.buildings.add') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $campsite->id }}" name="campsiteid">
                            <hr class="color-primary m-t-20">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="building_capacity"><strong>{{ trans('forms.labels.capacity') }}</strong></label>
                                        <input class="form-control" id="building_capacity" type="number" value="{{ old('building_capacity') }}" name="building_capacity" min="0" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="building_beds"><strong>{{ trans('forms.labels.beds') }}</strong></label>
                                        <input class="form-control" id="building_beds" type="number" value="{{ old('building_beds') }}" name="building_beds" min="0" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="building_showers"><strong>{{ trans('forms.labels.showers') }}</strong></label>
                                        <input class="form-control" id="building_showers" type="number" value="{{ old('building_showers') }}" name="building_showers" min="0" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="building_toilets"><strong>{{ trans('forms.labels.toilets') }}</strong></label>
                                        <input class="form-control" id="building_toilets" type="number" value="{{ old('building_toilets') }}" name="building_toilets" min="0" placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <label class="color-secundary m-b-20">Indicate your building facilities</label>
                            <div class="row icons">
                                <div class="col-sm-2 col-xs-4">
                                    <div class="form-group">
                                        <input id="building_haswater" value="1" type="checkbox" autocomplete="off" name="building_haswater"> {{ trans('forms.labels.haswater') }}
                                    </div>
                                </div>
                                <div class="col-sm-2  col-xs-4">
                                    <div class="form-group">
                                        <input id="building_haselectricity" value="1" type="checkbox" autocomplete="off" name="building_haselectricity"> {{ trans('forms.labels.haselectricity') }}
                                    </div>
                                </div>
                                <div class="col-sm-2  col-xs-4">
                                    <div class="form-group">
                                        <input ng-model="building.haswifi" id="building_haswifi" value="1" type="checkbox" autocomplete="off" name="building_haswifi"> {{ trans('forms.labels.haswifi') }}
                                    </div>
                                </div>
                                <div class="col-sm-2  col-xs-4">
                                    <div class="form-group">
                                        <input id="building_haskitchen" value="1" type="checkbox" autocomplete="off" name="building_haskitchen"> {{ trans('forms.labels.haskitchen') }}
                                    </div>
                                </div>
                                <div class="col-sm-3  col-xs-4">
                                    <div class="form-group">
                                        <input id="building_wheelchairaccessible" value="1" type="checkbox" autocomplete="off" name="building_wheelchairaccessible"> {{ trans('forms.labels.wheelchairaccessible') }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="building_extrainfo"><strong>{{ trans('forms.labels.extrainfo') }}</strong></label>
                                <textarea class="form-control" ng-model="building.extrainfo" id="building_extrainfo" type="text" name="building_extrainfo" placeholder="Add some extra info about this building..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-secundary-opposite pull-right"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('forms.buttons.newbuilding') }}</button>
                        </form>
                        <hr class="color-primary m-t-80">
                    </div>
                @endif
            @endif
        </div>
    </div>
@endif

@if($campsite->meadows)
    <h2 class="color-secundary m-b-20 capitalize">{{ trans('campsite.meadows') }} <span class="smaller-font">({{ $campsite->meadows->count() }})</span></h2>
    @foreach($campsite->meadows as $meadow)
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-concensed table-bordered text-center">
                        <tbody>
                        <tr>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.capacity') }}">
                                    <img src="/assets/img/icons/icon-users-group.svg" class="table--icon" alt="Icon representing the maximum capacity of a group">
                                </p>
                                <p>{{ $meadow->capacity }}</p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.sqmeters') }}">
                                    <img src="/assets/img/icons/icon-size-green.svg" class="table--icon" alt="Icon representing the size of the meadow">
                                </p>
                                <p>{{ $meadow->sq_meters }} m<sup>2</sup></p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.electricity') }}">
                                    <img src="/assets/img/icons/icon-plug.svg" class="table--icon" alt="Icon representing the availability of electricity">
                                </p>
                                <p>
                                    {{ $meadow->has_electricity ? 'Yes' : 'No' }}
                                </p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.water') }}">
                                    <img src="/assets/img/icons/icon-tap.svg" class="table--icon" alt="Icon representing the availability of water">
                                </p>
                                <p>
                                    {{ $meadow->has_water ? 'Yes' : 'No' }}
                                </p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.tents') }}">
                                    <img src="/assets/img/icons/icon-tent-green.svg" class="table--icon" alt="Icon representing if tents are allowed">
                                </p>
                                <p>
                                    {{ $meadow->tents_allowed ? 'Yes' : 'No' }}
                                </p>
                            </td>
                            <td>
                                <p data-toggle="tooltip" title="{{ trans('tooltips.campfire') }}">
                                    <img src="/assets/img/icons/icon-bonfire-green.svg" class="table--icon" alt="Icon representing if campfires are allowed">
                                </p>
                                <p>
                                    {{ $meadow->campfire_allowed ? 'Yes' : 'No' }}
                                </p>
                            </td>
                        </tr>
                        @if ($meadow->extra_info)
                            <tr>
                                <td colspan="8">
                                    <p class="text-left p-b-5 p-t-5 p-l-5 p-r-5">
                                        {{ $meadow->extra_info }}
                                    </p>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if (!Auth::guest())
            @if (Auth::user()->campsite && Auth::user()->campsite->id == $campsite->id)
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('campsite.meadow.delete', ['id' => $meadow->id])}}" target="_self">
                            <button type="button" class="btn btn-danger pull-right m-b-20">
                                <i class="fa fa-times" aria-hidden="true"></i> {{ trans('forms.buttons.removemeadow') }}
                            </button>
                        </a>
                    </div>
                </div>
            @endif
        @endif
    @endforeach

    @if (!Auth::guest())
        @if (Auth::user()->campsite && Auth::user()->campsite->id == $campsite->id)
            <div class="row">
                <div class="col-sm-12">
                    <a href="" data-toggle="collapse" data-target="#new-meadow">
                        <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('forms.buttons.newmeadow') }}
                    </a>
                </div>
            </div>

            <div class="collapse" id="new-meadow">
                <form action="{{ route('campsite.meadows.add') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $campsite->id }}" name="campsiteid">
                    <hr class="color-primary m-t-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="meadow_capacity"><strong>{{ trans('forms.labels.capacity') }}</strong></label>
                                <input class="form-control" id="meadow_capacity" type="number" value="{{ old('meadow_capacity') }}" name="meadow_capacity" min="0" placeholder="0">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="meadow_sqmeters"><strong>{{ trans('forms.labels.sqmeters') }}</strong></label>
                                <input class="form-control" id="meadow_sqmeters" type="number" value="{{ old('meadow_sqmeters') }}" name="meadow_sqmeters" min="0" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group">
                                <input id="meadow_haswater" value="1" type="checkbox" autocomplete="off" name="meadow_haswater"> {{ trans('forms.labels.haswater') }}
                            </div>
                        </div>
                        <div class="col-sm-3  col-xs-6">
                            <div class="form-group">
                                <input id="meadow_haselectricity" value="1" type="checkbox" autocomplete="off" name="meadow_haselectricity"> {{ trans('forms.labels.haselectricity') }}
                            </div>
                        </div>
                        <div class="col-sm-3  col-xs-6">
                            <div class="form-group">
                                <input id="meadow_tentsallowed" value="1" type="checkbox" autocomplete="off" name="meadow_tentsallowed"> {{ trans('forms.labels.tentsallowed') }}
                            </div>
                        </div>
                        <div class="col-sm-3  col-xs-6">
                            <div class="form-group">
                                <input id="meadow_campfireallowed" value="1" type="checkbox" autocomplete="off" name="meadow_campfireallowed"> {{ trans('forms.labels.campfireallowed') }}
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secundary-opposite pull-right"><i class="fa fa-plus" aria-hidden="true"></i> {{ trans('forms.buttons.newmeadow') }}</button>
                </form>
                <hr class="color-primary m-t-80">
            </div>
        @endif
    @endif
@endif