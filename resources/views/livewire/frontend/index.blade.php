@php use Carbon\Carbon; @endphp
<div>
    <!-- Hero -->
    <section class="bg-gray-100 dark:bg-gray-900">
        <div class="grid max-w-screen-2xl px-4 py-8 mx-auto lg:gap-8 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-6">
                <h1 class="max-w-xl mb-4 text-2xl font-extrabold tracking-tight leading-none xl:text-4xl dark:text-white">
                    Willkommen bei den <span class="text-primary-500">Thüringer Tuning Freunden</span></h1>
                <p class="mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Ein lustiges
                    Team, das gerne schraubt, grillt und sich mit anderen Clubs trifft.</p>
                <h2 class="max-w-xl mb-4 text-2xl font-extrabold tracking-tight leading-none xl:text-4xl dark:text-white">
                    Das <span class="text-primary-500">bieten</span> wir</h2>
                <p class="mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Eine Werkstatt
                    mit der Möglichkeit das ihr an euren Autos was machen könnt. Unsere
                    Werkstatt und unser Club befindet sich in Sömmerda. Wir sind
                    für euch da, wenn ihr Hilfe braucht, egal bei welchem Anliegen, wir helfen gerne.</p>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-6 lg:flex h-[420px]">
                <img src="{{ asset('images/logo.svg') }}" data-src="{{ asset('images/hero-focus.webp') }}" alt="Hero Images" class="block w-full h-auto object-cover object-center rounded-lg border border-gray-500 shadow-xl shadow-gray-400 dark:shadow-black lozad">
            </div>
        </div>
    </section>
    <!-- Hero end -->
    <!-- Über uns -->
    <livewire:frontend.ueber-uns/>
    <!-- Über uns end -->
    @if(count($teams) > 0)
        <!-- Team -->
        <section class="bg-gray-100 dark:bg-gray-900" id="team">
            <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6 text-center">
                <h2 class="mb-8 text-3xl font-bold">
                    <span class="text-primary-500 dark:text-primary-500">Team</span>
                </h2>

                <div class="swiper slider">
                    <div class="swiper-wrapper">

                        @foreach($teams as $team)
                            @if(Carbon::parse($team->published_at) <= Carbon::parse(now()))
                                <div class="bg-gray-50 dark:bg-gray-800 my-8 shadow-xl shadow-gray-400 dark:shadow-gray-900 rounded group swiper-slide" lazy="true">
                                    <div class="relative overflow-hidden bg-gray-500 rounded-t-lg">
                                        @if(!empty($team->photo_id))
                                            <a href="{{ route('frontend.team.show', $team->slug) }}">
                                                <div class="absolute w-full h-[306px] z-10 blur" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ),  url('{{ $team->profilBild() }}') center no-repeat; background-size: auto, cover;"></div>
                                                <div class="filter-none z-20 relative w-[306px] h-[274px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ $team->profilBild() }}') center no-repeat; background-size: 306px, auto;"></div>
                                            </a>
                                        @else
                                            <div class="bg-gray-500">
                                                <a href="{{ route('frontend.team.show', $team->slug) }}">
                                                    <div class="w-full h-[306px] text-[9rem] leading-[19.125rem] rounded-t-lg group-hover:scale-110 group-hover:text-primary-500 gluten transition duration-300">
                                                        {{ teamInitial($team) }}
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                        @if($team->facebook == true or $team->tiktok == true or $team->instagram == true)
                                            <div class="absolute left-0 bottom-0 right-0 h-10 opacity-0 group-hover:opacity-50 bg-black flex items-center justify-center gap-4 hover:ease-in-out duration-300 z-50">
                                                @if($team->tiktok == true)
                                                    <!-- TikTok -->
                                                    <a href="https://www.tiktok.com/{{ '@'.$team->tiktok }}" target="_blank">
                                                        <svg role="img" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 hover:text-[#00f2ea]" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                                @if($team->facebook == true)
                                                    <!-- Facebook -->
                                                    <a href="https://www.facebook.com/{{ $team->facebook }}" target="_blank">
                                                        <svg role="img" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 hover:text-[#1877F2]" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                                @if($team->instagram == true)
                                                    <!-- Instagram -->
                                                    <a href="https://www.instagram.com/{{ $team->instagram }}" target="_blank">
                                                        <svg role="img" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 hover:text-[#E4405F]" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="px-3.5 py-6">
                                        <a href="{{ route('frontend.team.show', $team->slug) }}" class="hover:text-gray-500 hover:dark:text-white">
                                            <h4 class="text-lg font-bold mb-1.5">{{ $team->fullname() }}</h4>
                                            @if(Cache::has('user-is-online-'.$team->id))
                                                <span class="block text-xs text-green-500">Online</span>
                                            @else
                                                <span class="block text-xs text-red-500">Offline</span>
                                            @endif
                                            <span class="block text-xs text-gray-500">{{ $team->funktion }}</span>
                                            <p class="italic h-24">{!! strip_tags(Str::limit($team->description, 120)) !!}</p>
                                        </a>
                                        <div class="flex flex-col justify-center">
                                            <a href="{{ route('frontend.team.show', $team->slug) }}" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                                </svg>
                                                Über mich
                                            </a>
                                            @can('edit')
                                                @hasanyrole('super_admin|admin')
                                                @if(auth()->user()->id !== $team->user_id)
                                                    <a href="{{ route('frontend.team.edit', $team->slug) }}" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                        </svg>
                                                        Bearbeiten
                                                    </a>
                                                @endif
                                                @endhasrole
                                                @if(auth()->user()->id === $team->user_id)
                                                    <a href="{{ route('frontend.team.edit', $team->slug) }}" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                        </svg>
                                                        Über mich bearbeiten
                                                    </a>
                                                @endif
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </section>
        <!-- Team end -->
    @endif
    @if(count($fahrzeuge) > 0)
        <!-- Fahrzeuge -->
        <section class="bg-gray-50 dark:bg-gray-800" id="fahrzeuge">
            <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6 text-center">
                <h2 class="mb-8 text-3xl font-bold">
                    <span class="text-primary-500 dark:text-primary-500">Fahrzeuge</span>
                </h2>

                <div class="swiper slider">
                    <div class="swiper-wrapper">

                        @foreach($fahrzeuge as $fahrzeug)
                            @if($fahrzeug->published)
                                <div class="bg-gray-100 dark:bg-gray-900 my-8 shadow-xl shadow-gray-400 dark:shadow-gray-900 rounded group swiper-slide" lazy="true">
                                    <div class="relative overflow-hidden bg-gray-500 rounded-t-lg">
                                        @if(!empty($fahrzeug->albums->thumbnail_id))
                                            <div class="absolute w-full h-[360px] z-10 blur-sm" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ),  url('{{ $fahrzeug->fahrzeugBildMeta() }}') center no-repeat; background-size: auto, cover;"></div>
                                            <div class="filter-none z-20 relative w-[306px] h-[306px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ $fahrzeug->fahrzeugBildMeta() }}') center no-repeat; background-size: auto, 306px;"></div>
                                        @else
                                            <div class="absolute w-full h-[360px] z-10 blur" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ),  url('{{ asset('images/logo.svg') }}') center no-repeat; background-size: auto, cover;"></div>
                                            <div class="filter-none z-20 relative w-[306px] h-[306px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ asset('images/logo.svg') }}') center no-repeat; background-size: auto, 306px;"></div>
                                        @endif
                                    </div>
                                    <div class="px-3.5 py-6">
                                        <a href="{{ route('frontend.fahrzeuge.show', $fahrzeug->slug) }}" class="hover:text-gray-500 hover:dark:text-white">
                                            <h4 class="text-lg font-bold mb-1.5">{{ $fahrzeug->fahrzeug }}</h4>
                                            <span class="block text-xs text-gray-500">gefahren von: {{ $fahrzeug->teams->vorname }}</span>
                                            <p class="italic h-24">{!! strip_tags(Str::limit(html_entity_decode($fahrzeug->description), 120)) !!}</p>
                                        </a>
                                        <div class="flex flex-col justify-center gap-2">
                                            <a href="{{ route('frontend.fahrzeuge.show', $fahrzeug->slug) }}" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                                </svg>
                                                zum Fahrzeug
                                            </a>
                                            @can('edit')
                                                @hasanyrole('super_admin|admin')
                                                @if(auth()->user()->id !== $fahrzeug->user_id)
                                                    <a href="{{ route('frontend.fahrzeuge.edit', $fahrzeug->slug) }}" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                        </svg>
                                                        Fahrzeug bearbeiten
                                                    </a>
                                                @endif
                                                @endhasanyrole
                                                @if(auth()->user()->id === $fahrzeug->user_id)
                                                    <a href="{{ route('frontend.fahrzeuge.edit', $fahrzeug->slug) }}" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                        </svg>
                                                        Fahrzeug bearbeiten
                                                    </a>
                                                @endif
                                            @endcan
                                            @hasanyrole('super_admin|admin')
                                                <x-custom.button.button-blank wire:click="unpublished('{{ $fahrzeug->slug }}')" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-eye-slash h-4 w-4 fill-red-700" viewBox="0 0 16 16">
                                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                                        <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>
                                                    Zurückziehen
                                                </x-custom.button.button-blank>
                                                <x-custom.delete.sweetAlert />
                                                @if(auth()->id() === $fahrzeug->user_id)
                                                    <x-custom.delete.delete-button-blank delete-i-d="{{ $fahrzeug->slug }}" />
                                                @else
                                                    <x-custom.delete.delete-button-blank delete-i-d="{{ $fahrzeug->slug }}" color="red-2" />
                                                @endif
                                            @endhasanyrole
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </section>
        <!-- Fahrzeuge end -->
    @endif
    @if(count($alben) > 0)
        <!-- Galerie -->
        <section class="bg-gray-100 dark:bg-gray-900" id="galerie">

            <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6 text-center">
                <h2 class="mb-8 text-3xl font-bold">
                    <span class="text-primary-500 dark:text-primary-500">Galerie</span>
                </h2>

                <div class="swiper slider">
                    <div class="swiper-wrapper">

                        @foreach($alben as $album)
                            @php
                                if (!$album->kategorie === 'Fahrzeuge') {
                                    $route = route('frontend.fahrzeuge.show', $album->slug);
                                } else {
                                    $route = route('frontend.galerie.show', $album->slug);
                                }
                            @endphp
                            <a href="{{ $route }}" title="zum Album: {{ $album->title }}">
                            <div class="swiper-slide group">
                                <div class="relative transition shadow-xl shadow-gray-400 dark:shadow-gray-900 my-8 duration-300 overflow-hidden z-10 rounded-lg before:absolute before:left-[30px] before:right-[30px] before:top-[30px] before:bottom-[30px] before:duration-300 before:z-20 before:opacity-0 group-hover:before:opacity-100 before:bg-gray-900/60 before:rounded-lg group-hover:before:left-0 group-hover:before:right-0 group-hover:before:top-0 group-hover:before:bottom-0" lazy="true">
                                    @if($album->thumbnail_id)
                                        <div class="absolute w-full h-full z-10 blur-sm" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ), url('{{ $album->thumbnail() }}') center no-repeat; background-size: auto, cover;"></div>
                                        <div class="filter-none z-20 relative w-[306px] h-[274px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ $album->thumbnail() }}') center no-repeat; background-size: auto, 306px;"></div>
                                    @else
                                        <div class="absolute w-full h-full z-10 blur-sm" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ), url('{{ asset('images/logo.svg') }}') center no-repeat; background-size: auto, cover;"></div>
                                        <div class="filter-none z-20 relative w-[306px] h-[274px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ asset('images/logo.svg') }}') center no-repeat; background-size: auto, 306px;"></div>
                                    @endif
                                    <div class="opacity-0 group-hover:opacity-100 absolute left-0 right-0 top-0 bottom-0 text-center z-30 duration-300 flex flex-col justify-center items-center
                                    before:block before:w-12 before:h-12 before:absolute before:top-[35px] before:left-[35px] before:border-t-2 before:border-t-gray-400 before:border-l-2 before:border-l-gray-400 before:duration-300 before:z-50 group-hover:before:top-[15px] group-hover:before:left-[15px]
                                    after:block after:w-12 after:h-12 after:absolute after:right-[35px] after:bottom-[35px] after:border-r-2 after:border-r-gray-400 after:border-b-2 after:border-b-gray-400 after:duration-300 after:z-50 group-hover:after:right-[15px] group-hover:after:bottom-[15px]">
                                        <h4 class="text-xl font-semibold">{!! strip_tags(Str::limit($album->title, 30)) !!}</h4>
                                        <p class="text-sm p-0 m-0 uppercase">{!! strip_tags(Str::limit($album->description, 30)) !!}</p>
                                        <div class="z-40">
                                            <a href="{{ $route }}" title="zum Album: {{ $album->title }}" class="mx-0.5 inline-block duration-300 hover:text-primary-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        @endforeach

                    </div>
                </div>

            </div>
        </section>
        <!-- Galerie end -->
    @endif
    @if(count($veranstaltungen) > 0)
        <!-- Veranstaltungen -->
        <section class="bg-gray-50 dark:bg-gray-800" id="veranstaltungen">

            <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6 text-center">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold mb-4">
                        <span class="text-primary-500 dark:text-primary-500">Veranstaltungen</span>
                    </h2>
                    @if(Request::is('/'))
                        <a href="{{ route('frontend.veranstaltungen.index') }}" >Übersicht</a>
                    @endif
                    <p class="mt-4"><span class="text-green-500">Grün hinterlegt:</span> Wir sind voraussichtlich
                        anwesend</p>
                </div>

                @if(count($veranstaltungen) > 0)
                    <div class="grid gap-8 grid-cols-1 md:grid-cols-2 text-center">

                        @if(!Request::is('/'))
                            <div class="col-span-2">
                                <div class="flex justify-end items-center">
                                    <a href="" class="inline-flex gap-4 text-lg leading-none items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-printer w-4 h-4" viewBox="0 0 16 16">
                                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                        </svg>
                                        Drucken
                                    </a>
                                </div>
                            </div>
                        @endif

                        @foreach($veranstaltungen as $veranstaltung)
                            <div class="col-span-2 md:col-span-1">
                                <!-- if Schleife -->
                                @if(Carbon::parse($veranstaltung->datum_von)->isoFormat('DD.MM.YYYY') != date('d.m.Y') or Carbon::parse($veranstaltung->datum_bis)->isoFormat('DD.MM.YYYY') == date('d.m.Y'))
                                    <div class="flex justify-start w-full h-full bg-gray-100 rounded shadow-2xl dark:bg-gray-900 transition-all ease-in-out duration-300 group hover:scale-105">
                                        <div class="{{ $veranstaltung->anwesend ? 'bg-green-200 dark:bg-green-800' : 'bg-gray-200 dark:bg-gray-800' }} rounded-s flex content-between flex-wrap w-24 md:w-1/5 border-r border-gray-700 group-hover:border-primary-500">
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
                                                    @if(Carbon::parse($veranstaltung->datum_von)->isoFormat('MM') == Carbon::parse($veranstaltung->datum_bis)->month()->isoFormat('MM'))
                                                        <span class="gluten flex justify-center leading-none text-xl -mb-1">{{ Carbon::parse($veranstaltung->datum_bis)->shortMonthName }}</span>
                                                    @endif
                                                    @if(Carbon::parse($veranstaltung->datum_von)->isoFormat('YYYY') != Carbon::parse($veranstaltung->datum_bis)->isoFormat('YYYY'))
                                                        <span class="gluten flex justify-center leading-none text-sm">{{ Carbon::parse($veranstaltung->datum_bis)->isoFormat('YYYY') }}</span>
                                                    @endif
                                                </time>
                                            </div>
                                            <div class="flex justify-evenly w-full p-1 text-center leading-none">
                                                @if(!$veranstaltung->anwesend)
                                                    <form wire:submit.prevent="anwesend('{{ $veranstaltung->id }}')">
                                                        <x-custom.button.button-blank type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check2-circle w-4 h-4 text-green-700 hover:text-green-500" viewBox="0 0 16 16">
                                                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                                            </svg>
                                                        </x-custom.button.button-blank>
                                                    </form>
                                                @else
                                                    <form wire:submit.prevent="abwesend('{{ $veranstaltung->id }}')">
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
                                                <div class="w-full md:w-[95%]">
                                                    Laufzeit: {{ getDaysRate($veranstaltung->datum_von, $veranstaltung->datum_bis) + 1 }}
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
                                <!-- end if Schleife -->
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2 text-center">
                        <div class="col-span-2 items-center bg-gray-100 rounded shadow-xl shadow-gray-400 dark:shadow-gray-900 my-8 sm:flex dark:bg-gray-900 dark:border-gray-700 group hover:scale-105">
                            <div class="flex flex-col justify-center items-center w-full">
                                <div class="font-bold py-4 text-2xl">Es sind leider keine Veranstaltungen eingetragen.
                                </div>
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
        </section>
        <!-- Veranstaltungen end -->
    @endif
</div>
