<section id="section-my-reservations">
    <h2 class="color-secundary">Pending requests</h2>
    <div class="table-responsive">
        <table class="table table-condensed">
            <thead>
            <tr>
                <td>Campsite</td>
                <td>{{ trans('reservation.labels.date-of-arrival') }}</td>
                <td>{{ trans('reservation.labels.date-of-departure') }}</td>
                <td>Capacity</td>
                <td>Contact email</td>
            </tr>
            </thead>
            <tbody>
            @foreach(Auth::user()->reservations->sortBy('start_date') as $reservation)
                @if($reservation->pending_request == 1 && $reservation->accepted_request == 0)
                    <tr>
                        <td>{{ $reservation->campsite->campsite_name }}</td>
                        <td>{{\Carbon\Carbon::parse($reservation->start_date)->format('d/m/y')}}</td>
                        <td>{{\Carbon\Carbon::parse($reservation->end_date)->format('d/m/y')}}</td>
                        <td>{{$reservation->capacity}}</td>
                        <td>{{$reservation->campsite->user->email}}</td>
                        <td>
                            <a href="{{ route('reservation.delete', ['id' => $reservation->id])}}" target="_self">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

    <h2 class="color-secundary">Accepted requests</h2>
    <div class="table-responsive">
        <table class="table table-condensed">
            <thead>
            <tr>
                <td>Campsite</td>
                <td>{{ trans('reservation.labels.date-of-arrival') }}</td>
                <td>{{ trans('reservation.labels.date-of-departure') }}</td>
                <td>Capacity</td>
                <td>Contact email</td>
            </tr>
            </thead>
            <tbody>
            @foreach(Auth::user()->reservations->sortBy('start_date') as $reservation)
                @if($reservation->accepted_request == 1 && $reservation->pending_request == 0)
                    <tr>
                        <td>{{ trans('movements.'.$reservation->movement_id) }}</td>
                        <td>{{\Carbon\Carbon::parse($reservation->start_date)->format('d/m/y')}}</td>
                        <td>{{\Carbon\Carbon::parse($reservation->end_date)->format('d/m/y')}}</td>
                        <td>{{$reservation->capacity}}</td>
                        <td>{{$reservation->campsite->user->email}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</section>