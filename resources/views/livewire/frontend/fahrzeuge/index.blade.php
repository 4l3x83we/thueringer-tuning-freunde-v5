@php use Butschster\Head\Facades\Meta; @endphp
<div>
    @php
        Meta::setPaginationLinks($fahrzeuges);
    @endphp
    <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6">

        @if(count($fahrzeuges) > 0)
            @can('write')
                <div class="flex items-center justify-end">
                    <x-custom.links.button-link  href="{{ route('frontend.fahrzeuge.create') }}">Neues Fahrzeug anlegen</x-custom.links.button-link>
                </div>
            @endcan
            <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($fahrzeuges as $fahrzeuge)
                    @if($fahrzeuge->published)
                        <div class="bg-gray-100 dark:bg-gray-900 my-4 shadow-xl shadow-gray-400 dark:shadow-gray-900 rounded group text-center" lazy="true">
                            <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}">
                                <div class="relative overflow-hidden bg-gray-500 rounded-t-lg">
                                    @if(!empty($fahrzeuge->albums->thumbnail_id))
                                        <div class="absolute w-full h-[360px] z-10 blur-sm" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ),  url('{{ $fahrzeuge->fahrzeugBildMeta() }}') center no-repeat; background-size: auto, cover;"></div>
                                        <div class="filter-none z-20 relative w-[306px] h-[306px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ $fahrzeuge->fahrzeugBildMeta() }}') center no-repeat; background-size: auto, 306px;"></div>
                                    @else
                                        <div class="absolute w-full h-[360px] z-10 blur" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ),  url('{{ asset('images/logo.svg') }}') center no-repeat; background-size: auto, cover;"></div>
                                        <div class="filter-none z-20 relative w-[306px] h-[306px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ asset('images/logo.svg') }}') center no-repeat; background-size: auto, 306px;"></div>
                                    @endif
                                </div>
                            </a>
                            <div class="px-3.5 py-6">
                                <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}" class="hover:text-gray-500 hover:dark:text-white">
                                    <h4 class="text-lg font-bold mb-1.5">{{ $fahrzeuge->fahrzeug }}</h4>
                                    <span class="block text-xs text-gray-500">gefahren von: {{ $fahrzeuge->teams->vorname }}</span>
                                    <p class="italic h-24">{!! strip_tags(Str::limit(html_entity_decode($fahrzeuge->description), 120)) !!}</p>
                                </a>
                                <div class="flex flex-col justify-center gap-2">
                                    <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                        </svg>
                                        zum Fahrzeug
                                    </a>
                                    @can('edit')
                                        @hasanyrole('super_admin|admin')
                                        @if(auth()->user()->id !== $fahrzeuge->user_id)
                                            <a href="{{ route('frontend.fahrzeuge.edit', $fahrzeuge->slug) }}" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                </svg>
                                                Fahrzeug bearbeiten
                                            </a>
                                        @endif
                                        @endhasanyrole
                                        @if(auth()->user()->id === $fahrzeuge->user_id)
                                            <a href="{{ route('frontend.fahrzeuge.edit', $fahrzeuge->slug) }}" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                </svg>
                                                Fahrzeug bearbeiten
                                            </a>
                                        @endif
                                    @endcan
                                    @hasanyrole('super_admin|admin')
                                    <x-custom.button.button-blank wire:click="unpublished('{{ $fahrzeuge->slug }}')" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-eye-slash h-4 w-4 fill-red-700" viewBox="0 0 16 16">
                                            <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                            <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                        </svg>
                                        Zurückziehen
                                    </x-custom.button.button-blank>
                                        {{--                                    <livewire:frontend.fahrzeuge.destroy :fahrzeuge="$fahrzeuge" :user-i-d="$fahrzeuge->user_id" is-link=""/>--}}
                                        <x-custom.delete.sweetAlert />
                                        @if(auth()->id() === $fahrzeuge->user_id)
                                            <x-custom.delete.delete-button-blank delete-i-d="{{ $fahrzeuge->slug }}" />
                                        @else
                                            <x-custom.delete.delete-button-blank delete-i-d="{{ $fahrzeuge->slug }}" color="red-2" />
                                        @endif
                                    @endhasanyrole
                                </div>
                            </div>
                        </div>
                    @else
                        @hasanyrole('super_admin|admin')
                            <div class="bg-gray-100 dark:bg-gray-900 my-8 shadow-xl shadow-gray-400 dark:shadow-gray-900 rounded group text-center" lazy="true">
                                <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}">
                                    <div class="relative overflow-hidden bg-gray-500 rounded-t-lg">
                                        @if(!empty($fahrzeuge->albums->thumbnail_id))
                                            <div class="absolute w-full h-[360px] z-10 blur-sm" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ),  url('{{ $fahrzeuge->fahrzeugBildMeta() }}') center no-repeat; background-size: auto, cover;"></div>
                                            <div class="filter-none z-20 relative w-[306px] h-[306px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ $fahrzeuge->fahrzeugBildMeta() }}') center no-repeat; background-size: auto, 306px;"></div>
                                        @else
                                            <div class="absolute w-full h-[360px] z-10 blur" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ),  url('{{ asset('images/logo.svg') }}') center no-repeat; background-size: auto, cover;"></div>
                                            <div class="filter-none z-20 relative w-[306px] h-[306px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ asset('images/logo.svg') }}') center no-repeat; background-size: auto, 306px;"></div>
                                        @endif
                                    </div>
                                </a>
                                <div class="px-3.5 py-6">
                                    <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}" class="hover:text-gray-500 hover:dark:text-white">
                                        <h4 class="text-lg font-bold mb-1.5">{{ $fahrzeuge->fahrzeug }}</h4>
                                        <span class="block text-xs text-gray-500">gefahren von: {{ $fahrzeuge->teams->vorname ?? null }}</span>
                                        <p class="italic h-24">{!! strip_tags(Str::limit(html_entity_decode($fahrzeuge->description), 120)) !!}</p>
                                    </a>
                                    <div class="flex flex-col justify-center">
                                        <x-custom.button.button-blank wire:click="published('{{ $fahrzeuge->slug }}')" class="hover:text-primary-500 transition-colors duration-300 my-0.5 inline-flex justify-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check2-circle h-4 w-4 fill-green-500" viewBox="0 0 16 16">
                                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                            </svg>
                                            Freigeben
                                        </x-custom.button.button-blank>
                                    </div>
                                </div>
                            </div>
                        @endhasanyrole
                    @endif
                @endforeach
            </div>

            <div class="flex justify-end items-center mt-8">
                <span class="text-sm">Fahrzeuge insgesamt: {!! $fahrzeuges->total() !!}</span>&nbsp;|&nbsp;
                @if($fahrzeuges->count() !== $fahrzeuges->total())
                    <span class="text-sm">Auf dieser Seite: {!! $fahrzeuges->count() !!}</span>&nbsp;|&nbsp;
                @endif
                <span class="text-sm">Alle Seiten: {!! $fahrzeuges->lastPage() !!}</span>
            </div>

            <div class="mt-4">
                {{ $fahrzeuges->links() }}
            </div>
        @else
            <div class="flex justify-center items-center h-[317px]">
                <div class="text-xl">Es sind aktuell keine Fahrzeuge vorhanden.</div>
            </div>
        @endif
    </div>
</div>
