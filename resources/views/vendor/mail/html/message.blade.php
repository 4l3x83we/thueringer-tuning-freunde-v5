<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
    <img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name') }}"  class="w-auto mx-auto h-14 sm:h-16">
{{--{{ config('app.name') }}--}}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
    <div style="align-items: center; font-size: 14px; margin-bottom: 16px;">
        <div>{{ env('TTF_NAME') }}</div>
        <div>{{ env('TTF_STRASSE') }}</div>
        <div>{{ env('TTF_ORT') }}</div>
        <div class="mt-4">{{ env('TTF_EMAIL') }}</div>
    </div>
    <div style="align-items: center; font-size: 14px;">
        © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
    </div>
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
