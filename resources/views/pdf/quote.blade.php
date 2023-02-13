<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        *{
            font-family: 'arial','sans-serif';
        }
        .header{
            width: 100%;
        }
        .body{
            width: 100%;
        }
        .header__logo{
            width:250px;
            height:auto;
        }
        .header__logo img{
            width: 200px;
        }
        .header__data{
            width:300px;
        }
        .header__data > table{
            border: 1px solid #757575;
            border-radius:10px;
            padding: 5px;
            color:#212121;
        }
        .table_detail{
            width: 100%;
            margin-top:10px;
        }
        .table_detail__th{
            font-size:14px;
            font-weight: bold;
            background-color: #212121;
            color:#F5F5F5;
            padding:5px;
        }
        .table_detail__td{
            padding:5px;
            font-size:12px;
            border-bottom:1px solid #ccc;
        }
        .table_detail__td_total{
            padding:5px;
            font-size:16px;
            background-color: #212121;
            color:#F5F5F5;
        }
    </style>
</head>
<body>

    <div class="header">
        <table class="items" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <div class="header__logo">
                        {{-- <img src="./images/logo/VIVIMXHOME.png" alt="logo"> --}}
                    </div>
                </td>
                <td style="width:175px;"><td>
                <td>
                    <div class="header__data">
                        <table>
                            <tr>
                                <td><b>ID:</b></td>
                                <td>{{ $data->id }}</td>
                            </tr>
                            <tr>
                                <td><b>Fecha:</b></td>
                                <td>{{ $data->created_at }}</td>
                            </tr>
                            <tr>
                                <td><b>Atendido Por:</b></td>
                                <td>{{ $data->user->name }}</td>
                            </tr>
                            <tr>
                                <td><b>Precio:</b></td>
                                <td>
                                    @if($data->type_price == 1)
                                        Menudeo
                                    @endif

                                    @if($data->type_price == 2)
                                        Mayoreo
                                    @endif

                                    @if($data->type_price == 3)
                                        Distribuidor
                                    @endif

                                    @if($data->type_price == 4)
                                        Caja
                                    @endif
                                </td>
                            </tr>


                            @if($data->discount_percentage > 0)
                                <tr>
                                    <td><b>Descuento:</b></td>
                                    <td>%{{ $data->discount_percentage }}</td>
                                </tr>
                            @endif

                            

                        <table>
                    </div>
                </td>
            </tr>
        </table>        
    </div>

    <div class="body">
        <table class="table_detail">
            <tr>
                <td class="table_detail__th"></td>
                <td class="table_detail__th">Código</td>
                <td class="table_detail__th">Descripción</td>
                <td class="table_detail__th">Precio</td>
                <td class="table_detail__th">Cantidad</td>
                <td class="table_detail__th">Importe</td>
            </tr>
           
            @foreach($data->detail as $item)
              
                <tr valign="top">
                    <td class="table_detail__td">
                        <img src="./images/products/{{ $item->product->image }}" style="width:100px" alt="{{ $item->product->name }}">
                    </td>
                    <td class="table_detail__td">{{ $item->product->code }}</td>
                    <td class="table_detail__td">{{ ucfirst($item->product->name) }}</td>
                    <td class="table_detail__td">${{ number_format($item->price,2) }}</td>
                    <td class="table_detail__td">{{ $item->quantity }}</td>
                    <td class="table_detail__td">${{ number_format($item->price*$item->quantity,2) }}</td>
                </tr>
            @endforeach
            {{--             
            <tr>
                <td colspan="3" class="table_detail__td_total">Total Descuento:</td>
                <td colspan="3" class="table_detail__td_total">${{ number_format($data->total_discount,2) }}</td>
            </tr>
             --}}
            <tr>
                <td colspan="3" class="table_detail__td_total">Total:</td>
                <td colspan="3" class="table_detail__td_total">${{ number_format(($data->total-$data->total_discount),2) }}</td>
            </tr>
        </table>
    </div>

</body>
</html>