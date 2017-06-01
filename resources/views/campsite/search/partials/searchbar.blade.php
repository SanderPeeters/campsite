<div class="form-group">
    <label for="campsite_name">Campsite Name</label>
    <input type="text" class="form-control" name="campsite_name" ng-model="search.state.searchObject.campsite_name" placeholder="Search on name...">
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