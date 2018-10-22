<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class c2bController extends Controller
{
    public function index() {
        $links = \App\C2B::paginate(config('app.default_pagination'));
        //echo '<pre>';
        //print_r($links);
        return view('c2b.index', ['c2b' => $links]);
    }

    public function add(Request $request) {
        if($request->has('CommandID')){
            $validatedData = $request->validate([
                'CommandID' => 'required',
                'amount' => 'required',
                'Msisdn' => 'required',
                'BillRefNumber' => 'required',
            ]);

            $ShortCode = env("BUSINESS_SHORTCODE");
            $Amount = $request->get('amount');
            $Msisdn = $request->get('Msisdn');
            $BillRefNumber = $request->get('BillRefNumber');
            $CommandID = $request->get('CommandID');

            $mpesa = new \Safaricom\Mpesa\Mpesa();

            $c2bTransaction=$mpesa->c2b($ShortCode, $CommandID, $Amount, $Msisdn, $BillRefNumber );

            $resp = json_decode($c2bTransaction);

            $message =  $resp->ResponseDescription;

            return redirect()->back()->withSuccess($message);
        }
        return view('c2b.add', []);
    }

    public function c2bValidation(Request $request) {

        $mpesa = new \Safaricom\Mpesa\TransactionCallbacks();

        $callbackData = $mpesa->processC2BRequestValidation();

        $jdata = json_decode($callbackData,true);

        $mpesa2= new \Safaricom\Mpesa\Mpesa();

        $callbackData=$mpesa2->finishTransaction();


    }

    public function c2bConfirmation(Request $request){

        $mpesa = new \Safaricom\Mpesa\TransactionCallbacks();

        $callbackData = $mpesa->processC2BRequestConfirmation();

        $resp = json_decode($callbackData);

        $c2b= new \App\C2b;

        $c2b->trans_id = $resp->transID;
        $c2b->transaction_type = $resp->transactionType;
        $c2b->first_name =$resp->firstName;
        $c2b->last_name =$resp->lastName;
        $c2b->middle_name =$resp->middleName;
        $c2b->org_account_balance =$resp->orgAccountBalance;
        $c2b->trans_time = $resp->transTime;
        $c2b->trans_amount = $resp->transAmount;
        $c2b->business_short_code = $resp->businessShortCode;
        $c2b->bill_ref_number = $resp->billRefNumber;
        $c2b->invoice_number = $resp->invoiceNumber;
        $c2b->third_party_trans_id = $resp->thirdPartyTransID;
        $c2b->msisdn = $resp->MSISDN;

        $c2b->save();

        $mpesa2= new \Safaricom\Mpesa\Mpesa();

        $mpesa2->finishTransaction();

    }
}
