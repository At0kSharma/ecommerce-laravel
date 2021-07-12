@component('mail::message')
<p>Gurkha Trails<br>ABN</p>
<h2>Invoice</h2>
<table width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td><p>{{$details['name']}}<br>{{$details['street']}},{{$details['city']}}<br>{{$details['state']}},{{$details['zipcode']}}<br>{{$details['country']}}</p></td>
<td style="text-align: right"><p>invoice:02547-{{$details['id']}}<br>Date:{{$details['date']}}<br>due upon receipt</p></td>
</tr>
</table>
@php 
$order_details = (json_decode($details['order'],true));
$total = 0;
@endphp
<div class="table" style="padding: 10px 0;">
<table width="100%" cellpadding="0" cellspacing="0" role="presentation">
<thead style="text-align:left;">
<tr style="">
<th>Product</th>
<th>Description</th>
<th style="text-align: right">Price</th>
</tr>
</thead>
<tbody>
@foreach ($order_details as $orders)
<tr>
<td>{{$orders['name']}}</td>
<td>Size:{{$orders['size']}},Quantity:{{$orders['qty']}}</td>
<td style="text-align: right">A${{number_format($orders['price']*0.9,2)}}</td>
</tr>
@php
$total += $orders['price'];
@endphp
@endforeach
<tr>
<td></td>
<td>Sub Total</td>
<td style="text-align: right">A${{number_format($total*0.9,2)}}</td>
</tr>
<tr>
<td></td>
<td>GST(10%)</td>
<td style="text-align: right">A${{number_format($total*0.1,2)}}</td>
</tr>
<tr>
<td></td>
<td>Grand Total</td>
<td style="text-align: right">A${{number_format($total,2)}}</td>
</tr>
</tbody>
</table>
</div>
{{-- {{dd(number_format($total,2))}} --}}
<p>Thank you for your Business</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
