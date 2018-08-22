@extends('layouts.app')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary" onclick="javascript:window.location.href='/rooms/add'">Add Room</button>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rooms</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Room Number</th>
                        <th>Room Type</th>
                        <th>Occupied</th>
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
                        <td>{{ $link->room_no }}</td>
                        <td>{{ $link->roomType->name }}</td>
                        <td>{{ $link->occupied }}</td>
                        <td>{{ $link->created_at }}</td>
                        <td>{{ $link->updated_at }}</td>
                        <td>{{ $link->is_active?'Yes':'No' }}</td>

                        <td><a href="{{action('RoomController@edit', $link->id)}}" class="btn btn-warning">Edit</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4">
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
