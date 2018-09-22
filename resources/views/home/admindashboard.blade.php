@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-10">
          <div class="card">
              <div class="card-header">Rooms</div>

              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Room</th>
                      <th>Booked ?</th>
                      <th>Booking ID</th>
                      <th>Booking Date Start</th>
                      <th>Booking Date End</th>
                      <th>Guest Name</th>
                      <th>Guest Address</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($rooms as $room)
                    <tr>
                      <td>{{ $room->room_no }}</td>
                      <td>{{ $room->occupied }}</td>
                      <td>{{ $room->booking_id }}</td>
                      <td>{{ $room->start_date }}</td>
                      <td>{{ $room->end_date }}</td>
                      <td>{{ $room->first_name }} {{ $room->last_name }}</td>
                      <td>{{ $room->city }} {{ $room->state }}</td>

                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4">

                      </td>
                    </tr>
                  </tfoot>
                </table>

              </div>
          </div>
      </div>
  </div>
</div>
@endsection
