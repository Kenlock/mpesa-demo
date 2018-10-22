@extends('layouts.app')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary" onclick="javascript:window.location.href='/c2b/add'">Simulate C2B</button>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Consumer To Business Transactions</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                          <th>Trans ID</th>
                          <th>First Name</th>
                          <th>Middle Name</th>
                          <th>Last Name</th>
                        <th>Type</th>
                          <th>Amount</th>
                        <th>ShortCode</th>
                        <th>Bill Ref Number</th>
                        <th>Msisdn</th>
                        <th>Invoice Number</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($c2b as $trans)
                      <tr>
                        <td>{{ $trans->id }}</td>
                          <td>{{ $trans->trans_id }}</td>
                          <td>{{ $trans->first_name }}</td>
                          <td>{{ $trans->middle_name }}</td>
                          <td>{{ $trans->last_name }}</td>
                          <td>{{ $trans->transaction_type }}</td>
                        <td>{{ $trans->trans_amount }}</td>
                        <td>{{ $trans->business_short_code }}</td>
                        <td>{{ $trans->bill_ref_number }}</td>
                          <td>{{ $trans->msisdn }}</td>
                          <td>{{ $trans->invoice_number }}</td>

                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4">
                          {{--{{ $links->links() }}--}}
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                  <!-- <ul>
                  @foreach ($c2b as $trans)
                      {{--<li>{{ $link->name }}</li>--}}
                  @endforeach
                  </ul>
                  {{--{{ $links->links() }}--}}
                -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
