<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StkController extends Controller
{

    public function index() {
      $stkTrans = \App\Stk::paginate(config('app.default_pagination'));
      //echo '<pre>';
      //print_r($links);
      return view('stk.index', ['stk' => $stkTrans]);
    }

    public function add(Request $request) {
      if($request->has('amount')) {
          $validatedData = $request->validate([
              'amount' => 'required',
              'phonenumber' => 'required',
              'reference' => 'required',
              'transactiondesc' => 'required',
          ]);

          $mpesa = new \Safaricom\Mpesa\Mpesa();

          $BusinessShortCode = env("BUSINESS_SHORTCODE");
          $LipaNaMpesaPasskey = env("LIPA_NA_MPESA_PASSKEY");
          $TransactionType = 'CustomerPayBillOnline';
          $Amount = $request->get('amount');
          $PartyA = env("PARTYA");
          $PartyB = env("PARTYB");
          $PhoneNumber = $request->get('phonenumber');
          $CallBackURL = env("CALLBACK_URL");
          $AccountReference = $request->GET('reference');
          $TransactionDesc = $request->input('transactiondesc');
          $Remarks = '';


          $stkPushSimulation = $mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);

          $resp = json_decode($stkPushSimulation);
//          var_dump($resp);
          if (isset($resp->errorCode)) {
              $message = $resp->errorMessage;
              return redirect('stk/add')->withErrors($message);

          } else {
              $merchant_request_id = $resp->MerchantRequestID;
              $checkout_request_id = $resp->CheckoutRequestID;
              $response_code = $resp->ResponseCode;

              $stk = new \App\Stk;
              $stk->merchant_request_id = $merchant_request_id;
              $stk->checkout_request_id = $checkout_request_id;
              $stk->response_code = $response_code;
              $stk->updated_at = now();
              //$stk->modified_at = now();
              $stk->save();

              $message = "A Payment request has been sent to the MPESA number $PhoneNumber. Please wait for a few seconds then check your phone for an MPESA PIN entry prompt.";
              return redirect()->back()->withSuccess($message);
          }
      }
      return view('stk.add', []);
    }

    public function callback(Request $request) {

        try {
            $mpesa = new \Safaricom\Mpesa\TransactionCallbacks();

            $callbackData = $mpesa->processSTKPushRequestCallback();

            $resp = json_decode($callbackData);


            $resultDesc = $resp->ResultDesc;
            $amountPaid = $resp->amount;
            $resultCode = $resp->ResultCode;
            $merchantRequestID = $resp->MerchantRequestID;
            $checkoutRequestID = $resp->CheckoutRequestID;
            $mpesaReceiptNumber = $resp->mpesaReceiptNumber;
            $balance = $resp->balance;
            $transactionDate = $resp->transactionDate;
            $phoneNumber = $resp->phoneNumber;
            $date = new DateTime($transactionDate);
            $TransactionCompletedDateTime = $date->format('Y-m-d H:i:s');


            \App\Stk::where('checkout_request_id', $checkoutRequestID)
                ->update([
                    'result_desc' => $resultDesc,
                    'amount' => $amountPaid,
                    'phone_number' => $phoneNumber,
                    'transaction_date' => $TransactionCompletedDateTime,
                    'mpesa_receipt_number' => $mpesaReceiptNumber,
                    'balance' => $balance,
                    'result_code' => $resultCode,
                    'merchant_request_id' => $merchantRequestID,

                ]);
        } catch (\Exception $e) {
            $mpesa = new \Safaricom\Mpesa\Mpesa();

            $callbackJSONData = $mpesa->getDataFromCallback();

            $callbackData = json_decode($callbackJSONData);
            print_r($callbackData);


            $resultCode=$callbackData->Body->stkCallback->ResultCode;
            $resultDesc=$callbackData->Body->stkCallback->ResultDesc;
            $merchantRequestID=$callbackData->Body->stkCallback->MerchantRequestID;
            $checkoutRequestID=$callbackData->Body->stkCallback->CheckoutRequestID;

            echo $resultCode;
            echo $resultDesc;
            echo $merchantRequestID;
            echo $checkoutRequestID;

            $result = \App\Stk::where('checkout_request_id', $checkoutRequestID)
                ->update(array(
                    'result_desc' => $resultDesc,
                    'result_code' => $resultCode,
                    'merchant_request_id' => $merchantRequestID,
                ));
        }
    }
}
