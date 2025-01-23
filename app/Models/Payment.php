<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
   
    public static function signatureGenerator(string $message){
        $key =env("Merchant_Key");

        $s = hash_hmac('sha256', $message, "8gBm/:&EnhH.1/q", true);
        return base64_encode($s); 
    } 
}
