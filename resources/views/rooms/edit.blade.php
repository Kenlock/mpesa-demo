@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rooms</div>

                <div class="card-body">

                  <form class="form" method="post" >
                    {{ csrf_field() }}

                    <div class="form-group">
                      <label for="name">Room No</label>
                      <input type="text" class="form-control" placeholder="Room No" name="room_no" value="{{ $room->room_no }}" id="room_no" />
                    </div>

                    <div class="form-group">
                      <label for="price"> Room Type</label>
                      <select class="form-control" name="room_type" id="room_type" >
                        <option value="">Select Room Type</option>
                        @foreach ($roomtypes as $roomtype)
                          <option value="{{ $roomtype->id }}" {{ $roomtype->id === $room->room_type_id?'selected':'' }}>{{ $roomtype->name }}</option>
                        @endforeach
                      </select>

                    </div>

                    <div class="form-check">
                      <input type="checkbox" value="1" {{$room->is_active=='1'?'checked':''}} name="is_active" id="is_active" class="form-check-input" />
                      <label for="is_active" class="form-check-label">Is Active</label>

                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary mb-2">Save</button>
                      <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/rooms'">Cancel</button>

                    </div>


                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
