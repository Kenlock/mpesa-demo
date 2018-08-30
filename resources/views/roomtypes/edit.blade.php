@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Room Types</div>

                <div class="card-body">

                  <form class="form" method="post" >
                    {{ csrf_field() }}

                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" value="{{$roomtype->name}}" placeholder="Name" name="name" id="name" />
                    </div>
                    <div class="form-group">
                      <label for="price">Price</label>
                      <input type="text" class="form-control" value="{{$roomtype->price}}" placeholder="Price" name="price" id="price" />
                    </div>
                    <div class="form-check">
                      <input type="checkbox" value="1" {{$roomtype->is_active=='1'?'checked':''}} name="is_active" id="is_active" class="form-check-input" />
                      <label for="is_active" class="form-check-label">Is Active</label>

                    </div>

                    <div class="form-group">
                      <label for="facilities">Facilities</label>
                      roomtype_facilities
                      @foreach ($roomtype_facilities->get() as $facility)
                        <div class="form-group">
                          <div class="col-md-12">
                            <input type="text" class="form-control" value="{{ $facility->facility }}" placeholder="Facilities" name="facilities[]" id="facilities" />
                          </div>
                        </div>
                      @endforeach

                      @for ($i=0; $i < 10 - $roomtype_facilities->count(); $i++)
                      <div class="form-group">
                        <div class="col-md-12">
                          <input type="text" class="form-control" placeholder="Facilities" name="facilities[]" id="facilities" />
                        </div>
                      </div>
                      @endfor

                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary mb-2">Save</button>
                      <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/roomtypes'">Cancel</button>

                    </div>


                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
