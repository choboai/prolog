{{-- @extends('errors::minimal')
@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}

<script>
    if (window.parent) {
        window.parent.location.href="/";
    } else {
        window.location.href="/";
    }
</script>
