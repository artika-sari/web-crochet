<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Receipt</title>
    <style>
        #back-wrap {
            margin: 30px auto 0 auto;
            width: 500px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-back {
            width: fit-content;
            padding: 8px 15px;
            color: #fff;
            background: #666;
            border-radius: 5px;
            text-decoration: none;
        }

        #receipt {
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 30px auto 0 auto;
            width: 500px;
            background: #fff;
        }

        h2{
            font-size: .9rem;
        }

        p {
            font-size: .8rem;
            color: #666;
            line-height: 1.2rem;
        }

        #top {
            margin-top: 25px;
        }

        #top .info {
            text-align: left;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 0 5px 15px;
            border: 1px solid #eee;
        }

        .tabletitle {
            font-size: .5rem;
            background: #eee;
        }

        .service {
            border-bottom: 1px solid #eee;
        }

        .itemtext {
            font-size: .7rem;
        }

        #legalcopy {
            margin-top: 15px;
        }

        .btn-print {
            float: right;
            color: #333;
        }
    </style>
</head>
<body>
    <div id="receipt">
        <center id="top">
            <div class="info">
                <h2>Crochet Store</h2>
            </div>
        </center>
        <div id="mid">
            <div class="info">
                <p>
                    Address: Tajur <br>
                    Email: crochettaj@gmail.com <br>
                    Telephone: 666-333-9999
                </p>
            </div>
        </div>
        <div id="bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Crochet</h2>
                        </td>
                        <td class="item">
                            <h2>Total</h2>
                        </td>
                        <td class="item">
                            <h2>Price</h2>
                        </td>
                    </tr>
                    @foreach ($order['crochets'] as $crochet)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">{{ $crochet['name_crochet'] }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $crochet['qyt'] }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">Rp. {{ number_format($crochet['price'], 0, ',', '.') }}</p>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="tabletitle">
                        <td></td>
                        <td class="rate">
                            <h2>PPN (10%)</h2>
                        </td>
                        @php
                            $ppn = $order['total'] * 0.1;
                        @endphp
                        <td class="payment">
                            <h2>Rp. {{ number_format($order['total'],0 ,',','.') }}</h2>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="legalcopy">
                <p class="legal"><strong>Thank you for your purchase!</strong></p>
            </div>
        </div>
    </div>
</body>
</html>