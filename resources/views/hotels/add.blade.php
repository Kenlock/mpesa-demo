@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hotels</div>

                <div class="card-body">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                  <form class="form" method="post" >
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="key">Key</label>
                      <input type="text" class="form-control" placeholder="Key" name="key" id="key" />
                    </div>

                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" placeholder="Name" name="name" id="name" />
                    </div>

                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea name="address" id="address" class="form-control" ></textarea>
                    </div>

                    <div class="form-group">
                      <label for="city">City</label>
                      <input type="text" name="city" id="city" class="form-control" placeholder="City" />
                    </div>

                    <div class="form-group">
                      <label for="state">State</label>
                      <input type="text" name="state" id="state" class="form-control" placeholder="State" />
                    </div>

                    <div class="form-group">
                      <label for="pincode">Pincode</label>
                      <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pincode" />
                    </div>

                    <div class="form-group">
                      <label for="contact_name">Contact Name</label>
                      <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Contact Name" />
                    </div>

                    <div class="form-group">
                      <label for="phone1">Phone 1</label>
                      <input type="text" name="phone1" id="phone1" class="form-control" placeholder="Phone 1" />
                    </div>

                    <div class="form-group">
                      <label for="phone2">Phone 2</label>
                      <input type="text" name="phone2" id="phone2" class="form-control" placeholder="Phone 2" />
                    </div>

                    <div class="form-check">
                      <input type="checkbox" value="1" name="is_active" id="is_active" class="form-check-input" />
                      <label for="is_active" class="form-check-label">Is Active</label>

                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary mb-2">Save</button>
                      <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/hotels'">Cancel</button>

                    </div>


                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
