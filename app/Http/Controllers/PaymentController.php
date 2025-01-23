<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $totalAmount=110;
        $uid = strval(rand(1000000000, 9999999999));
        $message = "total_amount=".$totalAmount.",transaction_uuid=".$uid.",product_code=EPAYTEST";

        $s = hash_hmac('sha256', $message, '8gBm/:&EnhH.1/q', true);
        $signature = base64_encode($s);

        $data = [
            "amount" => 100,
            "tax_amount" => 10,
            "product_service_charge" => 0,
            "product_delivery_charge" => 0,
            "product_code" => "EPAYTEST",
            "signed_field_names" => "total_amount,transaction_uuid,product_code",
            "total_amount" => 110,
            "transaction_uuid" => $uid,
            "signature" => $signature,
            "success_url" => route("payment.esewa.success"),
            "failure_url" => route("payment.esewa.failure"),
        ];
            // add data to db here
        return view("component.esewa_parameters", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function esewaSuccess(Request $request)
    {
        //
        dd($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function esewaFailure(Request $request)
    {
        dd($request->all());
    }

    
}
