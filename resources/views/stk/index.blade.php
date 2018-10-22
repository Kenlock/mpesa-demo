@extends('layouts.app')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary" onclick="javascript:window.location.href='/stk/add'">Initiate STK Push</button>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">STK Transactions</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Result Code</th>
                        <th>ResponseCode</th>
                        <th>Merchant Request ID</th>
                        <th>Receipt</th>
                        <th>Transaction Date</th>
                        <th>Phone Number</th>
                        <th>Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($stk as $trans)
                      <tr>
                        <td>{{ $trans->id }}</td>
                        <td>{{ $trans->result_code }}</td>
                        <td>{{ $trans->response_code }}</td>
                        <td>{{ $trans->merchant_request_id }}</td>
                        <td>{{ $trans->mpesa_receipt_number }}</td>
                        <td>{{ $trans->transaction_date }}</td>
                        <td>{{ $trans->phone_number }}</td>
                        <td>{{ $trans->result_desc }}</td>

                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="8">
                          {{--{{ $stk->stkTrans() }}--}}
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                  <!-- <ul>
                  @foreach ($stk as $trans)
                      {{--<li>{{ $trans->name }}</li>--}}
                  @endforeach
                  </ul>
                  {{--{{ $stk->stkTrans() }}--}}
                -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
