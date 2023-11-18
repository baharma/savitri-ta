@if (session('message'))
<span class="success" data-message="{{ session('message') }}"></span>
@endif


@if (session('error'))
<span class="error" data-message="{{ session('error') }}"></span>
@endif
