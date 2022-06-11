<tr>
<td class="header">
<a style="display: inline-block;">
@if (trim($slot) === 'Nyomozoo')
<img src="https://nyomozoo.hu/admin_assets/images/logo_export_new_white.png" alt="Nyomozoo Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
