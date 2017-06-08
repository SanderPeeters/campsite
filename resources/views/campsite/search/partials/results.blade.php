<div ng-if="search.state.noresultsfound">
    <div class="row text-center">
        <div class="col-sm-12">
            <p class="m-t-60 m-b-60">No results match your search criteria</p>
        </div>
    </div>
</div>
<div class="result" ng-repeat="campsite in search.state.campsite_offers">
    <div class="row">
        <div class="col-sm-6 wrapper">
            <div class="result__image">
                <a href="{{ app()->getLocale() }}/campsite/##campsite.id##" target="_self">
                    <img ng-if="campsite.campimages.length" src="/img/campsites/##campsite.campimages[0].filename##">
                    <img ng-if="!campsite.campimages.length" ng-src='/assets/img/defaults/default-campsite-1.jpg' >
                </a>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="result__info">
                <p class="result__info--address">##campsite.state.name## - ##campsite.province.name## - ##campsite.city##</p>
                <a href="{{ app()->getLocale() }}/campsite/##campsite.id##" target="_self">
                    <h3 class="result__info--name">##campsite.campsite_name##</h3>
                </a>
            </div>
        </div>
    </div>
</div>