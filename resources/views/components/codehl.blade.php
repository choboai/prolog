@php
$hl = new \Highlight\Highlighter();
$highlighted = $hl->highlight('prolog', $code);
@endphp
{!! $highlighted->value !!}
