<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    {{-- @foreach ($data as $index => $item)
        {{$index}} => {{$item}} <br />
    @endforeach --}}

    <body>
        <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
            @csrf
            @foreach ($data as $index => $item)
                <input type="text" id="{{$index}}" name="{{$index}}" value="{{$item}}" required>
            @endforeach
            <input value="Submit" type="submit">
        </form>
    </body>


    <script>
        document.addEventListener("DOMContentLoaded", () => { document.getElementById("submit").click(); });
    </script>
</body>

</html>