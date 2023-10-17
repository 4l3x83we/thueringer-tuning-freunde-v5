@props(['name', 'title', 'close', 'footer', 'form'])
@php
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        '6xl' => 'sm:max-w-6xl',
        '7xl' => 'sm:max-w-7xl',
    ][$maxWidth ?? '4xl'];
@endphp

<div
    x-data="{ show: false, name : '{{ $name }}' }"
    x-show="show"
    x-on:open-modal.window = "show = ($event.detail.name === name)"
    x-on:close-modal.window = "show = false"
    x-on:keydown.escape.window = "show = false"
    x-cloak
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50 duration-400">

    <!-- Gray Background -->
    <div x-on:click="show = false" class="absolute inset-0 bg-gray-500 opacity-75"></div>

    <!-- Modal Body -->
    <div class="mb-6 bg-gray-50 dark:bg-gray-800 rounded overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded shadow dark:bg-gray-800">
            @if(isset($title))
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
                    @if(isset($close))
                        <button x-on:click="$dispatch('close-modal')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="extralarge-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    @endif
                </div>
            @endif
            @if(isset($form))
                <form wire:submit.prevent="{{ $form }}">
            @endif
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                {{ $body }}
            </div>

            @if(isset($footer))
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-6 space-x-2 gap-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    {{ $footer }}
                    <x-custom.button.button x-on:click="$dispatch('close-modal')" color="red-border">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x w-4 h-4 mr-1 -ml-1" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        Schließen
                    </x-custom.button.button>
                </div>
            @endif
            @if(isset($form))
                </form>
            @endif
        </div>
    </div>
</div>
