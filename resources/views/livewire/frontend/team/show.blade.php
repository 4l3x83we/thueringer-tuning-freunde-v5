@php use Carbon\Carbon; @endphp
<div>
    <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6">

        <div class="profile-page">
            <div class="bg-gray-100 dark:bg-gray-900 rounded shadow-xl p-4 mt-0 md:mt-12">
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="grid grid-cols-3 text-center order-last md:order-first mt-6 md:mt-0">
                        <div>
                            <a href="#fahrzeuge">
                            <p class="font-bold text-xl purecounter" data-purecounter-start="0" data-purecounter-end="{{ $fahrzeuge->count() }}" data-purecounter-duration="1">
                                0</p>
                            <p class="text-gray-400">Fahrzeuge</p>
                            </a>
                        </div>
                        <div>
                            <a href="#alben">
                            <p class="font-bold text-xl purecounter" data-purecounter-start="0" data-purecounter-end="{{ $alben->count() }}" data-purecounter-duration="1">
                                0</p>
                            <p class="text-gray-400">Alben</p>
                            </a>
                        </div>
                        <div>
                            <p class="font-bold text-xl purecounter" data-purecounter-start="0" data-purecounter-end="{{ $photo }}" data-purecounter-duration="1">
                                0</p>
                            <p class="text-gray-400">Photos</p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="w-32 h-32 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-20 flex items-center justify-center bg-gray-200 dark:bg-gray-600">
                            @if($team->photo_id)
                                <img src="{{ $team->profilBild() }}" alt="{{ $team->vorname }}" class="w-32 h-32 object-cover object-center rounded-full">
                            @else
                                <div class="relative inline-flex items-center justify-center w-32 h-32 overflow-hidden bg-gray-200 rounded-full dark:bg-gray-700">
                                    <span class="font-medium text-gray-600 dark:text-gray-300 text-6xl">{{ teamInitial($team) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-x-4 flex justify-between mt-16 md:mt-0 md:justify-end">
                        <div>
                            <livewire:frontend.helpers.write-me :team="$team"/>
                        </div>
                        @can('edit')
                            <div>
                                @hasanyrole('super_admin|admin')
                                    @if(auth()->user()->id !== $team->user_id)
                                        <x-custom.links.button-link color="blue" href="{{ route('frontend.team.edit', $team->slug) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil h-4 w-4" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </x-custom.links.button-link>
                                    @endif
                                @endhasanyrole
                                @if(auth()->user()->id === $team->user_id)
                                    <x-custom.links.button-link color="blue" href="{{ route('frontend.team.edit', $team->slug) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen h-4 w-4" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </x-custom.links.button-link>
                                @endif
                            </div>
                        @endcan
                        @can('destroy')
                            @if(auth()->id() === $team->user_id)
                                <div>
                                    <livewire:frontend.helpers.all-delete :team="$team"/>
                                </div>
                            @else
                                @hasanyrole('super_admin|admin')
                                    <div>
                                        <livewire:frontend.helpers.all-delete :team="$team"/>
                                    </div>
                                @endhasanyrole
                            @endif
                        @endcan
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div></div>
                    <div class="md:mt-9 text-center">
                        <h1 class="text-4xl font-medium">{{ ucfirst($team->slug) }},
                            <span class="font-light opacity-60">{{ $team->alter() }}</span>
                        </h1>
                        <p class="text-base opacity-75 mt-1">{{ $team->funktion }}</p>
                        <div class="flex my-4 space-x-5 justify-center">
                            <a href="https://www.instagram.com/{{ $team->instagram }}" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                <svg class="w-4 h-4 text-[#E4405F] hover:text-[#e4407a]" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/{{ $team->facebook }}" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                <svg class="w-4 h-4 text-[#1877F2] hover:text-[#189bf2]" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://www.tiktok.com/{{ '@'.$team->tiktok }}" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                <svg role="img" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-[#00f2ea] hover:text-[#00f2c2]" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="md:mt-9">
                        <table class="w-full border-0 text-base">
                            <tbody>
                            <tr class="align-top">
                                <th class="text-right px-2">Mitglied seit:</th>
                                <td class="text-left px-2">{{ Carbon::parse($team->published_at)->format('d.m.Y') }}</td>
                            </tr>
                            <tr class="align-top">
                                <th class="text-right px-2">Wohnort:</th>
                                <td class="text-left px-2">{{ $team->wohnort }}</td>
                            </tr>
                            <tr class="align-top">
                                <th class="text-right px-2">Beruf:</th>
                                <td class="text-left px-2">{{ $team->beruf }}</td>
                            </tr>
                            <tr class="align-top">
                                <th class="text-right px-2">Letzte Änderungen:</th>
                                <td class="text-left px-2">{{ Carbon::parse($team->updated_at)->fromNow() }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 flex flex-col justify-center text-base border-t border-primary-500 pt-6">
                    <div class="profilText">
                        {!! $team->description !!}
                    </div>
                </div>

                @if(count($fahrzeuge) >0)
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 border-t border-primary-500 mt-4 pt-4" id="fahrzeuge">
                        <div class="col-span-2 md:col-span-4 lg:col-span-8">
                            <h4 class="text-2xl">Fahrzeug{{ count($fahrzeuge) > 1 ? 'e' : '' }}</h4>
                        </div>
                        @foreach($fahrzeuge as $fahrzeug)
                            <a href="{{ route('frontend.fahrzeuge.show', $fahrzeug->slug) }}" title="Galerie anzeigen: {{ $fahrzeug->title }}">
                                <div class="relative overflow-hidden bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 shadow-xl group">
                                    <div class="w-full p-1 relative overflow-hidden">
                                        <img src="{{ asset('images/logo.svg') }}" data-src="{{ $fahrzeug->fahrzeugBild() }}" class="h-auto max-w-full rounded group-hover:scale-110 group-hover:mb-1 group-hover:rounded-t overflow-hidden object-contain object-center duration-400 lozad" alt="{{ $fahrzeug->title }}">
                                    </div>
                                    <div class="p-1 overflow-hidden text-center">
                                        <h4 class="font-bold leading-none text-base group-hover:text-primary-500 group-hover:pt-1">{!! strip_tags(Str::limit($fahrzeug->fahrzeug, 30)) !!}</h4>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                @if(count($alben) >0)
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 border-t border-primary-500 mt-4 pt-4" id="alben">
                        <div class="col-span-2 md:col-span-4 lg:col-span-8">
                            <h4 class="text-2xl">Galerie</h4>
                        </div>
                        @foreach($alben as $album)
                            <a href="{{ route('frontend.galerie.show', $album->slug) }}" title="Galerie anzeigen: {{ $album->title }}">
                                <div class="relative overflow-hidden bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 shadow-xl group">
                                    <div class="w-full p-1 relative overflow-hidden">
                                        <img src="{{ asset('images/logo.svg') }}" data-src="{{ $album->thumbnail() }}" class="h-auto max-w-full rounded group-hover:scale-110 group-hover:mb-1 group-hover:rounded-t overflow-hidden object-contain object-center duration-400 lozad" alt="{{ $album->title }}">
                                    </div>
                                    <div class="p-1 overflow-hidden text-center">
                                        <h4 class="font-bold leading-none text-base group-hover:text-primary-500 group-hover:pt-1">{!! strip_tags(Str::limit($album->title, 30)) !!}</h4>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>

