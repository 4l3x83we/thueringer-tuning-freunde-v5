@php use Carbon\Carbon; @endphp
<div>
    <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6">

        @if(count($teams) > 0)
            <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                @foreach($teams as $team)
                    @if(Carbon::parse($team->published_at) <= Carbon::now())
                        <div class="bg-gray-50 dark:bg-gray-800 my-8 shadow-xl shadow-gray-400 dark:shadow-gray-900 rounded group text-center" lazy="true">
                            <div class="relative overflow-hidden bg-gray-500 rounded-t-lg">
                                @if(!empty($team->photo_id))
                                    @php
                                        $profilBild = $team->profilBild();
                                    @endphp
                                    <a href="{{ route('frontend.team.show', $team->slug) }}">
                                        <div class="absolute w-full h-[306px] z-10 blur" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ),  url('{{ $profilBild }}') center no-repeat; background-size: auto, cover;"></div>
                                        <div class="filter-none z-20 relative w-[306px] h-[274px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ $profilBild }}') center no-repeat; background-size: 306px, auto;"></div>
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

            <div class="flex justify-end items-center mt-8">
                <span class="text-sm">Mitglieder insgesamt: {!! $teams->total() !!}</span>&nbsp;|&nbsp;
                @if($teams->count() !== $teams->total())
                    <span class="text-sm">Auf dieser Seite: {!! $teams->count() !!}</span>&nbsp;|&nbsp;
                @endif
                <span class="text-sm">Alle Seiten: {!! $teams->lastPage() !!}</span>
            </div>

            <div class="mt-4">
                {{ $teams->links() }}
            </div>
        @else
            <div class="flex justify-center items-center h-[317px]">
                <div class="text-xl">Es sind aktuell keine Fahrzeuge vorhanden.</div>
            </div>
        @endif

    </div>
</div>
