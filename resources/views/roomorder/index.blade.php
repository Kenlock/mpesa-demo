@extends('layouts.room')

@section('content')
<script src="{{ asset('js/order.js') }}" defer></script>

<div class="container">

    <h3 class="text-center">Current Room is : {{ $current_room }}</h3>
    <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Room</div>

              <div class="card-body">
      @if($info)
        Guest Name: {{$info['guest_name']}} <br />
        Start Date: {{$info['rented_start']}} <br />
        End Date: {{$info['rented_end']}} <br />
      @else
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
</script>
@endsection
