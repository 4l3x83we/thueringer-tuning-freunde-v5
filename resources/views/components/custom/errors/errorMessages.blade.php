@if($message = Session::get('success'))
    <div class="grid grid-cols-1 pt-6 timeout">
        <div class="bg-green-100 border-t-4 border-green-500 rounded text-green-900 px-4 py-3 shadow-md my-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-green-500 mr-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">{{ __('Success') }}</p>
                    <p class="text-sm">{!! $message !!}</p>
                </div>
            </div>
        </div>

        <style>
            .timeout.hide {
                display: none !important;
            }
        </style>

        <script type="module">
            setTimeout(function () {
                $('.timeout').addClass('hide');
            }, 10000);
        </script>
    </div>
@endif

@if($message = Session::get('successError'))
    <div class="grid grid-cols-1 pt-6 timeout">
        <div class="bg-red-100 border-t-4 border-red-500 rounded text-red-900 px-4 py-3 shadow-md my-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-red-500 mr-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">{{ __('Success') }}</p>
                    <p class="text-sm">{!! $message !!}</p>
                </div>
            </div>
        </div>

        <style>
            .timeout.hide {
                display: none !important;
            }
        </style>

        <script type="module">
            setTimeout(function () {
                $('.timeout').addClass('hide');
            }, 10000);
        </script>
    </div>
@endif

@if($message = Session::get('error'))
    <div class="grid grid-cols-1 pt-6 timeout">
        <div class="bg-red-100 border-t-4 border-red-500 rounded text-red-900 px-4 py-3 shadow-md my-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500 mr-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">{{ __('Error') }}</p>
                    <p class="text-sm">{!! $message !!}</p>
                </div>
            </div>
        </div>

        <style>
            .timeout.hide {
                display: none !important;
            }
        </style>

        <script type="module">
            setTimeout(function () {
                $('.timeout').addClass('hide');
            }, 10000);
        </script>
    </div>
@endif

@if($message = Session::get('warning'))
    <div class="grid grid-cols-1 pt-6 timeout">
        <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded text-yellow-900 px-4 py-3 shadow-md my-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-500 mr-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">{{ __('Warning') }}</p>
                    <p class="text-sm">{!! $message !!}</p>
                </div>
            </div>
        </div>

        <style>
            .timeout.hide {
                display: none !important;
            }
        </style>

        <script type="module">
            setTimeout(function () {
                $('.timeout').addClass('hide');
            }, 10000);
        </script>
    </div>
@endif

@if($message = Session::get('info'))
    <div class="grid grid-cols-1 pt-6 timeout">
        <div class="bg-cyan-100 border-t-4 border-cyan-500 rounded text-cyan-900 px-4 py-3 shadow-md my-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-cyan-500 mr-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">{{ __('Info') }}</p>
                    <p class="text-sm">{!! $message !!}</p>
                </div>
            </div>
        </div>

        <style>
            .timeout.hide {
                display: none !important;
            }
        </style>

        <script type="module">
            setTimeout(function () {
                $('.timeout').addClass('hide');
            }, 10000);
        </script>
    </div>
@endif

@if($errors->any())
    <div class="grid grid-cols-1 timeout">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 my-4" role="alert">
            <p class="font-bold">Bitte überprüfe das Formular auf Fehler.</p>
            @foreach($errors->all() as $error)
                <p>{!! $error !!}</p>
            @endforeach
        </div>

        <style>
            .timeout.hide {
                display: none !important;
            }
        </style>

        <script type="module">
            setTimeout(function () {
                $('.timeout').addClass('hide');
            }, 10000);
        </script>
    </div>
@endif

{{--@if ($errors->isNotEmpty())
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 10000)" id="alert-border-2" class="flex items-start p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-gray-100 dark:text-red-400 dark:bg-gray-900 dark:border-red-800 shadow-xl rounded-lg timeout" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ml-3 text-sm font-medium flex flex-col">
        <strong class="font-bold">Error</strong>
        <span class="block sm:inline">Bitte überprüfe das Formular auf Fehler.</span>
        <div class="mt-4">
        @foreach($errors->all() as $error)
            <p>{!! $error !!}</p>
        @endforeach
        </div>
    </div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-gray-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-gray-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-900 dark:text-red-400 dark:hover:bg-gray-800"  data-dismiss-target="#alert-border-2" aria-label="Close">
        <span class="sr-only">Dismiss</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>
@endif--}}
