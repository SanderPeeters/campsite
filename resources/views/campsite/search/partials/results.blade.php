<div class="result" ng-repeat="campsite in search.state.campsite_offers">
    <div class="row">
        <div class="col-sm-6 wrapper">
            <div class="result__image">
                <img src="/img/campsites/##campsite.campimages[0].filename##">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="result__info">
                <p class="result__info--address">##campsite.province## - ##campsite.city##</p>
                <a href="http://placehold.it" target="_self">
                    <h3 class="result__info--name">##campsite.campsite_name##</h3>
                </a>

            </div>
        </div>
    </div>
</div>