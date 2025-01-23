<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $base_amount = 100;
        $tax_amount = 10;
        $product_service_charge = 0;
        $product_delivery_charge = 0;
        $transaction_uuid =  rand(100000, 999999);
        $product_code = "EPAYTEST";
        $success_url = env('APP_URL')."/sucess";
        $failure_url = env('APP_URL')."/failure";
        $total_amount =  $base_amount + $product_delivery_charge + $product_service_charge + $tax_amount;
        $signed_field_names = "total_amount=" . $total_amount . ",transaction_uuid=" . $transaction_uuid . ",product_code=" . $product_code;
        $signature = Payment::signatureGenerator($signed_field_names);
        

        return view("component.esewa_parameters", compact(
            'base_amount',
            'tax_amount',
            'product_service_charge',
            'product_delivery_charge',
            'transaction_uuid',
            'product_code',
            'total_amount',
            'signed_field_names',
            'signature',
            'success_url',
            'failure_url',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function esewaSuccess()
    {
        //
        dd("seccess");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function esewaFailure()
    {
        dd("hi");
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
