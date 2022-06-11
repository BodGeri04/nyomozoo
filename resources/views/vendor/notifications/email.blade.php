@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Kedves Felhasználónk!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}<br>
@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
<br>{{ $salutation }}
@else
 <strong> @lang ('Üdvözlettel'),<br>
{{ __ ("A Nyomozoo.hu csapata") }}
 </strong>
 <br>
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Amennyiben problémába ütköztél a(z) \":actionText\" gomb megnyomásakor, másold ki az alábbi linket és illeszd be a böngésződbe:",
    [
        'actionText' => $actionText,
    ]
)<br> <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span><br><p><hr>
@lang(
    "Ez egy automatikus üzenet. Kérjük erre a címre ne válaszolj."
)</p>
@endslot
@endisset
@endcomponent
