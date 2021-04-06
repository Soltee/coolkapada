<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Payment Invoice</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" type="text/css" media="all">

        <style type="text/css" media="all">
            html {
                font-family: sans-serif;
                line-height: 1.15;
                margin: 0;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
                font-size: 10px;
                margin: 36pt;
            }

            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }

            p {
                margin-top: 0;
                margin-bottom: 1rem;
            }

            strong {
                font-weight: bolder;
            }

            img {
                vertical-align: middle;
                border-style: none;
            }

            table {
                border-collapse: collapse;
            }

            th {
                text-align: inherit;
            }

            h4, .h4 {
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
            }

            h4, .h4 {
                font-size: 1.5rem;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }

            .table th,
            .table td {
                /*padding: 0.75rem;*/
                vertical-align: top;
                /*border-top: 1px solid #dee2e6;*/
            }

            .table thead th {
                vertical-align: bottom;
                /*border-bottom: 2px solid #dee2e6;*/
            }

            .table tbody + tbody {
                /*border-top: 2px solid #dee2e6;*/
            }

            .mt-5 {
                margin-top: 3rem !important;
            }

            .pr-0,
            .px-0 {
                padding-right: 0 !important;
            }

            .pl-0,
            .px-0 {
                padding-left: 0 !important;
            }

            .text-right {
                text-align: right !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-uppercase {
                text-transform: uppercase !important;
            }
            * {
                font-family: "DejaVu Sans";
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .col{
                display: flex; flex-direction: column; align-items: flex-end;}
            .party-header {
                /*font-size: 1.5rem;*/
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
            .border-0 {
                border: none !important;
            }
            .line{
                background-color: gray;
            }
            .right-align{
                text-align:right;
            }

            .border-left{border-left: 0.5px solid rgba(0, 0, 0, 0.5); }
        </style>

    </head>

    <body>

        {{-- Header --}}
        <div style="border:0.5px solid gray; padding: 0px; border-radius: 4px;">
            <h1 class="text-center uppercase pt-3" style="font-size: 1rem; "> Payment Invoice</h1>

            <table class="table mt-5"
                style="padding:0 12px 0 12px;">
                <thead>
                    <tr>
                        <th class="border-0 pl-0 party-header" width="48.5%">
                        </th>
                        <th class="border-0 pl-0 party-header right-align">
                            INVOICE NO.
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-0 pl-0" width="70%">
                            <h4 class=" " style="">
                            </h4>
                        </td>
                        <td class="border-0 pl-0" style="margin-top: -20px;">
                            <p class="right-align" style="text-transform: uppercase; font-size: 1.4rem;"><strong>{{ $order->id }}</strong></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- Seller - Buyer --}}
            <table class="table" style="padding: 12px 12px 0px 12px;">
                <thead>
                    <tr>
                        <th class="border-0 pl-0 party-header" width="50%">
                            BILL FROM.
                        </th>
                        <th class="border-0 pl-0 party-header right-align border-left" width="50%">
                            BILL TO.
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-0" >
                            <p class="seller-name" style="text-transform: uppercase; font-size: 1rem;">
                                <strong>Coolkapada</strong>
                            </p>

                        </td>
                        <td class="px-0 right-align border-left" style="padding-left: 3px;">
                            <p class="buyer-name" style="text-transform: uppercase; font-size: 1rem;">
                                <strong>{{ $order->first_name }} {{ $order->last_name }}</strong>
                            </p>
                            <p class="buyer-name" style=" font-size: .8rem;">
                                <strong>{{ $order->email }}</strong>
                            </p>

                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- {{ Items }} --}}
            <table class="table mt-5"
                style="padding: 12px;">
                <thead>
                    <tr>
                        <th class="border-0 py-3 pr-0 party-header">
                            Photo
                        </th>
                        <th class="border-0 py-3 pr-0 party-header ">
                            Qty
                        </th>
                        <th class="border-0 py-3 pr-0 party-header ">
                            Price
                        </th>
                        <th class="border-0 py-3 pr-0 party-header ">
                            Total
                        </th>
                    </tr>
                </thead>
                
                <tbody>

                @forelse($items as $item)
                    <tr>
                        <td class="px-2 py-2 border">
                          {{$item->name}}
                        </td>
                        <td class="px-2 py-2 border ">
                             {{ $item->qty }}               
                        </td>
                        <td class="px-2 py-2 border ">
                            RS {{ $item->price }}
                        </td>
                        
                        <td class="px-2 py-2 border">
                            Rs {{ $item->total }}
                        </td>
                    </tr>
                
                @empty
      
                @endforelse
                </tbody>
            </table>
            

            {{-- Table --}}
            <table class="table" style="padding: 12px; border-top:0.5 solid rgba(0,0,0,0.5);">
                <tbody>
                    <tr style="width: 50%;">
                        <td class="px-0">
                            <p>INVOICE DATE</p>
                            <p style="font-size: 0.8rem;">{{ $order->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="right-align">
                            <p>SUBTOTAL: <STRONG>RS{{ $order->sub_total }}</STRONG></p>
                            <p>SHIPPING: <STRONG>RS{{ $order->shipping }}</STRONG></p>
                            <p>GRAND TOTAL: <STRONG>RS {{ $order->grand_total }}</STRONG></p>

                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html>
