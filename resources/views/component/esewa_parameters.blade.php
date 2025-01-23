<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- 'base_amount',
            'tax_amount',
            'product_service_charge',
            'product_delivery_charge',
            'transaction_uuid',
            'product_code',
            'total_amount',
            'signed_field_names',
            'signature',
            'success_url',
            'failure_url', --}}

            

    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" hidden>
    <input type="text" id="amount" name="amount" value="{{$base_amount}}" required>
    <input type="text" id="tax_amount" name="tax_amount" value ="{{$tax_amount}}" required>
    <input type="text" id="total_amount" name="total_amount" value="{{$total_amount}}" required>
    <input type="text" id="transaction_uuid" name="transaction_uuid" value="{{$transaction_uuid}}" required> {{-- hidden --}}
    <input type="text" id="product_code" name="product_code" value ="{{$product_code}}" required> {{-- hidden --}}
    <input type="text" id="product_service_charge" name="product_service_charge" value="{{$product_service_charge}}" required>
    <input type="text" id="product_delivery_charge" name="product_delivery_charge" value="{{$product_delivery_charge}}" required>
    <input type="text" id="success_url" name="success_url" value="{{$success_url}}" required>{{-- hidden --}}
    <input type="text" id="failure_url" name="failure_url" value="{{$failure_url}}" required>{{-- hidden --}}
    <input type="text" id="signed_field_names" name="signed_field_names" value="total_amount=100,transaction_uuid=11-201-13,product_code=EPAYTEST" required>{{-- hidden --}}
    <input type="text" id="signature" name="signature" value="i94zsd3oXF6ZsSr/kGqT4sSzYQzjj1W/waxjWyRwaME=" required>{{-- hidden --}}
    <input value="Submit" type="submit" id="submit">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded" , ()=>{document.getElementById("submit").click();});
    </script>
   </body>
</html>