<div ng-if="search.state.noresultsfound">
    <div class="row text-center">
        <div class="col-sm-12">
            <p class="m-t-60 m-b-60">No results match your search criteria</p>
        </div>
    </div>
</div>
<div class="result" ng-repeat="campsite in search.state.campsite_offers | limitTo:search.state.paginationSettings.pageLimit:search.state.paginationSettings.offset" ng-if="!campsite['province']">
    <div class="row" vertilize-container>
        <div class="col-sm-6 wrapper" vertilize>
            <div class="result__image">
                <a href="{{ app()->getLocale() }}/campsite/##campsite[0].id##" target="_self">
                    <img ng-if="campsite[0].campimages.length" src="/img/campsites/##campsite[0].campimages[0].filename##">
                    <img ng-if="!campsite[0].campimages.length" ng-src='/assets/img/defaults/default-campsite-1.jpg' >
                </a>
            </div>
        </div>
        <div class="col-sm-6" vertilize>
            <div class="result__info">
                <p class="result__info--address">##campsite[0].state.name## - ##campsite[0].province.name## - ##campsite[0].city##</p>
                <a href="{{ app()->getLocale() }}/campsite/##campsite[0].id##" target="_self">
                    <h3 class="result__info--name">##campsite[0].campsite_name##</h3>
                </a>
                <p>
                    Price: €##campsite[0].price_per_night##
                </p>
                <p>
                    Group Capacity: ##campsite.totalcapacity##
                </p>
                <div ng-if="campsite.haselectricity" class="icon--small">
                    <img src="/assets/img/icons/icon-plug.svg" alt="">
                </div>
                <div ng-if="campsite.haswater" class="icon--small">
                    <img src="/assets/img/icons/icon-tap.svg" alt="">
                </div>
                <div ng-if="campsite.haskitchen" class="icon--small">
                    <img src="/assets/img/icons/icon-pot.svg" alt="">
                </div>
                <div ng-if="campsite.haswifi" class="icon--small">
                    <img src="/assets/img/icons/icon-wifi.svg" alt="">
                </div>
                <div ng-if="campsite.tentsallowed" class="icon--small">
                    <img src="/assets/img/icons/icon-tent-green.svg" alt="">
                </div>
                <div ng-if="campsite.campfireallowed" class="icon--small">
                    <img src="/assets/img/icons/icon-bonfire-green.svg" alt="">
                </div>
                <div class="left-positioned">
                    <a href="{{ app()->getLocale() }}/campsite/##campsite[0].id##" target="_self">
                    <button class="btn btn-secundary-opposite p-l-20 p-r-20">More info</button>
                    </a>
                </div>
                <div class="icon--wrapper right-positioned">
                    <img src="/assets/img/defaults/##campsite[0].user.movement.filename##" alt="">
                </div>
            </div>
        </div>
    </div>
</div>