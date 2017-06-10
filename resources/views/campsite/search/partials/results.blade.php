<div ng-if="search.state.noresultsfound">
    <div class="row text-center">
        <div class="col-sm-12">
            <p class="m-t-60 m-b-60">No results match your search criteria</p>
        </div>
    </div>
</div>
<div class="result" ng-repeat="campsite in search.state.campsite_offers">
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

                {{--<table class="table">
                    <tr>
                        <td class="text-center">
                            Buildings <br>
                            <span>##campsite.buildings.length##</span>
                        </td>
                        <td class="text-center">
                            Meadows <br>
                            <span>##campsite.meadows.length##</span>
                        </td>
                        <td class="text-center">
                            Price <br>
                            <span>##campsite.price_per_night##€</span>
                        </td>
                    </tr>
                </table>--}}

                <div class="icon--wrapper">
                    <img src="/assets/img/defaults/##campsite[0].user.movement.filename##" alt="">
                </div>
            </div>
        </div>
    </div>
</div>