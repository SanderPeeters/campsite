<form name="searchcampsiteform" ng-submit="search.handlers.search()">
    <div class="search--block greybg">
        <div class="form-group">
            <label for="campsite_name">Campsite Name</label>
            <input type="text" class="form-control" name="campsite_name" ng-model="search.state.searchObject.campsite_name" placeholder="Search on name...">
        </div>
    </div>

    <div class="search--block">
        <div class="form-group">
            <label for="capacity">Size of group</label>
            <rzslider rz-slider-model="search.state.searchObject.capacity_slider.minValue"
                      rz-slider-high="search.state.searchObject.capacity_slider.maxValue"
                      rz-slider-options="search.state.searchObject.capacity_slider.options" name="capacity"></rzslider>
        </div>
    </div>

    <div class="search--block">
        <div class="form-group">
            <label for="price_per_night">Price per night</label>
            <rzslider rz-slider-model="search.state.searchObject.price_slider.minValue"
                      rz-slider-high="search.state.searchObject.price_slider.maxValue"
                      rz-slider-options="search.state.searchObject.price_slider.options" name="price_per_night"></rzslider>
        </div>
    </div>

    <div class="search--block">
        <div class="form-group">
            <label for="">Facilities</label>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.hasbuilding">Building</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.hasmeadow">Meadow</label>
            </div>
        </div>
    </div>

    <div class="form-group" id="building-facility-info" ng-if="search.state.searchObject.hasbuilding">
        <div class="search--block">
            <label for="">Building options</label>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.has_wifi">Wifi</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.has_electricity">Electricity</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.has_water">Water</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.buildingoptions.has_kitchen">Kitchen</label>
            </div>
        </div>
    </div>

    <div class="form-group" id="meadow-facility-info" ng-if="search.state.searchObject.hasmeadow">
        <div class="search--block">
            <label for="">Meadow options</label>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.meadowoptions.tents_allowed">Tents allowed</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.meadowoptions.has_electricity">Electricity</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.meadowoptions.has_water">Water</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" value="1" ng-model="search.state.searchObject.meadowoptions.campfire_allowed">Campfires allowed</label>
            </div>
        </div>
    </div>

    <div class="search--block">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-secundary">Search</button>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <button type="button" class="btn btn-block btn-secundary-opposite" data-ng-click="search.handlers.resetFilters()">Reset</button>
                </div>
            </div>
        </div>
    </div>
</form>