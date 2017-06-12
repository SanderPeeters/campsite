<section id="section-my-savings">
    @if(Auth::user()->savings->count())
        @foreach (Auth::user()->savings as $campsite)
            <div class="col-md-6 col-xs-12">
                <div class="card">
                    <a href="">
                        <div class="img" style="background-image: url('{{ asset('img/campsites/'.$campsite->campimages[0]->filename) }}');">
                            <div class="card-title">
                                <h3 class="overlay-text center text-center">CLICK FOR DETAILS</h3>
                                <h4>{{ $campsite->campsite_name }}</h4>
                                <p></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    @else
        <h3 class="m-t-40">You have no saved Campsites</h3>
    @endif
</section>