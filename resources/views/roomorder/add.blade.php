@extends('layouts.app')

@section('content')
<script src="{{ asset('js/order.js') }}" defer></script>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking</div>

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
                      @foreach ($menuitems as $key => $menuitem)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $menuitem->name }}</td>
                        <td><input type="number"  style="width: 100px;" onchange="changeQty(this);" value="0" name="item_qty[{{$menuitem->id}}]" class="form-control qty" /></td>
                        <td>{{$menuitem->item_price}}</td>
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
                  <button type="submit" onClickqa="saveOrder()" class="btn btn-primary mb-2">Save Order</button>
                  <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/roomorder'">Cancel</button>
                </form>




                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function () {
  initPage();
});
  /*$(function () {
    $.extend(true, $.fn.datetimepicker.defaults, {
   icons: {
     time: 'far fa-clock',
     date: 'far fa-calendar',
     up: 'fas fa-arrow-up',
     down: 'fas fa-arrow-down',
     previous: 'fas fa-chevron-left',
     next: 'fas fa-chevron-right',
     today: 'fas fa-calendar-check',
     clear: 'far fa-trash-alt',
     close: 'far fa-times-circle'
   }
 });

    console.log($('#start_date'));
    $('#start_date').datetimepicker();
    $('#end_date').datetimepicker();
  });*/
</script>

@endsection
