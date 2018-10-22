@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">STK Push Inititate</div>

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
                      <label for="key">Amount</label>
                      <input type="text" class="form-control" placeholder="Amount" name="amount" id="amount" />
                    </div>

                    <div class="form-group">
                      <label for="name">Phone Number</label>
                      <input type="text" class="form-control" placeholder="Phone Number" name="phonenumber" id="phonenumber" />
                    </div>

                    <div class="form-group">
                      <label for="city">reference</label>
                      <input type="text" name="reference" id="reference" class="form-control" placeholder="reference" />
                    </div>

                      <div class="form-group">
                          <label for="address">Transaction Description</label>
                          <textarea name="transactiondesc" id="transactiondesc" class="form-control" ></textarea>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary mb-2">Pay</button>
                          <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/stk'">Cancel</button>

                      </div>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
