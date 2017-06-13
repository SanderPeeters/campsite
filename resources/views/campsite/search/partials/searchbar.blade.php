<form name="searchcampsiteform" ng-submit="search.handlers.search()">
    <div class="search--block greybg">
        <div class="">
            <label for="campsite_name">{{ trans('search.labels.campsite-name') }}</label>
            <input type="text" class="form-control" name="campsite_name" ng-model="search.state.searchObject.campsite_name" placeholder="{{ trans('search.placeholders.campsite-name') }}">
        </div>
    </div>

    {{--<div class="search--block">
        <div class="">
            <label for="states">{{ trans('search.labels.states') }}</label>
            <ui-select ng-if="!search.state.states_loading" multiple ng-model="search.state.searchObject.states" theme="bootstrap" class="form-control" sortable="true" close-on-select="false">
                <ui-select-match placeholder="{{ trans('search.placeholders.states') }}">##$item.name##</ui-select-match>
                <ui-select-choices repeat="state in search.state.states | filter: $item.search">
                    <div ng-bind-html="state.name"></div>
                </ui-select-choices>
            </ui-select>
            <p ng-if="search.state.states_loading">{{ trans('search.loading') }}</p>
        </div>
    </div>--}}

    <div class="search--block">
        <div class="">
            <label for="provinces">{{ trans('search.labels.provinces') }}</label>
            <ui-select ng-if="!search.state.provinces_loading" multiple ng-model="search.state.searchObject.provinces" theme="bootstrap" class="form-control" sortable="true" close-on-select="false">
                <ui-select-match placeholder="{{ trans('search.placeholders.provinces') }}">##$item.name##</ui-select-match>
                <ui-select-choices repeat="province in search.state.provinces | filter: $item.search">
                    <div ng-bind-html="province.name"></div>
                </ui-select-choices>
            </ui-select>
            <p ng-if="search.state.provinces_loading">{{ trans('search.loading') }}</p>
        </div>
    </div>

    <div class="search--block">
        <div class="">
            <label for="capacity">{{ trans('search.labels.capacity') }}</label>
            <rzslider rz-slider-model="search.state.searchObject.capacity_slider.minValue"
                      rz-slider-high="search.state.searchObject.capacity_slider.maxValue"
                      rz-slider-options="search.state.searchObject.capacity_slider.options" name="capacity"></rzslider>
        </div>
    </div>

    <div class="search--block">
        <div class="">
            <label for="price_per_night">{{ trans('search.labels.pricepernight') }}</label>
            <rzslider rz-slider-model="search.state.searchObject.price_slider.minValue"
                      rz-slider-high="search.state.searchObject.price_slider.maxValue"
                      rz-slider-options="search.state.searchObject.price_slider.options" name="price_per_night"></rzslider>
        </div>
    </div>

    <div class="search--block">
        <div class="">
            <label for="">{{ trans('search.labels.facilities') }}</label>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.hasbuilding" data-toggle="collapse" data-target="#building-facility-info">{{ trans('search.labels.building') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.hasmeadow" data-toggle="collapse" data-target="#meadow-facility-info">{{ trans('search.labels.meadow') }}</label>
            </div>
        </div>
    </div>

    <div class="collapse" id="building-facility-info" ng-if="search.state.searchObject.hasbuilding">
        <div class="search--block">
            <label for="">{{ trans('search.labels.buildingoptions') }}</label>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.has_wifi">{{ trans('search.labels.options.wifi') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.has_electricity">{{ trans('search.labels.options.electricity') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.has_water">{{ trans('search.labels.options.water') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.has_kitchen">{{ trans('search.labels.options.kitchen') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.beds">{{ trans('search.labels.options.beds') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.showers">{{ trans('search.labels.options.showers') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.toilets">{{ trans('search.labels.options.toilets') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.wheelchair_accessible">{{ trans('search.labels.options.wheelchair') }}</label>
            </div>
        </div>
    </div>

    <div class="collapse" id="meadow-facility-info" ng-if="search.state.searchObject.hasmeadow">
        <div class="search--block">
            <label for="">{{ trans('search.labels.meadowoptions') }}</label>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.meadowoptions.tents_allowed">{{ trans('search.labels.options.tentsallowed') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.meadowoptions.has_electricity">{{ trans('search.labels.options.electricity') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.meadowoptions.has_water">{{ trans('search.labels.options.water') }}</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.meadowoptions.campfire_allowed">{{ trans('search.labels.options.campfireallowed') }}</label>
            </div>
        </div>
    </div>

    <div class="search--block">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-secundary">{{ trans('search.buttons.search') }}</button>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <button type="button" class="btn btn-block btn-secundary-opposite" data-ng-click="search.handlers.resetFilters()">{{ trans('search.buttons.reset') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>