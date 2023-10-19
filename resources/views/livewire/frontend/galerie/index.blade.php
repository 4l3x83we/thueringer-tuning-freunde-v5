<div>
    <x-meta.title title="Galerie" />
    <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6">

        @can('write')
            <div class="flex items-center justify-end gap-4 pb-4">
                <x-custom.links.button-link href="{{ route('frontend.galerie.album.create') }}">Neues Album anlegen</x-custom.links.button-link>
            </div>
        @endcan

        @if(count($alben) > 0)
            <!-- Filter -->
            <div class="flex items-center justify-center py-4 flex-wrap gap-4">
                <x-custom.button.button id="all" class="filter-btn filter-active !shadow-none">Alle</x-custom.button.button>
                @foreach($alben->kategorie as $kategorie)
                    <x-custom.button.button class="filter-btn filter-inactive !shadow-none" id="filter-{{ $kategorie->kategorie }}">{{ replaceBlankMinus($kategorie->kategorie) }}</x-custom.button.button>
                @endforeach
            </div>
            <!-- end Filter -->

            <!-- Gallery -->
            <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4" id="galerie-container">

                    @foreach($alben as $album)
                        @php
                            if (!$album->kategorie === 'Fahrzeuge') {
                                $route = route('frontend.fahrzeuge.show', $album->slug);
                            } else {
                                $route = route('frontend.galerie.show', $album->slug);
                            }
                            $image = $album->thumbnail();
                        @endphp
                        <!-- Album -->
                        <div class="relative h-[426px] overflow-hidden galerie-item filter-{{ $album->kategorie }}">
                            <a href="{{ $route }}" title="Galerie anzeigen: {{ $album->title }}">
                                <div class="galerie-wrap shadow-xl rounded group">
                                    <div class="bg-gray-100/60 dark:bg-gray-900/60 overflow-hidden relative h-[306px] rounded-t m-0">
                                        @if($album->thumbnail_id)
                                            <div class="absolute w-full h-full z-10 blur-sm" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ), url('{{ $image }}') center no-repeat; background-size: auto, cover;"></div>
                                            <div class="filter-none z-20 relative w-[306px] h-[274px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ $image }}') center no-repeat; background-size: auto, 306px;"></div>
                                        @else
                                            <div class="absolute w-full h-full z-10 blur-sm" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ), url('{{ asset('images/logo.svg') }}') center no-repeat; background-size: auto, cover;"></div>
                                            <div class="filter-none z-20 relative w-[306px] h-[274px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ asset('images/logo.svg') }}') center no-repeat; background-size: auto, 306px;"></div>
                                        @endif
                                    </div>
                                    <div class="bg-gray-100/60 dark:bg-gray-900/60 overflow-hidden h-[90px] rounded-b-lg p-4 text-center">
                                        <h4 class="text-xl leading-none font-bold pb-0 h-11 group-hover:text-primary-500">{!! strip_tags(Str::limit($album->title, 30)) !!}</h4>
                                        <p class="p-0 m-0 text-gray-500/75 dark:text-white/75 font-medium text-sm">{!! strip_tags(Str::limit($album->description, 30)) !!}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- end Album -->
                    @endforeach

                </div>
            <!-- end Gallery -->

            {!! $alben->appends(Request::all())->render() !!}
            <div class="flex justify-end items-center mt-8">
                <span class="text-sm">Alben insgesamt: {!! $alben->total() !!}</span>
                @if($alben->count() > 21)
                    &nbsp;|&nbsp;<span class="text-sm">Auf dieser Seite: {!! $alben->count() !!}</span>
                @endif
                @if($alben->lastPage() > 1)
                    &nbsp;|&nbsp;<span class="text-sm">Alle Seiten: {!! $alben->lastPage() !!}</span>
                @endif
            </div>

            <div class="mt-4">
                {!! $alben->links() !!}
            </div>
        @else
            <div class="grid gap-4 grid-cols-1">
                <div class="h-[317px]">
                    <div class="flex justify-center items-center my-auto h-full font-bold text-2xl">Es sind noch keine
                        Alben vorhanden.
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
