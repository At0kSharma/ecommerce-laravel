<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'GurkhaTrails')
<img src="{{asset('img/logo_gt.png')}}" class="logo" alt="Gurkha_logo"><br>
<h3>GurkhaTrails</h3>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
