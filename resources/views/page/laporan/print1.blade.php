<!DOCTYPE html>

<head>
    <style>
        .container {
            text-align: center;
        }

        .kp {
            text-align: center;
        }

        .left {
            text-align: left;
        }

        .logo {
            /* display: block; */
            text-align: center;
            /* margin-right: 20px; */
            /* margin-left: 610px; */
            margin-top: 35px;
            font-size: small;
            /* margin: 0 auto; */
        }

        .text {
            text-align: center;
            /* font-size: small; */
            margin-top: 15px;
        }

        .cntr {
            font-size: small;
            text-align: left;
            margin-left: 40px;
            margin-right: 40px;
        }

        .translation {
            display: block;
            font-size: small;
            margin-top: -9px;
            font-style: italic;
        }

        table {
            border-collapse: collapse;
            margin-left: 40px;
            margin-right: 40px;
            margin-top: 10px;
        }

        .ini {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            font-size: small;
            padding: 0;
        }

        .ttd {
            /* border: 1px solid black; */
            /* paddi    ng: 8px; */
            text-align: left;
            font-size: small;
            padding: 0px;
            margin-top: -20px;
            font-style: italic;
        }

        .ttd1 {
            /* border: 1px solid black; */
            /* paddi    ng: 8px; */
            text-align: left;
            font-size: small;
            padding: 0px;
            /* margin-top: -20px; */
            /* font-style: italic; */
        }

        .left {
            padding-left: 10px;
        }

        .footer {
            /* margin-top: 381px; */
            /* margin-top: 150px; */
            background: #204b8c;
            color: #fff;
            text-align: center;
            font-size: small;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .ket {
            margin-left: 290px;
        }

        body {
            font-family: 'Tahoma';
        }

        .tengah {
            text-align: center;
        }
    </style>
    <title>LAPORAN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="sheet">

        <div class="container bg-red-500 w-[1500px]">
            @foreach ($transactions_kurang as $items)
                {{ $items->item }}
            @endforeach<br><br>
            @foreach ($transactions as $item)
                {{ $item->item }}
            @endforeach
        </div>

    </div>

</body>
