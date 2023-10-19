@php use Carbon\Carbon; @endphp
<div>
    <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-bold">
                <span class="text-primary-500 dark:text-primary-500">Veranstaltungen</span>
            </h2>
            @if(Request::is('/'))
                <a href="{{ route('frontend.veranstaltungen.index') }}">Übersicht</a>
            @endif
            <p><span class="text-green-500">Grün hinterlegt:</span> Wir sind voraussichtlich anwesend</p>
        </div>

        @if(!Request::is('/'))
            <div class="mb-4">
                <div class="flex justify-end items-center gap-4">
                    <x-custom.button.button-blank wire:click="download" class="gap-2 text-lg leading-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-printer w-4 h-4" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                        </svg>
                        Drucken
                    </x-custom.button.button-blank>
                    @can('write')
                        <x-custom.links.button-link  href="{{ route('frontend.veranstaltungen.create') }}">Neue Veranstaltung anlegen</x-custom.links.button-link>
                    @endcan
                </div>
            </div>
        @endif

        @if(count($veranstaltungen) > 0)
            <div class="grid gap-8 grid-cols-1 md:grid-cols-2 text-center">

                @foreach($veranstaltungen as $veranstaltung)
                    <div class="col-span-2 md:col-span-1">
                        @if(Carbon::parse($veranstaltung->datum_von)->isoFormat('DD.MM.YYYY') != date('d.m.Y') or Carbon::parse($veranstaltung->datum_bis)->isoFormat('DD.MM.YYYY') == date('d.m.Y'))
                            <div class="flex justify-start w-full h-full bg-gray-100 rounded shadow-2xl dark:bg-gray-900 transition-all ease-in-out duration-300 group hover:scale-105">
                                <div class="{{ $veranstaltung->anwesend ? 'bg-green-200 dark:bg-green-800/50' : 'bg-gray-200 dark:bg-gray-800/50' }} rounded-s flex content-between flex-wrap w-24 md:w-1/5 border-r border-gray-700 group-hover:border-primary-500">
                                    <div class="flex justify-center w-full h-auto text-center uppercase p-1">
                                        <time datetime="{{ $veranstaltung->datum_von }}">
                                            <span class="gluten flex justify-center leading-none text-5xl -mb-2.5">{{ Carbon::parse($veranstaltung->datum_von)->isoFormat('DD') }}</span>
                                            @if(Carbon::parse($veranstaltung->datum_von)->isoFormat('DD.MM.YYYY') != Carbon::parse($veranstaltung->datum_bis)->isoFormat('DD.MM.YYYY'))
                                                <div class="flex justify-center p-1 text-xl">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 fill-gray-500 dark:fill-white">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            @if(Carbon::parse($veranstaltung->datum_von)->isoFormat('DD') != Carbon::parse($veranstaltung->datum_bis)->isoFormat('DD'))
                                                <span class="gluten flex justify-center leading-none text-5xl -mb-2.5">{{ Carbon::parse($veranstaltung->datum_bis)->isoFormat('DD') }}</span>
                                            @endif
                                            @if(Carbon::parse($veranstaltung->datum_von)->isoFormat('MM') == Carbon::parse($veranstaltung->datum_bis)->isoFormat('MM'))
                                                <span class="gluten flex justify-center leading-none text-xl -mb-1">{{ Carbon::parse($veranstaltung->datum_bis)->shortMonthName }}</span>
                                            @endif
                                            @if(Carbon::parse($veranstaltung->datum_von)->isoFormat('YYYY') != Carbon::parse($veranstaltung->datum_bis)->isoFormat('YYYY'))
                                                <span class="gluten flex justify-center leading-none text-sm">{{ Carbon::parse($veranstaltung->datum_bis)->isoFormat('YYYY') }}</span>
                                            @endif
                                        </time>
                                    </div>
                                    <div class="flex justify-evenly w-full p-1 text-center leading-none">
                                        @if(!$veranstaltung->anwesend)
                                            <form wire:submit.prevent="anwesend('{{ $veranstaltung->slug }}', '1')">
                                                <x-custom.button.button-blank type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check2-circle w-4 h-4 text-green-700 hover:text-green-500" viewBox="0 0 16 16">
                                                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                                    </svg>
                                                </x-custom.button.button-blank>
                                            </form>
                                        @else
                                            <form wire:submit.prevent="anwesend('{{ $veranstaltung->slug }}', '0')">
                                                <x-custom.button.button-blank type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3 w-4 h-4 text-red-700 hover:text-red-500" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                    </svg>
                                                </x-custom.button.button-blank>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-col w-full mx-4 text-left py-4">
                                    <h4 class="text-base font-bold mb-4 duration-300 group-hover:text-primary-500 md:h-14 md:text-lg">{{ $veranstaltung->veranstaltung }}</h4>
                                    <div class="flex flex-wrap justify-start content-start w-full h-full items-center">
                                        <div class="opacity-0 w-0 md:opacity-100 md:w-[5%] group-hover:text-primary-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-flag w-3.5 h-3.5" viewBox="0 0 16 16">
                                                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z"/>
                                            </svg>
                                        </div>
                                        <div class="w-full md:w-[95%] font-bold group-hover:font-normal text-primary-500">{{ $veranstaltung->veranstalter }}</div>
                                        <div class="opacity-0 w-0 md:opacity-100 md:w-[5%] group-hover:text-primary-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-ticket-perforated w-3.5 h-3.5" viewBox="0 0 16 16">
                                                <path d="M4 4.85v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Z"/>
                                                <path d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3h-13ZM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9V4.5Z"/>
                                            </svg>
                                        </div>
                                        @if($veranstaltung->eintritt)
                                        <div class="w-full md:w-[95%]">{{ $veranstaltung->eintritt }}</div>
                                        <div class="opacity-0 w-0 md:opacity-100 md:w-[5%] group-hover:text-primary-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-clock w-3.5 h-3.5" viewBox="0 0 16 16">
                                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                            </svg>
                                        </div>
                                        @else
                                        <div class="w-full md:w-[95%]">Kein Eintrittspreis bekannt.</div>
                                        <div class="opacity-0 w-0 md:opacity-100 md:w-[5%] group-hover:text-primary-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-clock w-3.5 h-3.5" viewBox="0 0 16 16">
                                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                            </svg>
                                        </div>
                                        @endif
                                        <div class="w-full md:w-[95%]">
                                            @if(Carbon::parse($veranstaltung->datum_von)->isoFormat('HH:mm') != Carbon::parse($veranstaltung->datum_bis)->isoFormat('HH:mm'))
                                                {{ Carbon::parse($veranstaltung->datum_von)->isoFormat('HH:mm') .' - '. Carbon::parse($veranstaltung->datum_bis)->isoFormat('HH:mm') .' Uhr'}}
                                            @else
                                                {{ 'ab '. Carbon::parse($veranstaltung->datum_von)->isoFormat('HH:mm') .' Uhr'}}
                                            @endif
                                        </div>
                                        <div class="opacity-0 w-0 md:opacity-100 md:w-[5%] group-hover:text-primary-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-stopwatch w-3.5 h-3.5" viewBox="0 0 16 16">
                                                <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
                                                <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>
                                            </svg>
                                        </div>
                                        <div class="w-full md:w-[95%]">Laufzeit: {{ getDaysRate($veranstaltung->datum_von, $veranstaltung->datum_bis) + 1 }}
                                            @if(getDaysRate($veranstaltung->datum_von, $veranstaltung->datum_bis) != 0)
                                                Tage
                                            @else
                                                Tag
                                            @endif
                                        </div>
                                        <div class="opacity-0 w-0 md:opacity-100 md:w-[5%] group-hover:text-primary-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt w-3.5 h-3.5" viewBox="0 0 16 16">
                                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                            </svg>
                                        </div>
                                        <div class="w-full md:w-[95%]">
                                            <a href="https://maps.google.com/maps?saddr=&daddr={{ $veranstaltung->veranstaltungsort }}" target="_blank" class="underline hover:no-underline">{{ $veranstaltung->veranstaltungsort }}</a>
                                        </div>
                                    </div>
                                    @if($veranstaltung->quelle)
                                        <div class="flex justify-end mt-2">
                                            <a href="{{ route('frontend.veranstaltungen.show', $veranstaltung->slug) }}"  class="inline-flex gap-3 items-center underline hover:no-underline">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5 group-hover:text-primary-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                                </svg>
                                                Weitere Informationen
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $veranstaltungen->links() }}
            </div>
        @else
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2 text-center">
                <div class="col-span-2 items-center bg-gray-100 rounded shadow-xl shadow-gray-400 dark:shadow-gray-900 my-8 sm:flex dark:bg-gray-900 dark:border-gray-700 group hover:scale-105">
                    <div class="flex flex-col justify-center items-center w-full">
                        <div class="font-bold py-4 text-2xl">Es sind leider keine Veranstaltungen eingetragen.</div>
                        <div>
                            <x-custom.links.button-link href="" class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                </svg>
                                Neue Veranstaltung eintragen
                            </x-custom.links.button-link>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
