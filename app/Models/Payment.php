<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    
    use HasFactory, SoftDeletes;

    protected $table ="transactions" ,$fillable = [
        "transaction_uuid",
        "order_id",
        "amount",
        "tax_amount",
        "delivery_charge",
        "service_charge",
        "total_amount",
        "signature",
        "extra",
        "extraJson",
        "status",
    ];

    public static function signatureGenerator(string $message)
    {
        $key = env("Merchant_Key");

        $s = hash_hmac('sha256', $message, "8gBm/:&EnhH.1/q", true);
        return base64_encode($s);
    }
}
