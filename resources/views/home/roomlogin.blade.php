@extends('layouts.home')

@section('content')
<script src="{{ asset('js/order.js') }}" defer></script>

<div class="container">

    <h3 class="text-center">Current Room is : {{ $current_room }}</h3>
    <div class="row justify-content-center">

        <div class="col-md-6">
          @if($current_room)
            <button type="button" class="btn btn-primary" onclick="javascript:window.location.href='/roomorder/index'">Guest Recent Orders</button>

            <button type="button" class="btn btn-primary" onclick="javascript:window.location.href='/roomorder/add'">Add Order</button>
          @endif
            <div class="card">

                <div class="card-header">Choose Room</div>

                <form method="post" class="form" >
                  {{ csrf_field() }}

                  <div class="col-md-11">
                    <div class="form-group">
                      <label class="lbl-rt" for="room_type"> Select Room type </label>
                      <select name="room_type" id="room_type" class="form-input" onChange="javascript:changeRoomType(this) ">
                        <option value="">Select Room Type</option>
                        @foreach ($roomtypes as $roomtype)
                          <option value="{{ $roomtype->id }}">{{ $roomtype->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="lbl-r" for="room"> Select Room </label>
                      <select name="room" id="room" class="form-input" >
                        <option value="">Select Room</option>

                      </select>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary mb-2">Set Room</button>
                    </div>
                  </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
$(function () {
  initPage();
});
</script>
@endsection
