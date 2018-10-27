<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class b2cController extends Controller
{
    public function index() {
        $links = \App\B2c::paginate(config('app.default_pagination'));
        //echo '<pre>';
        //print_r($links);
        return view('b2c.index', ['b2c' => $links]);
    }

    public function add(Request $request) {
        if($request->has('CommandID'))
        {
            $validatedData = $request->validate([
                'CommandID' => 'required',
                'amount' => 'required',
                'occasion'=> 'required',
                'remarks' => 'required',
                'phonenumber' => 'required',
            ]);

            $InitiatorName = env("INITIATOR_NAME");
            $SecurityCredential = env("SECURITY_CREDENTIAL");
            $CommandID = $request->get('CommandID');
            $Amount =  $request->get('amount');
            $PartyA = env("PARTYA");
            $PartyB = $request->get('phonenumber');
            $Remarks = $request->get('remarks');
            $QueueTimeOutURL = env("QUEUE_TIME_OUT_URL");
            $ResultURL = env("B2C_RESULT_URL");
            $Occasion = $request->get('occasion');



            $mpesa= new \Ivantoz\Mpesa\Mpesa();

            $b2cTransaction=$mpesa->b2c($InitiatorName, $SecurityCredential, $CommandID, $Amount, $PartyA, $PartyB, $Remarks, $QueueTimeOutURL, $ResultURL, $Occasion);
            $resp = json_decode($b2cTransaction);

            if (isset($resp->errorCode)) {
                $message = $resp->errorMessage;
                return redirect('b2c/add')->withErrors($message);

            } else {
                $b2c = new \App\B2c;
                $b2c->originator_conversation_id = $resp->OriginatorConversationID;
                $b2c->conversation_id = $resp->ConversationID;
                $b2c->response_code = $resp->ResponseCode;
                $b2c->save();
                $message =  $resp->ResponseDescription;

                return redirect()->back()->withSuccess($message);
            }
        }
        return view('b2c.add', []);
    }

    public function QueueTimeOutURL(Request $request) {

        $mpesa = new \Ivantoz\Mpesa\TransactionCallbacks();

        $callbackData = $mpesa->processB2CRequestCallback();

        $jdata = json_decode($callbackData,true);

        $mpesa2= new \Ivantoz\Mpesa\Mpesa();

        $callbackData=$mpesa2->finishTransaction();


    }

    public function ResultURL(Request $request){

        $callbackJSONData=file_get_contents('php://input');
        $callbackData=json_decode($callbackJSONData);

        if ($callbackData->Result->ResultCode !== 0) {

            \App\B2c::where('originator_conversation_id', $callbackData->Result->OriginatorConversationID)
            ->update([
                'result_description' => $callbackData->Result->ResultDesc,
                'transaction_id' => $callbackData->Result->TransactionID,
                'result_code' => $callbackData->Result->ResultCode,
                'queue_timeout_url' => isset($callbackData->Result->ReferenceData->ReferenceItem->Value),
            ]);

        } else {
            $mpesa = new \Ivantoz\Mpesa\TransactionCallbacks();

            $callbackData = $mpesa->processB2CRequestCallback();

            $resp = json_decode($callbackData);

            print_r($resp);
            \App\B2c::where('originator_conversation_id', $resp->OriginatorConversationID)
            ->update([
                'result_description' => $resp->resultDesc,
                'amount' => $resp->amount,
                'transaction_id' => $resp->resultDesc,
                'initiator_account_current_balance' => $resp->initiatorAccountCurrentBalance,
                'debit_account_current_balance' => $resp->debitAccountCurrentBalance,
                'result_code' => $resp->resultCode,
                'debit_party_affected_account_balance' => $resp->debitPartyAffectedAccountBalance,
                'trans_completed_time' => $resp->transCompletedTime,
                'debit_party_charges' => $resp->debitPartyCharges,
                'receiver_party_public_name' => $resp->receiverPartyPublicName,
                'currency' => $resp->currency,
            ]);

        }

    }

}
