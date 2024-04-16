@php use Carbon\Carbon; @endphp
<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">

        <div class="grid grid-cols-1 gap-4">

            <div class="my-8 rounded bg-gray-100 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <!-- Veranstaltung Beschreibung -->
                    <div class="col-span-2 lg:col-span-2 h-full p-2">
                        <h1 class="mb-2 text-2xl">{{ $veranstaltungen->veranstaltung }}</h1>
                        <hr class="border-primary-500">
                        @if($veranstaltungen->description)
                            <h5 class="my-2 text-lg">Beschreibung:</h5>
                            <div class="text-base">{!! $veranstaltungen->description !!}</div>
                        @else
                            <div class="text-base">Beschreibung folgt in Kürze.</div>
                        @endif
                        <hr class="border-primary-500 mt-4">
                        @if($veranstaltungen->quelle)
                            <div class="text-base mt-4 inline-flex items-center gap-2">
                                Link:
                                <x-custom.links.a-blank color="primary" href="{{ $veranstaltungen->quelle }}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-link-45deg w-4 h-4 mr-2" viewBox="0 0 16 16">
                                        <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                        <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                    </svg>
                                    mehr Informationen
                                </x-custom.links.a-blank>
                            </div>
                        @endif
                        <hr class="border-primary-500 mt-4">
                        <div class="text-base mt-4 inline-flex items-center gap-2">
                            Veranstaltungsdetails wurden zuletzt am <span class="text-red-700">{{ Carbon::parse($veranstaltungen->updated_at)->isoFormat('dddd') }}, den {{ Carbon::parse($veranstaltungen->updated_at)->isoFormat('DD. MMMM YYYY') }}</span> aktualisiert.
                        </div>
                        <div class="text-base mt-4 inline-flex items-center gap-2">
                            Für zwischenzeitlich aktualisierte Informationen (Veranstaltungsdetails, Terminanpassungen, Absagen, …) besuche bitte direkt die Veranstaltungsseite!<br>
                            {{ env('TTF_URL') }} kann keine Gewährleistung für die tagesaktuelle Korrektheit der Veranstaltungsdetails geben.
                        </div>
                    </div>
                    <!-- end Veranstaltung Beschreibung -->
                    <!-- Veranstaltung Details -->
                    <div class="col-span-2 lg:col-span-1 h-full p-2">
                        <h1 class="text-2xl flex flex-wrap items-center gap-2">
                            <time datetime="{{ $veranstaltungen->datum_von }}">
                                <span class="day">{{ Carbon::parse($veranstaltungen->datum_von)->isoFormat('ddd DD') }}</span>
                                <span class="month">{{ Carbon::parse($veranstaltungen->datum_von)->shortMonthName }}</span>
                                <span class="year">{{ Carbon::parse($veranstaltungen->datum_von)->isoFormat('YYYY') }}</span>
                            </time>
                            @if(Carbon::parse($veranstaltungen->datum_von)->isoFormat('DD.MM.YYYY') != Carbon::parse($veranstaltungen->datum_bis)->isoFormat('DD.MM.YYYY'))
                                -
                                <time datetime="{{ $veranstaltungen->datum_bis }}">
                                    <span class="day">{{ Carbon::parse($veranstaltungen->datum_bis)->isoFormat('ddd DD') }}</span>
                                    <span class="month">{{ Carbon::parse($veranstaltungen->datum_bis)->shortMonthName }}</span>
                                    <span class="year">{{ Carbon::parse($veranstaltungen->datum_bis)->isoFormat('YYYY') }}</span>
                                </time>
                            @endif
                        </h1>
                        <div class="text-xl inline-flex items-center gap-2">
                            @if(Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') != Carbon::parse($veranstaltungen->datum_bis)->isoFormat('HH:mm'))
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                <span>{{ Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') . ' - ' . Carbon::parse($veranstaltungen->datum_bis)->isoFormat('HH:mm') . ' Uhr' }}</span>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                <span>{{ Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') . ' Uhr' }}</span>
                            @endif
                        </div>
                        <div class="mt-2">
                            Laufzeit: {{ getDaysRate($veranstaltungen->datum_von, $veranstaltungen->datum_bis) + 1 }}
                            @if(getDaysRate($veranstaltungen->datum_von, $veranstaltungen->datum_bis) != 0)
                                Tage
                            @else
                                Tag
                            @endif
                        </div>
                        <hr class="my-4 border-primary-500">
                        <h4 class="mb-2 text-2xl">Ort</h4>
                        <div class="mb-2">{{ $veranstaltungen->veranstaltungsort }}
                            <span class="mb-2 block"></span>
                            @if(auth()->check())
                                <x-custom.links.a-blank color="primary" href="https://maps.google.com/maps?saddr={{ auth()->user()->teams->strasse.', '. auth()->user()->teams->plz.', '. auth()->user()->teams->wohnort }}&daddr={{ $veranstaltungen->veranstaltungsort }}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt mr-2 w-4 h-4" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                    zum Routenplaner
                                </x-custom.links.a-blank>
                            @else
                                <x-custom.links.a-blank color="primary" href="https://maps.google.com/maps?saddr=&daddr={{ $veranstaltungen->veranstaltungsort }}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt mr-2 w-4 h-4" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                    zum Routenplaner
                                </x-custom.links.a-blank>
                            @endif
                            <div class="cookieconsent-optin-marketing">
                                <iframe data-cookieconsent="marketing" class="mt-2" width="100%" height="auto" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" data-cookieblock-src="https://maps.google.com/maps?hl=de&amp;q='.{{ $veranstaltungen->veranstaltungsort }}.'&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                            </div>
                            <div class="cookieconsent-optout-marketing flex justify-center font-bold mt-2 text-success-700">
                                Bitte&nbsp;<a href="javascript: Cookiebot.renew()" class="underline">Marketing-Cookies akzeptieren</a>, um diesen Inhalt anzuzeigen.
                            </div>
                        </div>
                        <hr class="my-4 border-primary-500">
                        <h4 class="mb-2 text-2xl text-red-700">Veranstalter</h4>
                        <p class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-flag w-4 h-4" viewBox="0 0 16 16">
                                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z"/>
                            </svg>
                            {{ $veranstaltungen->veranstalter }}
                        </p>
                        <hr class="my-4 border-primary-500">
                        <h4 class="mb-2 text-2xl">Eintritt</h4>
                        <p class="flex items-center gap-2">
                            @if($veranstaltungen->eintritt)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-ticket-perforated w-4 h-4" viewBox="0 0 16 16">
                                    <path d="M4 4.85v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Z"/>
                                    <path d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3h-13ZM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9V4.5Z"/>
                                </svg>
                                {{ $veranstaltungen->eintritt . ' €' }}
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-ticket-perforated w-4 h-4" viewBox="0 0 16 16">
                                    <path d="M4 4.85v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Z"/>
                                    <path d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3h-13ZM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9V4.5Z"/>
                                </svg>
                                Kein Eintrittspreis bekannt.
                            @endif
                        </p>
                        <hr class="mt-4 border-primary-500">
                        <div class="flex flex-col gap-4">
                            @guest
                                <div class="flex flex-col bg-gray-400 px-4 py-2 border-b-primary-500 border-b">
                                    <div class="flex justify-center font-bold text-black text-base">
                                        Du bist der Organisator dieser Veranstaltung?
                                    </div>
                                    {{--<a class="flex justify-center text-primary-500 mt-2" href="{{ route('frontend.veranstaltungen.edit', $veranstaltungen->slug) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-chevron-double-right h-4 w-4 mr-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708"/>
                                            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708"/>
                                        </svg>
                                        Hier diese Veranstaltung bearbeiten.
                                    </a>--}}
                                    <a class="flex justify-center text-primary-500" href="mailto:webmaster@thueringer-tuning-freunde.de?subject=Bearbeitungswunsch der Veranstaltung: {{ $veranstaltungen->veranstaltung }}&body=Alte Daten der Veranstaltung:%0D%0A%0D%0AWann: am {{ Carbon::parse($veranstaltungen->datum_von)->format('d.m.y H:i') }} - {{ Carbon::parse($veranstaltungen->datum_bis)->format('d.m.y H:i') }} Uhr%0D%0AVeranstaltung: {{ $veranstaltungen->veranstaltung }}%0D%0AVeranstalter: {{ $veranstaltungen->veranstalter }}%0D%0AVeranstaltungsort: {{ $veranstaltungen->veranstaltungsort }}%0D%0ALink zur Veranstaltung: {{ route('frontend.veranstaltungen.show', $veranstaltungen->slug) }}%0D%0A%0D%0AObenstehendes bitte nicht löschen. Ab hier können Sie Ihre Änderungen vornehmen.">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-chevron-double-right h-4 w-4 mr-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708"/>
                                            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708"/>
                                        </svg>
                                        Wende dich bei Änderungswünschen per E-Mail an uns.
                                    </a>
                                </div>
                            @else
                            <div class="mt-4">
                                <x-custom.links.a-blank href="{{ route('frontend.veranstaltungen.edit', $veranstaltungen->slug) }}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen h-4 w-4 mr-2" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                    </svg>
                                    Bearbeiten
                                </x-custom.links.a-blank>
                            </div>
                            @endguest
                            @hasanyrole('super_admin|admin')
                                @if(!$veranstaltungen->published)
                                    <div class="mt-4">
                                        <x-custom.button.button-blank wire:click="published('{{ $veranstaltungen->slug }}', '1')" color="green">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check2-circle h-4 w-4 mr-2" viewBox="0 0 16 16">
                                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                            </svg>
                                            Veröffentlichen
                                        </x-custom.button.button-blank>
                                    </div>
                                    <div>
                                        <x-custom.button.button-blank wire:click="destroy('{{ $veranstaltungen->slug }}')" color="red">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3 w-4 h-4 mr-2" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                            Löschen
                                        </x-custom.button.button-blank>
                                    </div>
                                @else
                                    <div>
                                        <x-custom.button.button-blank wire:click="published('{{ $veranstaltungen->slug }}', '0')" color="yellow">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-circle w-4 h-4 mr-2" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            Verbergen
                                        </x-custom.button.button-blank>
                                    </div>
                                    <div>
                                        <x-custom.button.button-blank wire:click="destroy('{{ $veranstaltungen->slug }}')" color="red">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3 w-4 h-4 mr-2" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                            Löschen
                                        </x-custom.button.button-blank>
                                    </div>
                               @endif
                            @endhasanyrole
                            <div>
                                Bei FRAGEN zu dieser Veranstaltung wende dich bitte <span class="text-red-700">DIREKT AN DEN VERANSTALTER</span>! {{ env('TTF_URL') }} ist nicht der Veranstalter und kann deshalb keine Auskünfte erteilen.
                            </div>
                            <div class="text-red-700">
                                © Copyright & Urheberrecht von Veranstaltungsbild und -text liegt beim jeweiligen Veranstalter und/oder deren Fotografen. Änderungen und Irrtümer vorbehalten.
                            </div>
                        </div>
                        <div class="border-b border-primary-500 mt-4 lg:mt-0 lg:border-0"></div>
                    </div>
                    <!-- end Veranstaltung Details -->
                </div>
            </div>

        </div>

    </div>
</div>
