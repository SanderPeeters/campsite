<div class="form-group">
    <label for="campsite_name">Campsite Name</label>
    <input type="text" class="form-control" name="campsite_name" ng-model="search.state.searchObject.campsite_name" placeholder="Search on name...">
</div>
<div class="form-group">
    <label for="capacity">Size of group</label>
    <rzslider rz-slider-model="search.state.searchObject.capacity_slider.minValue"
              rz-slider-high="search.state.searchObject.capacity_slider.maxValue"
              rz-slider-options="search.state.searchObject.capacity_slider.options" name="capacity"></rzslider>
</div>
<div class="form-group">
    <label for="price_per_night">Price per night</label>
    <rzslider rz-slider-model="search.state.searchObject.price_slider.minValue"
              rz-slider-high="search.state.searchObject.price_slider.maxValue"
              rz-slider-options="search.state.searchObject.price_slider.options" name="price_per_night"></rzslider>
</div>
<div class="form-group">
    <label for="">Facilities</label>
    <div class="checkbox">
        <label><input type="checkbox" value="1" ng-model="search.state.searchObject.facilities.building">Building</label>
    </div>
    <div class="checkbox">
        <input type="hidden" value="0" ng-model="search.state.searchObject.facilities.meadow">
        <label><input type="checkbox" value="1" ng-model="search.state.searchObject.facilities.meadow">Meadow</label>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-main" data-ng-click="search.handlers.search()">Search</button>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <button type="button" class="btn btn-block btn-white" data-ng-click="search.handlers.resetFilters()">Reset</button>
        </div>
    </div>
</div>