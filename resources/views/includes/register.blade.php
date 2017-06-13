<section id="new-offer-campsite" class="campsite-offer p-t-40">
    <div class="container text-center">
        <div class="row m-b-20">
            <div class="col-sm-6 col-sm-offset-3">
                <h3 class="color-white uppercase">{{ Auth::guest() || !Auth::user()->campsite ? trans('includes.titles.offercampsite') : trans('includes.titles.mycampsite') }}</h3>
                <hr class="color-primary w-20--p m-t-0">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                @if (Auth::guest() || !Auth::user()->campsite)
                    <h2 class="color-light-grey">
                        {!! trans('includes.titles.big.offercampsite') !!}
                    </h2>
                    <a href="{{ route('register') }}" target="_self">
                        <button type="button" class="btn btn-white p-t-10 p-b-10 p-l-40 p-r-40 m-t-60">
                            {{ Auth::guest() ? trans('forms.buttons.register') : trans('forms.buttons.offercampsite')}}
                        </button>
                    </a>
                @else
                    <h2 class="color-light-grey">
                        {!! trans('includes.titles.big.mycampsite') !!}
                    </h2>
                    <a href="{{ route('offer-campsite') }}" target="_self">
                        <button type="button" class="btn btn-white p-t-10 p-b-10 p-l-40 p-r-40 m-t-60">
                            {{ trans('forms.buttons.mycampsite') }}
                        </button>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>