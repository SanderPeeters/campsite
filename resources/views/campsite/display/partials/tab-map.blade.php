<div class="row legend">
    <div class="col-sm-3 col-xs-6">
        <p>
            <img src="/assets/img/icons/map-marker-green.svg" alt="">
            {{ $campsite->campsite_name }}
        </p>
    </div>
    <div class="col-sm-3 col-xs-6">
        <p>
            <img src="/assets/img/icons/map-marker-grey.svg" alt="">
            {{ trans( 'campsite.supermarkets' ) }}
        </p>
    </div>
    <div class="col-sm-3 col-xs-6">
        <p>
            <img src="/assets/img/icons/map-marker-blue.svg" alt="">
            {{ trans( 'campsite.parks' ) }}
        </p>
    </div>
    <div class="col-sm-3 col-xs-6">
        <p>
            <img src="/assets/img/icons/map-marker-red.svg" alt="">
            {{ trans( 'campsite.doctors' ) }}
        </p>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div id="map" style="width:100%; height: 400px;">

        </div>
    </div>
</div>