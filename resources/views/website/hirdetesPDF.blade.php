<html lang="hu">

<head>
    <link rel="shortcut icon" href="/admin_assets/images/kutya_title.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        h1 {
            text-align: center;
            color: #1d4b47;
            font-family: 'freeserif';
            font-size: 27px;
            text-transform: uppercase;
        }

        tr {
            color: #1d4b47;
            font-family: 'freeserif';
            text-transform: uppercase;
        }

        td {
            font-weight: bold;
            font-size: 13;
            text-transform: uppercase;
        }

        th {
            font-family: 'freeserif';
            text-transform: uppercase;
        }

        div {
            margin-top: 0px;
            margin-bottom: 0px;
            margin-right: 150px;
            margin-left: 80px;
            font-family: 'freeserif';
        }

        .img {
            margin-left: auto;
            margin-right: auto;
            width: 350px;
            height: 300px;
            
        }

        .image_table {
            margin-left: auto;
            margin-right: auto;
            width: 350px;
            height: 250px;
            max-width: 350px;
            max-height: 350px;
            table-layout:fixed;
        }
    </style>

</head>
<img src="/admin_assets/images/logo_export_new_white.png" alt="kep">

<body style="">
    <form action="/website/hirdetesPDF/{{ $advertisements->id }}" class="row" method="POST">
        @csrf
        <h1>Keressük {{ $advertisements->name }}-t!</h1>
        <div class="container">
            <table class="image_table"> 
                <tr>
                    <th> <img class="image_table" src="/assets/images/advertisement/{{ $advertisements->image_attach }}"></th>
                </tr>
            </table>
            <div class="card-body table-responsive p-0 container">
                <table border="1" cellpadding="6" width="100%" style="">
                    <tr>
                        <td rowspan="1" width="50%">Jelleme:
                            <?php echo str_repeat('&nbsp;', 4); ?>{{ $advertisements->characteristics }}
                        </td>
                        <td width="50%">Elkóborlás
                            dátuma:<?php echo str_repeat('&nbsp;', 8); ?>{{ $advertisements->disappeared }}
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">Neve:<?php echo str_repeat('&nbsp;', 9); ?>{{ $advertisements->name }}</td>
                        <td width="50%">Eredeti lakhelye (Ir.
                            szám):<?php echo str_repeat('&nbsp;', 6); ?>{{ $advertisements->zip_number }}
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="0" width="50%">Neme:<?php echo str_repeat('&nbsp;', 8); ?>{{ isset($advertisements) ? ($advertisements->sex == 'Male' ? 'Hím' : '') : '' }}{{ isset($advertisements) ? ($advertisements->sex == 'Female' ? 'Nőstény' : '') : '' }}</td>
                        
                        <td rowspan="4" width="50%">Egyéb adatok: {{ $advertisements->comment }}</td>
                    </tr>
                    <tr>
                        <td>Csip:<?php echo str_repeat('&nbsp;', 9); ?>{{ isset($advertisements) ? ($advertisements->chip == '1' ? 'Van' : '') : '' }}{{ isset($advertisements) ? ($advertisements->chip == '0' ? 'Nincs' : '') : '' }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="container"
                style="text-align: left; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1a423f; font-size: 16; font-weight:bold;"> Ha megtalálta kérem hívja a <br>{{$advertisements->pre_phone_number}} {{$advertisements->phone_number}} telefonszámot!
            </div><br>
            <div class="container"
                style="text-align: left; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1a423f; font-size: 12;"> További információt a https://nyomozoo.hu oldalon,<br> illetve a QR kód beszkennelésével haphat.
            </div>
        </div>
</body>

</html>
