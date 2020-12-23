<!DOCTYPE html>
<html>

<head>
    <style>
        .detail_pp {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .detail_pp td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* .detail_pp tr:nth-child(even){background-color: #f2f2f2;} */

        .detail_pp th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #3880ff;
            color: white;
            border: 1px solid #ffffff;
            padding: 8px;
        }

        .ganjil {
            background-color: #f2f2f2;
        }
    </style>

</head>

<body>

    <table class="detail_pp" style="border: none;" border="0">
        <tr>
            <td width="100%" style="text-align: center; border: none;">
            <img alt="" 
            width="140" height="70"
            srcset="https://1000logos.net/wp-content/uploads/2019/12/Mazda-logo.jpg" 
            src="https://1000logos.net/wp-content/uploads/2019/12/Mazda-logo.jpg"> 
            </td>
        </tr>
    </table>

    <br><br>

    <table class="detail_pp">

        <tr>
            <th width="100%" colspan="4" style="text-align: center; background-color: #28ba62;"> Additional Order </th>
        </tr>

        <tr>
            <th width="100%" colspan="4" style="text-align: center; background-color: #3171e0;"> Status Progress : Revised by BM ( {{session()->get('user')['nama_user']}} )  </th>
        </tr>

        <tr>
            <th width="15%"> No Order Dealer </th>
            <td width="35%">{{$dataMaster->no_order_dealer}}</td>

            <th width="15%"> Order Sequence </th>
            <td width="35%">{{$dataMaster->no_order_atpm}}</td>

        </tr>

        <tr>
            <th width="15%"> Date Revise </th>
            <td width="35%">{{date("d-M-Y H:i:s", strtotime($dataMaster->date_revise))}}</td>

            <th width="15%"> User Order </th>
            <td width="35%">{{$dataMaster->user_order}}</td>
        </tr>

        <tr>
            <th width="15%"> Total Qty </th>
            <td width="85%" colspan="3">{{$dataMaster->total_qty}}</td>
        </tr>

        <tr>
            <th width="15%"> Remarks Revise </th>
            <td width="85%" colspan="3">{{$dataMaster->remark_revise}}</td>
        </tr>

    </table>

    <br><br>

    <table class="detail_pp">

        <tr>
            <th width="100%" colspan="6" style="text-align: center; background-color: #3171e0;"> List Order </th>
        </tr>

        <tr>
            <th width="5%" style="text-align:center;">No</th>
            <th width="25%">Model Name</th>
            <th width="35%">Type Name</th>
            <th width="25%">Colour Name</th>
            <th width="5%">Year Production</th>
            <th width="5%" style="text-align:center;">Qty</th>
        </tr>

        @foreach($dataDetail as $detail)
        <tr>
            <td class="{{$loop->iteration % 2 == 0 ? 'ganjil' : ''}}" style="text-align:center;">{{$loop->iteration}}</td>
            <td class="{{$loop->iteration % 2 == 0 ? 'ganjil' : ''}}">{{$detail->model_name}}</td>
            <td class="{{$loop->iteration % 2 == 0 ? 'ganjil' : ''}}">{{$detail->type_name}}</td>
            <td class="{{$loop->iteration % 2 == 0 ? 'ganjil' : ''}}">{{$detail->colour_name}}</td>
            <td class="{{$loop->iteration % 2 == 0 ? 'ganjil' : ''}}">{{$detail->year_production}}</td>
            <td class="{{$loop->iteration % 2 == 0 ? 'ganjil' : ''}}" style="text-align:center;">{{$detail->qty}}</td>
        </tr>
        @endforeach

    </table>

</body>

</html>