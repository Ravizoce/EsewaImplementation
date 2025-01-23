<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $totalAmount = 110;
        $uid = strval(rand(1000000000, 9999999999));
        $message = "total_amount=" . $totalAmount . ",transaction_uuid=" . $uid . ",product_code=EPAYTEST";

        $s = hash_hmac('sha256', $message, '8gBm/:&EnhH.1/q', true);
        $signature = base64_encode($s);

        $data = [
            "amount" => 100,
            "tax_amount" => 10,
            "product_delivery_charge" => 0,
            "product_service_charge" => 0,
            "product_code" => "EPAYTEST",
            "signed_field_names" => "total_amount,transaction_uuid,product_code",
            "total_amount" => 110,
            "transaction_uuid" => $uid,
            "signature" => $signature,
            "success_url" => route("payment.esewa.success"),
            "failure_url" => route("payment.esewa.failure"),
        ];
        // add data to db here
        try {
            // DB::beginTransaction();
            Payment::create([
                "transaction_uuid" => $uid,
                "amount" => $data["amount"], //basic amount change to amount will com form calculate amount function , it takes order id as input
                "tax_amount" => $data["tax_amount"], //mostly will be 0 but if needed will came from tax table
                "delivery_charge" => $data["product_delivery_charge"],
                "service_charge" => $data["product_service_charge"],
                "total_amount" => $totalAmount,
                "signature" => $signature,
            ]);
            // DB::commit();
        } catch (Exception $e) {
            // DB::rollBack();
            dd($e);
        }
        return view("component.esewa_parameters", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function esewaSuccess(Request $request)
    {
        $response_data = json_decode(base64_decode($request->data), true);
       
        $message = "transaction_code=".$response_data["transaction_code"].",status=".$response_data["status"].",total_amount=".$response_data["total_amount"].",transaction_uuid=".$response_data["transaction_uuid"].",product_code=".$response_data["product_code"].",signed_field_names=".$response_data["signed_field_names"];
        $s = hash_hmac('sha256', $message, '8gBm/:&EnhH.1/q', true);
        $signature = base64_encode($s);


        if (!$response_data["signature"]  == $signature) {
            return redirect(route("home"))->with("message","sorry signature didn't match");
        }


        if($response_data["status"] == "COMPLETE"){
            
            Payment::updated([
                "status"=>$response_data["status"]
            ]);
            return redirect(route("home"))->with("message","payment successful");
        }
        return redirect(route("home"))->with("message","payment failed with status".$response_data["status"]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function esewaFailure(Request $request)
    {
        return redirect(route("home"));
    }
}
