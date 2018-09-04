@extends('layouts.app')

@section('content')
<script src="{{ asset('js/booking.js') }}" defer></script>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking</div>

                <div class="card-body">

                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="true">Search Rooms</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="rooms-tab" data-toggle="tab" href="#rooms" role="tab" aria-controls="rooms" aria-selected="false">Select Room</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="guests-tab" data-toggle="tab" href="#guests" role="tab" aria-controls="guests" aria-selected="false">Guest Information</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="confirm-tab" data-toggle="tab" href="#confirm" role="tab" aria-controls="confirm" aria-selected="false">Confirm Booking</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="search" role="tabpanel" aria-labelledby="search-tab">
                      <form class="form" name="search_form" method="post" >
                        {{ csrf_field() }}

                        <div class="form-group">
                          <label for="name">Total Guests</label>
                          <input type="number" class="form-control" placeholder="Total Guests" name="total_guests" id="total_guests" />
                        </div>

                        <div class="form-group">
                          <label for="name">Total Rooms</label>
                          <input type="number" class="form-control" placeholder="Total Rooms" name="total_rooms" id="total_rooms" />
                        </div>

                        <div class="form-group">
                          <label for="name">Start Date</label>
                          <input type="date" class="form-control" placeholder="Start Date" name="start_date" id="start_date" />
                        </div>

                        <div class="form-group">
                          <label for="name">End Date</label>
                          <input type="date" class="form-control" placeholder="End Date" name="end_date" id="end_date" />
                        </div>

                        <div class="form-group">
                          <button type="button" onClick="saveBookingSearch()" class="btn btn-primary mb-2">Next</button>
                          <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/booking'">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane fade" id="rooms" role="tabpanel" aria-labelledby="rooms-tab">
                      <form class="form" name="rooms_form" method="post" >
                        {{ csrf_field() }}
                        <div class="row room-row">
                          <label class="lbl-room" > Room 1 </label>
                          <div class="form-group">
                            <!-- <label class="lbl-rt" for="room_type"> Select Room type 1 </label> -->
                            <select name="room_type[]" id="room_type" class="form-input" onChange="javascript:changeRoomType(this) ">
                              <option value="">Select Room Type</option>
                              @foreach ($roomtypes as $roomtype)
                                <option value="{{ $roomtype->id }}">{{ $roomtype->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <!-- <label class="lbl-r" for="room"> Select Room 1 </label> -->
                            <select name="room[]" id="room" class="form-input" >
                              <option value="">Select Room</option>

                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="button" onClick="saveBookingRooms()" class="btn btn-primary mb-2">Next</button>
                          <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/booking'">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane fade" id="guests" role="tabpanel" aria-labelledby="guests-tab">
                      <form class="form" name="guests_form" method="post" >
                      {{ csrf_field() }}

                      <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" />
                      </div>
                      <div class="form-group">
                        <label for="name">Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" />
                      </div>

                      <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" class="form-control" placeholder="Address" name="address" id="address" />
                      </div>

                      <div class="form-group">
                        <label for="name">City</label>
                        <input type="text" class="form-control" placeholder="City" name="city" id="city" />
                      </div>

                      <div class="form-group">
                        <label for="name">State</label>
                        <input type="text" class="form-control" placeholder="State" name="state" id="state" />
                      </div>

                      <div class="form-group">
                        <label for="name">Pincode</label>
                        <input type="text" class="form-control" placeholder="Pincode" name="pincode" id="pincode" />
                      </div>

                      <div class="form-group">
                        <label for="name">ID Proof Type 1</label>
                        <input type="text" class="form-control" placeholder="ID Proof Type 1" name="id_proof_type1" id="id_proof_type1" />
                      </div>

                      <div class="form-group">
                        <label for="name">ID Proof 1</label>
                        <input type="text" class="form-control" placeholder="ID Proof 1" name="id_proof1" id="id_proof1" />
                      </div>

                      <div class="form-group">
                        <label for="name">ID Proof Type 2</label>
                        <input type="text" class="form-control" placeholder="ID Proof Type 2" name="id_proof_type2" id="id_proof_type2" />
                      </div>

                      <div class="form-group">
                        <label for="name">ID Proof 2</label>
                        <input type="text" class="form-control" placeholder="ID Proof 1" name="id_proof2" id="id_proof2" />
                      </div>

                      <div class="form-group">
                        <label for="name">Address Proof Type 1</label>
                        <input type="text" class="form-control" placeholder="Address Proof Type 1" name="address_proof_type1" id="address_proof_type1" />
                      </div>

                      <div class="form-group">
                        <label for="name">Address Proof 1</label>
                        <input type="text" class="form-control" placeholder="Address Proof 1" name="address_proof1" id="address_proof1" />
                      </div>

                      <div class="form-group">
                        <label for="name">Address Proof Type 2</label>
                        <input type="text" class="form-control" placeholder="Address Proof Type 2" name="address_proof_type2" id="address_proof_type2" />
                      </div>

                      <div class="form-group">
                        <label for="name">Address Proof 2</label>
                        <input type="text" class="form-control" placeholder="Address Proof 2" name="address_proof2" id="address_proof2" />
                      </div>

                      <div class="form-group">
                        <button type="button" onClick="saveBookingGuests()" class="btn btn-primary mb-2">Next</button>
                        <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/booking'">Cancel</button>
                      </div>
                    </form></div>
                    <div class="tab-pane fade" id="confirm" role="tabpanel" aria-labelledby="confirm-tab">
                      <form class="form" name="confirm_form" method="post" >
                        {{ csrf_field() }}
                        Confirm Booking ?

                        <div class="form-group">
                          <button type="button" onClick="saveBooking()" class="btn btn-primary mb-2">Confirm</button>
                          <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/booking'">Cancel</button>
                        </div>
                      </form>
                    </div>
                  </div>

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
