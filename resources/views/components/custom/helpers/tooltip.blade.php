<div x-data="{ tooltip: false }" class="relative z-30 inline-flex tracking-wide items-center">
    <div @mouseover="tooltip = true"
         @mouseleave="tooltip = false"
         class="inline-block text-sm font-medium text-white">
        {{ $slot }}
    </div>
    <div x-show="tooltip"
         x-transition.duration.300ms
         x-cloak
         class="relative">
        <div class="absolute bottom-0 z-10 min-w-max -translate-x-full translate-y-2 transform rounded-lg bg-gray-900 px-2 py-1 text-sm text-white shadow-sm -mb-1.5 dark:bg-gray-700">
            {{ $text ?? '' }}
        </div>
        <svg class="absolute z-10 h-5 w-6 -translate-x-7 translate-y-5 transform fill-current stroke-current text-gray-900 dark:text-gray-700">
            <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
        </svg>
    </div>
</div>
@push('css')
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endpush
