@extends('layouts.app')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary" onclick="javascript:window.location.href='/b2c/add'">Initiate B2C</button>
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">Busines To Consumer Transactions</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Response</th>
                        <th>Result</th>
                        <th>Conversation ID</th>
                        <th>Originator</th>
                        <th>Receipt</th>
                        <th>Amount</th>
                        <th>Currency</th>
                        <th>Charges</th>
                        <th>Receiver</th>
                        <th>Time</th>
                        <th>Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($b2c as $trans)
                      <tr>
                        <td>{{ $trans->id }}</td>
                        <td>{{ $trans->response_code }}</td>
                        <td>{{ $trans->result_code }}</td>
                        <td>{{ $trans->conversation_id }}</td>
                        <td>{{ $trans->originator_conversation_id }}</td>
                        <td>{{ $trans->transaction_id }}</td>
                        <td>{{ $trans->amount }}</td>
                        <td>{{ $trans->currency }}</td>
                        <td>{{ $trans->debit_party_charges }}</td>
                        <td>{{ $trans->receiver_party_public_name }}</td>
                        <td>{{ $trans->trans_completed_time }}</td>
                        <td>{{ $trans->result_description }}</td>
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
                  @foreach ($b2c as $trans)
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
