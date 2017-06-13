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
                                <td colspan="8">
                                    <p class="text-left p-b-5 p-t-5 p-l-5 p-r-5">
                                        {{ $building->extra_info }}
                                    </p>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            @endforeach
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
    @endforeach
@endif