@push('meta')
    <title>@if(!empty($title)) {{ $title }} | @endif {{ config('app.name', 'Thüringer Tuning Freunde') }}</title>
@endpush
