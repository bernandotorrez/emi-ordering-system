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
            <th width="100%" colspan="4" style="text-align: center; background-color: #28ba62;"> Fix Order </th>
        </tr>

        <tr>
            <th width="100%" colspan="4" style="text-align: center; background-color: #28ba62;"> Status Progress : Submitted </th>
        </tr>

        <tr>
            <th width="15%"> No Order Dealer </th>
            <td width="35%">{{$dataMaster->no_order_dealer}}</td>

            <th width="15%"> Order Sequence </th>
            <td width="35%">{{$dataMaster->no_order_atpm}}</td>

        </tr>

        <tr>
            <th width="15%"> Date Submit </th>
            <td width="35%">{{date("d-M-Y H:i:s", strtotime($dataMaster->date_submit_atpm_order))}}</td>

            <th width="15%"> User Order </th>
            <td width="35%">{{$dataMaster->user_order}}</td>
        </tr>

        <tr>
            <th width="15%"> Grand Total Qty </th>
            <td width="85%" colspan="3">{{$dataMaster->grand_total_qty}}</td>
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
            <th width="60%">Type Name</th>
            <th width="5%">Year Production</th>
            <th width="5%" style="text-align:center;">Total Qty</th>
        </tr>

        @foreach($dataDetail as $detail)
        <tr>
            <td style="text-align:center;">{{$loop->iteration}}</td>
            <td>{{$detail->model_name}}</td>
            <td>{{$detail->type_name}}</td>
            <td>{{$detail->year_production}}</td>
            <td style="text-align:center;">{{$detail->total_qty}}</td>
        </tr>

        <tr>
            <td colspan="1"></td>
            <td colspan="3">
                <table class="detail_pp" width="70%">
                    <tr>
                        <th width="70%" colspan="5" style="text-align: center; background-color: #3171e0;"> {{$detail->model_name}} List Colour </th>
                    </tr>

                    <tr>
                        <th width="5%" style="text-align:center;">No</th>
                        <th width="60%">Colour Name</th>
                        <th width="5%" style="text-align:center;">Qty</th>
                    </tr>   

                    @php
                    $dataDetailColour = \App\Models\DetailColourFixOrderUnit::where(['status' => '1', 'id_detail_fix_order_unit' => $detail->id_detail_fix_order_unit])->get()
                    @endphp
                    
                    @foreach($dataDetailColour as $detailColour)
                    <tr>
                        <td width="5%" class="{{$loop->iteration % 2 == 0 ? 'ganjil' : ''}}" style="text-align:center;">{{$loop->iteration}}</td>
                        <td width="60%" class="{{$loop->iteration % 2 == 0 ? 'ganjil' : ''}}">{{$detailColour->colour_name}}</th>
                        <td width="5%" class="{{$loop->iteration % 2 == 0 ? 'ganjil' : ''}}" style="text-align:center;">{{$detailColour->qty}}</td>
                    </tr>  
                    @endforeach
                </table>
            </td>
            <td colspan="1"></td>
        </tr>
        @endforeach

    </table>

</body>

</html>