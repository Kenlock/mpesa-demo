@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Simulate B2C</div>

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
                  @if(session()->has('success'))
                      <div class="alert alert-success">
                          {{ session()->get('success') }}
                      </div>
                  @endif
                  <form class="form" method="post" >
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="amount">Amount</label>
                      <input type="text" class="form-control" placeholder="Amount" name="amount" id="amount" />
                    </div>

                    <div class="form-group">
                      <label for="phonenumber">Phone Number</label>
                      <input type="text" class="form-control" placeholder="Phone Number" name="phonenumber" id="phonenumber" />
                    </div>

                      <div class="form-group">
                          <label for="CommandID">Command ID</label>
                          <input type="text" name="CommandID" id="CommandID" class="form-control" placeholder="CommandID" />
                      </div>

                    <div class="form-group">
                      <label for="remarks">Remarks</label>
                      <input type="text" name="remarks" id="remarks" class="form-control" placeholder="remarks" />
                    </div>

                      <div class="form-group">
                          <label for="occasion">Occassion</label>
                          <textarea name="occasion" id="occasion" class="form-control" ></textarea>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary mb-2">Simulate</button>
                          <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/b2c'">Cancel</button>

                      </div>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
