@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Simulate C2B</div>

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
                      <label for="CommandID">Command ID</label>
                      <input type="text" class="form-control" placeholder="CommandID" name="CommandID" id="CommandID" />
                    </div>

                    <div class="form-group">
                      <label for="Msisdn">Msisdn</label>
                      <input type="text" name="Msisdn" id="Msisdn" class="form-control" placeholder="Msisdn" />
                    </div>

                      <div class="form-group">
                          <label for="BillRefNumber">Bill Ref Number</label>
                          <input type="text" name="BillRefNumber" id="BillRefNumber" class="form-control" placeholder="BillRefNumber" />
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary mb-2">Simulate</button>
                          <button type="button" class="btn btn-danger mb-2" onclick="javascript:window.location.href='/c2b'">Cancel</button>

                      </div>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
