@extends('layouts.app')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary" onclick="javascript:window.location.href='/menuitems/add'">Add Booking</button>
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Bookings</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Guests</th>
                        <th>Total Rooms</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Active</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($links as $link)
                      <tr>
                        <td>{{ $link->id }}</td>
                        <td>{{ $link->start_date }}</td>
                        <td>{{ $link->end_date }}</td>
                        <td>{{ $link->total_guests }}</td>
                        <td>{{ $link->total_rooms }}</td>
                        <td>{{ $link->created_at }}</td>
                        <td>{{ $link->updated_at }}</td>
                        <td>{{ $link->is_active?'Yes':'No' }}</td>

                        <td><a href="{{action('RoomBookingController@edit', $link->id)}}" class="btn btn-warning">Edit</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="9">
                          {{ $links->links() }}
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                  <!-- <ul>
                  @foreach ($links as $link)
                      <li>{{ $link->name }}</li>
                  @endforeach
                  </ul>
                  {{ $links->links() }}
                -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
