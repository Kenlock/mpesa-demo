@extends('layouts.room')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order</div>
                <div class="card-body">
                  <form class="form" method="post" >
                    {{ csrf_field() }}
                  <table id="orderTable" class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th style="width: 60%">Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($menuorders as $key => $menuorder)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $menuorder->name }}</td>
                        <td>{{ $menuorder->name }}</td>
                        <td>{{ $menuorder->item_price }}</td>
                        <td></td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
