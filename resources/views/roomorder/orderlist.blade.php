@extends('layouts.room')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Room Orders</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Order Time</th>
                        <th>Order Amount</th>
                        <th>Fullfilled</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($links as $key => $link)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $link->order_date }}</td>
                        <td>{{ $link->total_price }}</td>
                        <td>{{ $link->order_fullfilled }}</td>
                        <td><a href="{{action('RoomOrderController@view', $link->id)}}" class="btn btn-info">View</a> </td>
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
