@php use Carbon\Carbon; @endphp
<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">

        <div class="grid grid-cols-1 gap-4">

            <div class="my-8 rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                <div class="shadow-xl @if($teams->published) bg-green-700 @else bg-red-700 @endif p-2 text-white text-center font-bold text-xl rounded">
                    Mitgliedsantrag #{{ $teams->id }}</div>
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <div class="col-span-2 @if($teams->fahrzeug_vorhanden) lg:col-span-1 @endif shadow-xl bg-gray-100 dark:bg-gray-800 p-4 rounded">
                        <h1 class="font-bold text-xl text-center">Persönliche Daten:</h1>
                        <div class="flex flex-col lg:flex-row py-1">
                            <span class="w-1/3 font-bold">Name:</span>
                            <p class="w-2/3">
                                <span>{{ $teams->anrede }}</span>
                                <span>{{ $teams->fullname() }}</span>
                            </p>
                        </div>
                        <div class="flex flex-col lg:flex-row py-1">
                            <span class="w-1/3 font-bold">Anschrift:</span>
                            <p class="w-2/3">
                                <span>{{ $teams->strasse }}</span><br>
                                <span>{{ $teams->plz . ' ' . $teams->wohnort }}</span>
                            </p>
                        </div>
                        <div class="flex flex-col lg:flex-row py-1">
                            <span class="w-1/3 font-bold">Geburtsdatum:</span>
                            <p class="w-2/3">
                                <span>{{ $teams->geburtsdatum() . ' / ' . $teams->alter() }}</span>
                            </p>
                        </div>
                        <div class="flex flex-col lg:flex-row py-1">
                            <span class="w-1/3 font-bold">Beruf:</span>
                            <p class="w-2/3">
                                <span>{{ $teams->beruf }}</span>
                            </p>
                        </div>
                        <div class="flex flex-col lg:flex-row py-1">
                            <span class="w-1/3 font-bold">Kontaktmöglichkeiten:</span>
                            <p class="w-2/3">
                                <span>{!! $teams->kontaktTeamUser() !!}</span>
                            </p>
                        </div>
                        @if($teams->facebook or $teams->tiktok or $teams->instagram)
                            <div class="flex flex-col lg:flex-row py-1">
                                <span class="w-1/3 font-bold">Social Media:</span>
                                <div class="w-2/3">
                                    <div class="flex items-center">
                                        @if($teams->facebook)
                                            <a class="font-bold mr-2 rounded-full shadow-xl bg-gray-900 hover:bg-gray-700 h-7 w-7 flex justify-center items-center" href="https://www.facebook.com/{{ $teams->facebook }}">
                                                <svg role="img" viewBox="0 0 24 24" class="w-4 h-4 fill-[#1877F2]" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                </svg>
                                            </a>
                                        @endif
                                        @if($teams->tiktok)
                                            <a class="text-black font-bold mr-2 rounded-full shadow-xl bg-gray-900 hover:bg-gray-700 h-7 w-7 flex justify-center items-center" href="https://www.tiktok.com/{{ '@'.$teams->tiktok }}">
                                                <svg role="img" viewBox="0 0 24 24" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                                </svg>
                                            </a>
                                        @endif
                                        @if($teams->instagram)
                                            <a class="font-bold rounded-full shadow-xl bg-gray-900 hover:bg-gray-700 h-7 w-7 flex justify-center items-center" href="https://www.instagram.com/{{ $teams->instagram }}/">
                                                <svg role="img" viewBox="0 0 24 24" class="w-4 h-4 fill-[#E4405F]" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="flex flex-col gap-2 py-1">
                            <span class="w-full font-bold">Beschreibung:</span>
                            <p class="w-full overflow-auto">
                                <span>{!! html_entity_decode($teams->description) !!}</span>
                            </p>
                        </div>
                        @if($teams->profilBild())
                            <div class="flex flex-col lg:flex-row py-1">
                                <span class="w-1/3 font-bold">Profilbild:</span>
                                <div class="w-2/3">
                                    <div class="w-[156px] h-[156px] rounded border border-gray-500 bg-gray-300 dark:bg-gray-700 flex justify-center items-center shadow-xl">
                                        <img src="{{ $teams->profilBild() }}" class="w-[144px] h-[144px] object-cover object-center rounded" alt="Profilbild: {{ $teams->fullname() }}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($teams->fahrzeug_vorhanden)
                        @foreach($teams->fahrzeuges as $fahrzeuge)
                            <div class="col-span-2 lg:col-span-1 shadow-xl bg-gray-100 dark:bg-gray-800 p-4 rounded">
                                <h1 class="font-bold text-xl text-center">Fahrzeugdaten:</h1>
                                <div class="flex flex-col lg:flex-row py-1">
                                    <span class="w-1/3 font-bold">Fahrzeug:</span>
                                    <p class="w-2/3">
                                        <span>{!! $fahrzeuge->fahrzeug !!}</span>
                                    </p>
                                </div>
                                @if($fahrzeuge->baujahr)
                                    <div class="flex flex-col lg:flex-row py-1">
                                        <span class="w-1/3 font-bold">Baujahr:</span>
                                        <p class="w-2/3">
                                            <span>{!! Carbon::parse($fahrzeuge->baujahr)->format('M. Y') !!}</span>
                                        </p>
                                    </div>
                                @endif
                                @if($fahrzeuge->besonderheiten)
                                    <div class="flex flex-col lg:flex-row py-1">
                                        <span class="w-1/3 font-bold">Besonderheiten:</span>
                                        <p class="w-2/3">
                                            <span>{!! $fahrzeuge->besonderheiten !!}</span>
                                        </p>
                                    </div>
                                @endif
                                @if($fahrzeuge->motor)
                                    <div class="flex flex-col lg:flex-row py-1">
                                        <span class="w-1/3 font-bold">Motor:</span>
                                        <p class="w-2/3">
                                            <span>{!! $fahrzeuge->motor !!}</span>
                                        </p>
                                    </div>
                                @endif
                                @if($fahrzeuge->karosserie)
                                    <div class="flex flex-col lg:flex-row py-1">
                                        <span class="w-1/3 font-bold">Karosserie:</span>
                                        <p class="w-2/3">
                                            <span>{!! $fahrzeuge->karosserie !!}</span>
                                        </p>
                                    </div>
                                @endif
                                @if($fahrzeuge->felgen)
                                    <div class="flex flex-col lg:flex-row py-1">
                                        <span class="w-1/3 font-bold">Felgen:</span>
                                        <p class="w-2/3">
                                            <span>{!! $fahrzeuge->felgen !!}</span>
                                        </p>
                                    </div>
                                @endif
                                @if($fahrzeuge->fahrwerk)
                                    <div class="flex flex-col lg:flex-row py-1">
                                        <span class="w-1/3 font-bold">Fahrwerk:</span>
                                        <p class="w-2/3">
                                            <span>{!! $fahrzeuge->fahrwerk !!}</span>
                                        </p>
                                    </div>
                                @endif
                                @if($fahrzeuge->bremsen)
                                    <div class="flex flex-col lg:flex-row py-1">
                                        <span class="w-1/3 font-bold">Bremsen:</span>
                                        <p class="w-2/3">
                                            <span>{!! $fahrzeuge->bremsen !!}</span>
                                        </p>
                                    </div>
                                @endif
                                @if($fahrzeuge->innenraum)
                                    <div class="flex flex-col lg:flex-row py-1">
                                        <span class="w-1/3 font-bold">Innenraum:</span>
                                        <p class="w-2/3">
                                            <span>{!! $fahrzeuge->innenraum !!}</span>
                                        </p>
                                    </div>
                                @endif
                                @if($fahrzeuge->anlage)
                                    <div class="flex flex-col lg:flex-row py-1">
                                        <span class="w-1/3 font-bold">Anlage:</span>
                                        <p class="w-2/3">
                                            <span>{!! $fahrzeuge->anlage !!}</span>
                                        </p>
                                    </div>
                                @endif
                                @if($fahrzeuge->description)
                                    <div class="flex flex-col gap-2 py-1">
                                        <span class="w-full font-bold">Beschreibung:</span>
                                        <p class="w-full overflow-auto">
                                            <span>{!! nl2br(html_entity_decode($fahrzeuge->description)) !!}</span>
                                        </p>
                                    </div>
                                @endif
                                @if(!empty($teams->albums))
                                    <div class="flex flex-col gap-2 py-1">
                                        <span class="w-full font-bold">Fahrzeugbilder:</span>
                                        <div class="flex flex-wrap justify-evenly gap-2">
                                            @foreach($teams->albums->photos as $photo)
                                                <div class="w-[156px] h-[156px] rounded border border-gray-500 bg-gray-300 dark:bg-gray-700 flex justify-center items-center shadow-xl">
                                                    <img src="{{ asset($teams->albums->path.'/'.$photo->images_thumbnail) }}" data-src="{{ asset($teams->albums->path.'/'.$photo->images) }}" class="w-[144px] h-[144px] object-cover object-center rounded lozad" alt="Fahrzeugbild: {{ $teams->images_thumbnail }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>

                @if(count($alben) > 0)
                    <div class="col-span-2 lg:col-span-1 shadow-xl bg-gray-100 dark:bg-gray-800 p-4 rounded">

                        <div class="flex flex-col gap-2 py-1">
                            <h1 class="font-bold text-xl text-center">Galerie:</h1>
                            <div class="flex flex-wrap justify-evenly gap-2">
                                @foreach($alben as $album)
                                    <div>
                                        <x-custom.links.a-blank href="{{ route('frontend.galerie.show', $album->slug) }}" class="!block !shadow-none">
                                            <div class="w-[156px] h-[156px] rounded border border-gray-500 bg-gray-300 dark:bg-gray-700 flex justify-center items-center shadow-xl">
                                                <img src="{{ $album->thumbnail() }}" data-src="{{ $album->thumbnail() }}" class="w-[144px] h-[144px] object-cover object-center rounded lozad" alt="Fahrzeugbild: {{ $teams->slug }}">
                                            </div>
                                            <div class="text-center mt-2 w-[156px]">
                                                {{ $album->title }}
                                            </div>
                                        </x-custom.links.a-blank>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                @endif

                <div class="col-span-2 lg:col-span-1 shadow-xl bg-gray-100 dark:bg-gray-800 p-4 rounded">
                    <div class="flex justify-between flex-col">
                        @if(!$teams->published)
                            <form wire:submit.prevent="checked">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div class="col-span-2 lg:col-span-1">
                                        <x-custom.form.input id="slug" wire:model="slug" text="Title"/>
                                            <x-custom.form.select-label id="zahlungsArt" wire:model.live="zahlungsArt">
                                                <option value="">Noch nicht Bekannt</option>
                                                <option value="Mitgliedsbeitrag">Mitgliedsbeitrag</option>
                                                <option value="Werkstatt">Werkstatt</option>
                                                <option value="Miete">Miete</option>
                                            </x-custom.form.select-label>
                                            @if($zahlung)
                                                <x-custom.form.input class="mt-2" id="zahlung" type="number" wire:model.blur="zahlung" text="Zahlung"/>
                                            @endif
{{--                                        <x-custom.form.input class="mt-2" type="date" id="published_at" wire:model="published_at" text="Mitglied seit"/>--}}
                                        <x-custom.form.select-label id="function" wire:model="function">
                                            <option value="Clubmitglied">Clubmitglied</option>
                                            <option value="Passives Mitglied">Passives Mitglied</option>
                                            <option value="Gründungsmitglied">Gründungsmitglied</option>
                                            <option value="Werkstattmieter">Werkstattmieter</option>
                                        </x-custom.form.select-label>
                                        @if(!empty($teams->fahrzeuges_id))
                                            @if(!empty($teams->albums))
                                                <x-custom.form.input type="hidden" id="albumID" wire:model="albumID" wire:key="{{ $teams->albums->id }}"/>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-span-2 lg:col-span-1 text-right">
                                        <x-custom.button.button target="checked" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-2 text-success-700 bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                            </svg>
                                            Freigeben
                                        </x-custom.button.button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form wire:submit.prevent="revoke">
                                <div class="flex justify-between items-start gap-4">
                                    <div class="w-1/2 flex flex-wrap">
                                        <x-custom.form.select-label text="Beitrag/Miete" id="zahlungsArt" wire:model.live="zahlungsArt">
                                            <option value="">Noch nicht Bekannt</option>
                                            <option value="Mitgliedsbeitrag">Mitgliedsbeitrag</option>
                                            <option value="Werkstatt">Werkstatt</option>
                                            <option value="Miete">Miete</option>
                                        </x-custom.form.select-label>
                                        @if($zahlung)
                                            <x-custom.form.input class="mt-4" id="zahlung" type="number" wire:model.blur="zahlung" text="Zahlung"/>
                                        @endif
                                    </div>
                                    <div class="w-1/2 text-right">
                                    @if(!empty($teams->fahrzeuges_id))
                                        @if(!empty($teams->albums))
                                            <x-custom.form.input type="hidden" id="albumID" wire:model="albumID" wire:key="{{ $teams->albums->id }}"/>
                                        @endif
                                    @endif
                                    <x-custom.button.button target="revoke" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-2 text-red-700 bi bi-x-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                        Zurückziehen
                                    </x-custom.button.button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                @hasanyrole('super_admin|admin')
                <div class="col-span-2 lg:col-span-1 shadow-xl bg-gray-100 dark:bg-gray-800 p-4 rounded">
                    <div class="flex items-end flex-col">
                        <x-custom.button.button wire:click="destroy({{ $teams->id }})">Löschen</x-custom.button.button>
                    </div>
                </div>
                @endhasanyrole
                <div class="flex items-end flex-col">
                    <div class="text-sm">IP Adresse: {{ $teams->ip_adresse }}</div>
                    <div class="text-sm">Erstellt am: {{ Carbon::parse($teams->created_at)->isoFormat('DD. MMM. YYYY HH:mm:ss') }}</div>
                    @if($teams->published)
                        <div class="text-sm">Angenommen am: {{ Carbon::parse($teams->published_at)->isoFormat('DD. MMM. YYYY') }}</div>
                    @endif
                </div>
            </div>

        </div>

    </div>
</div>
