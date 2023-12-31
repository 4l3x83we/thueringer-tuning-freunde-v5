@php use Carbon\Carbon; @endphp
<div id="sticky-banner-geb" tabindex="-1" class="flex justify-between w-full p-4 border-b border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
    <div class="flex items-center mx-auto">
        <p class="flex items-center text-sm font-normal text-gray-500 dark:text-gray-400">
            @guest
            @else
                {!! geburtstag() !!}
            @endguest
        </p>
    </div>
    <div class="flex items-center">
        <button data-dismiss-target="#sticky-banner-geb" type="button" class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close banner</span>
        </button>
    </div>
</div>

@push('scripts')
    <script type="module">
        setTimeout(function () {
            // Adding the class dynamically
            $('#sticky-banner-geb').addClass('hidden');
        }, 30000);
    </script>
@endpush
