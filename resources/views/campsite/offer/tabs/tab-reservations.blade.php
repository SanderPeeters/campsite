<h2 class="color-secundary">{{ trans('reservation.pending') }}</h2>
<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>{{ trans('reservation.movement') }}</th>
            <th>{{ trans('reservation.labels.date-of-arrival') }}</th>
            <th>{{ trans('reservation.labels.date-of-departure') }}</th>
            <th>{{ trans('reservation.capacity') }}</th>
            <th>{{ trans('reservation.contactemail') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($campsite->reservations->sortBy('start_date') as $reservation)
            @if($reservation->pending_request == 1 && $reservation->accepted_request == 0)
                <tr>
                    <td>{{ trans('movements.'.$reservation->movement_id) }}</td>
                    <td>{{\Carbon\Carbon::parse($reservation->start_date)->format('d/m/y')}}</td>
                    <td>{{\Carbon\Carbon::parse($reservation->end_date)->format('d/m/y')}}</td>
                    <td>{{$reservation->capacity}}</td>
                    <td>{{$reservation->user->email}}</td>
                    <td>
                        <a href="{{ route('reservation.accept', ['id' => $reservation->id])}}" target="_self">
                            <button class="btn btn-secundary">{{ trans('forms.buttons.accept') }}</button>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('reservation.delete', ['id' => $reservation->id])}}" target="_self">
                            <button class="btn btn-danger">{{ trans('forms.buttons.delete') }}</button>
                        </a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>

<h2 class="color-secundary">{{ trans('reservation.accepted') }}</h2>
<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>{{ trans('reservation.movement') }}</th>
            <th>{{ trans('reservation.labels.date-of-arrival') }}</th>
            <th>{{ trans('reservation.labels.date-of-departure') }}</th>
            <th>{{ trans('reservation.capacity') }}</th>
            <th>{{ trans('reservation.contactemail') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($campsite->reservations->sortBy('start_date') as $reservation)
            @if($reservation->accepted_request == 1 && $reservation->pending_request == 0)
                <tr>
                    <td>{{ trans('movements.'.$reservation->movement_id) }}</td>
                    <td>{{\Carbon\Carbon::parse($reservation->start_date)->format('d/m/y')}}</td>
                    <td>{{\Carbon\Carbon::parse($reservation->end_date)->format('d/m/y')}}</td>
                    <td>{{$reservation->capacity}}</td>
                    <td>{{$reservation->user->email}}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>