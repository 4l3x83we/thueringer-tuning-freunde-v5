@php use App\Models\Frontend\Alben\Photos;use Carbon\Carbon; @endphp
<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            <!-- Left -->
            <div class="col-span-full lg:col-auto gap-4">
                <div class="grid grid-cols-1 gap-4">
                    <!-- Profilbild -->
                    <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900">
                        <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                            @if($team->photo_id)
                                <img class="rounded w-28 h-28 object-scale-down object-center lozad" src="{{ asset('images/logo.svg') }}" data-src="{{ asset($team->path.'/'.Photos::where('id', $team->photo_id)->first()->images) }}" alt="">
                            @else
                                <div class="relative inline-flex items-center justify-center w-28 h-28 overflow-hidden drop-shadow-xl bg-gray-100 rounded dark:bg-gray-800">
                                    <span class="font-medium text-gray-600 dark:text-gray-300 text-7xl">{{ teamInitial($team) }}</span>
                                </div>
                            @endif
                            <div>
                                <h3 class="mb-1 mt-2 sm:mt-0 text-xl font-bold">Profilbild</h3>
                                <div class="mb-4 text-xs text-gray-500 dark:text-gray-400">
                                    JPG, GIF, WEBP oder PNG. Maximale Größe von 5,12 GB
                                </div>
                                <div class="w-full">
                                    <div x-data="{uploadPicture: false}">
                                        <template x-if="!uploadPicture">
                                            <div class="flex items-center gap-2">
                                                @can('edit')
                                                    <x-custom.button.button @click="uploadPicture = !uploadPicture">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-upload w-4 h-4 mr-2 -ml-1" viewBox="0 0 16 16">
                                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                        </svg>
                                                        Profilbild ändern
                                                    </x-custom.button.button>
                                                @endcan
                                                @can('destroy')
                                                    <x-custom.button.button-trash wire:click="$dispatch('triggerDelete','{{ $team->slug }}')">
                                                        Profilbild löschen
                                                    </x-custom.button.button-trash>
                                                    <x-custom.delete.script id="triggerDelete" function="destroy"/>
                                                @endcan
                                            </div>
                                        </template>
                                        <template x-if="uploadPicture">
                                            <div>
                                                <x-custom.form.file id="image" wire:model="image" wire:loading.remove/>
                                                <div wire:loading wire:target="image">
                                                    <div class="text-center mt-4">
                                                        <div role="status">
                                                            <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-primary-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                            </svg>
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Profilbild -->
                    @if($team->fahrzeug_vorhanden)
                        <!-- Fahrzeuge -->
                        <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col">
                            <h3 class="mb-1 text-xl font-bold">Deine Fahrzeuge</h3>
                            <x-custom.table.responsive.table>
                                <x-custom.table.responsive.thead>
                                    <tr>
                                        <x-custom.table.responsive.th text="#"/>
                                        <x-custom.table.responsive.th text="Fahrzeug"/>
                                        <x-custom.table.responsive.th class="w-16" style="max-width: 64px;" text=""/>
                                    </tr>
                                </x-custom.table.responsive.thead>
                                <x-custom.table.responsive.tbody>
                                    @foreach($team->fahrzeuges as $fahrzeug)
                                        <x-custom.table.responsive.tr>
                                            <x-custom.table.responsive.td class="!p-2 font-medium {{ $fahrzeug->published ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top" wire:click="showFahrzeug('{{ $fahrzeug->slug }}')" :text="$fahrzeug->id"/>
                                            <x-custom.table.responsive.td class="!p-2 font-medium {{ $fahrzeug->published ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top" wire:click="showFahrzeug('{{ $fahrzeug->slug }}')" :text="$fahrzeug->fahrzeug"/>
                                            <x-custom.table.responsive.td class="!p-2 font-medium {{ $fahrzeug->published ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top text-center">
                                                <div class="flex justify-end items-center gap-4">
                                                    @can('edit')
                                                        <x-custom.button.button-blank :href="route('frontend.fahrzeuge.edit', $fahrzeug->slug)" color="blue">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen w-4 h-4" viewBox="0 0 16 16">
                                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                            </svg>
                                                        </x-custom.button.button-blank>
                                                    @endcan
                                                    @can('destroy')
                                                        <x-custom.button.button-blank wire:click="$dispatch('triggerDeleteFahrzeuge','{{ $fahrzeug->slug }}')" color="red">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3 w-4 h-4" viewBox="0 0 16 16">
                                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                            </svg>
                                                        </x-custom.button.button-blank>
                                                    @endcan
                                                </div>
                                            </x-custom.table.responsive.td>
                                        </x-custom.table.responsive.tr>
                                    @endforeach
                                </x-custom.table.responsive.tbody>
                            </x-custom.table.responsive.table>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
                                @foreach($team->fahrzeuges as $fahrzeug)
                                    <div class="bg-gray-50 dark:bg-gray-800 rounded shadow-xl p-2 space-y-3">
                                        <div class="flex justify-between items-center space-x-2 text-sm">
                                            <a class="flex items-center space-x-2 text-sm cursor-pointer" href="{{ route('frontend.fahrzeuge.show', $fahrzeug->slug) }}">
                                                <div>{{ $fahrzeug->id }}</div>
                                                <div class="{{ $fahrzeug->published ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }}">{{ $fahrzeug->fahrzeug }}</div>
                                            </a>
                                            <div class="flex justify-end items-center gap-4">
                                                @can('edit')
                                                    <x-custom.button.button-blank :href="route('frontend.fahrzeuge.edit', $fahrzeug->slug)" color="blue">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen w-4 h-4" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                        </svg>
                                                    </x-custom.button.button-blank>
                                                @endcan
                                                @can('destroy')
                                                    <x-custom.button.button-blank wire:click="$dispatch('triggerDeleteFahrzeuge','{{ $fahrzeug->slug }}')" color="red">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3 w-4 h-4" viewBox="0 0 16 16">
                                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                        </svg>
                                                    </x-custom.button.button-blank>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <x-custom.delete.script id="triggerDeleteFahrzeuge" function="destroyFahrzeug"/>
                        </div>
                        <!-- end Fahrzeuge -->
                    @endif
                    @if(!$team->albums->isEmpty())
                        <!-- Fahrzeuge -->
                        <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col">
                            <h3 class="mb-1 text-xl font-bold">Deine Alben</h3>
                            <x-custom.table.responsive.table>
                                <x-custom.table.responsive.thead>
                                    <tr>
                                        <x-custom.table.responsive.th text="#"/>
                                        <x-custom.table.responsive.th text="Album"/>
                                        <x-custom.table.responsive.th class="w-20 text-center" text="Photos"/>
                                        <x-custom.table.responsive.th class="w-16" style="max-width: 64px;" text=""/>
                                    </tr>
                                </x-custom.table.responsive.thead>
                                <x-custom.table.responsive.tbody>
                                    @foreach($team->albums as $album)
                                        <x-custom.table.responsive.tr>
                                            <x-custom.table.responsive.td class="!p-2 font-medium {{ $album->published ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top" wire:click="showGalerie('{{ $album->slug }}')" :text="$album->id"/>
                                            <x-custom.table.responsive.td class="!p-2 font-medium {{ $album->published ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top" wire:click="showGalerie('{{ $album->slug }}')" :text="$album->title"/>
                                            <x-custom.table.responsive.td class="!p-2 font-medium {{ $album->published ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top text-center" wire:click="showGalerie('{{ $album->slug }}')" :text="$album->photos->count()"/>
                                            <x-custom.table.responsive.td class="!p-2 font-medium {{ $album->published ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top text-center">
                                                <div class="flex justify-end items-center gap-4">
                                                    @can('edit')
                                                        <x-custom.button.button-blank :href="route('frontend.galerie.edit', $album->slug)" color="blue">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen w-4 h-4" viewBox="0 0 16 16">
                                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                            </svg>
                                                        </x-custom.button.button-blank>
                                                    @endcan
                                                    @can('destroy')
                                                        <x-custom.button.button-blank wire:click="$dispatch('triggerDeleteGalerie','{{ $album->slug }}')" color="red">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3 w-4 h-4" viewBox="0 0 16 16">
                                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                            </svg>
                                                        </x-custom.button.button-blank>
                                                    @endcan
                                                </div>
                                            </x-custom.table.responsive.td>
                                        </x-custom.table.responsive.tr>
                                    @endforeach
                                </x-custom.table.responsive.tbody>
                            </x-custom.table.responsive.table>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
                                @foreach($team->albums as $album)
                                    <div class="bg-gray-50 dark:bg-gray-800 rounded shadow-xl p-2 space-y-3">
                                        <div class="flex justify-between items-center space-x-2 text-sm">
                                            <a class="flex items-center space-x-2 text-sm cursor-pointer {{ $album->published ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }}" href="{{ route('frontend.galerie.show', $album->slug) }}">
                                                <div>{{ $album->id }}</div>
                                                <div class="{{ $album->published ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }}">{{ $album->title }}</div>
                                                <div class="w-20 text-center">( {{ $album->photos->count() }} )</div>
                                            </a>
                                            <div class="flex justify-end items-center gap-4">
                                                @can('edit')
                                                    <x-custom.button.button-blank :href="route('frontend.galerie.edit', $album->slug)" color="blue">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen w-4 h-4" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                        </svg>
                                                    </x-custom.button.button-blank>
                                                @endcan
                                                @can('destroy')
                                                    <x-custom.button.button-blank wire:click="$dispatch('triggerDeleteGalerie','{{ $album->slug }}')" color="red">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3 w-4 h-4" viewBox="0 0 16 16">
                                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                        </svg>
                                                    </x-custom.button.button-blank>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <x-custom.delete.script id="triggerDeleteGalerie" function="destroyGalerie"/>
                        </div>
                        <!-- end Fahrzeuge -->
                    @endif

                    @if($team->user_id === auth()->id())
                        <!-- Zahlungen -->
                        <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col">
                            <div class="flex justify-between items-center gap-4 mb-2">
                                <h3 class="mb-1 text-xl font-bold">Zahlungen</h3>
                                <div class="flex flex-wrap justify-end items-center gap-2">
                                    @if($payments->gesamtOverdue !== '0,00 €')
                                        <div class="font-bold text-red-500 dark:text-red-700">Überfällig: <span>{{ $payments->gesamtOverdue }}</span></div>
                                    @endif
                                    @if($payments->gesamtOpen !== '0,00 €')
                                        <div class="font-bold text-red-500 dark:text-red-700">Offen: <span>{{ $payments->gesamtOpen }}</span></div>
                                    @endif
                                    <div class="font-bold text-success-500 dark:text-success-700">Bezahlt: <span>{{ $payments->gesamt }}</span></div>
                                </div>
                            </div>
                            <x-custom.table.responsive.table>
                                <x-custom.table.responsive.thead>
                                    <tr>
                                        <x-custom.table.responsive.th text="Monat"/>
                                        <x-custom.table.responsive.th text="Betrag"/>
                                        <x-custom.table.responsive.th text="Bezahlt am"/>
                                    </tr>
                                </x-custom.table.responsive.thead>
                                <x-custom.table.responsive.tbody>
                                    @foreach($payments as $payment)
                                        <x-custom.table.responsive.tr>
                                            <x-custom.table.responsive.td class="!p-2 font-medium {{ $payment->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} !whitespace-normal" text="{{ Carbon::parse($payment->payment_for_month)->isoFormat('MMMM') }}"/>
                                            <x-custom.table.responsive.td class="!p-2 font-medium {{ $payment->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} !whitespace-normal" :text="number_format($payment->betrag, 2, ',', '.').' €'"/>
                                            <x-custom.table.responsive.td class="!p-2 font-medium {{ $payment->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} !whitespace-normal" text="{{ $payment->date_of_payment ? Carbon::parse($payment->date_of_payment)->isoFormat('DD.MM.YY') : null  }}"/>
                                        </x-custom.table.responsive.tr>
                                    @endforeach
                                </x-custom.table.responsive.tbody>
                            </x-custom.table.responsive.table>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
                                @foreach($payments as $payment)
                                    <div class="bg-gray-50 dark:bg-gray-800 rounded shadow-xl p-2 space-y-3">
                                        <div class="flex flex-col text-sm">
                                            <div class="flex items-center gap-4 {{ $payment->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }}">
                                                <div class="w-1/3">Monat</div>
                                                <div class="w-2/3">{{ Carbon::parse($payment->payment_for_month)->isoFormat('MMMM') }}</div>
                                            </div>
                                            <div class="flex items-center gap-4 {{ $payment->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }}">
                                                <div class="w-1/3">Betrag</div>
                                                <div class="w-2/3">{{ number_format($payment->betrag, 2, ',', '.').' €' }}</div>
                                            </div>
                                            <div class="flex items-center gap-4 {{ $payment->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }}">
                                                <div class="w-1/3">Bezahlt am</div>
                                                <div class="w-2/3">{{ $payment->date_of_payment ? Carbon::parse($payment->date_of_payment)->isoFormat('DD.MM.YY') : null }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- end Zahlungen -->
                    @endif

                    @if($team->user_id === auth()->id())
                        <!-- Passwort -->
                        <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col">
                            <h3 class="mb-1 text-xl font-bold">Passwort ändern</h3>
                            <form wire:submit.prevent="changePassword">
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <x-custom.form.label-input id="password.current_password" wire:model="password.current_password" text="Aktuelles Passwort"/>
                                    </div>
                                    <div>
                                        <x-custom.form.label-input id="password.password" wire:model="password.password" text="Neues Passwort"/>
                                    </div>
                                    <div>
                                        <x-custom.form.label-input id="password.password_confirmation" wire:model="password.password_confirmation" text="Bestätige das neue Passwort"/>
                                    </div>
                                    <div class="flex justify-end items-center">
                                        <x-custom.button.loading-button target="changePassword"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end Passwort -->
                    @endif

                    @hasanyrole('super_admin|admin')
                    <!-- Rollen -->
                    <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col">
                        <h3 class="mb-1 text-xl font-bold">Rollen</h3>
                        <form wire:submit.prevent="userRoles">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    @foreach($roles as $role)
                                        <div class="flex items-center mb-2">
                                            <x-custom.form.input-checkbox id="role-{{ $role->name }}" wire:model.live="roleCheck" value="{{ $role->name }}" :text="__($role->name)"/>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex justify-end items-center">
                                    <x-custom.button.loading-button target="userRoles"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end Rollen -->
                    @endhasanyrole
                </div>
            </div>
            <!-- end Left -->

            <!-- Right -->
            <div class="col-span-full lg:col-span-2 gap-4">
                <div class="grid grid-cols-1 gap-4">
                    <!-- Team Einstellungen -->
                    <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col">
                        <form wire:submit.prevent="edit">
                            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2" wire:loading.class="opacity-50">
                                <div class="h-full">
                                    <h1 class="mb-2 text-2xl">Anschrift</h1>
                                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                                        <div class="col-span-1 lg:col-span-2">
                                            <x-custom.form.select-label id="form.anrede" wire:model="form.anrede" text="Anrede" stern="true">
                                                <option value="">-- bitte auswählen --</option>
                                                @foreach($anrede as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </x-custom.form.select-label>
                                        </div>
                                        <div>
                                            <x-custom.form.label-input id="form.vorname" wire:model="form.vorname" text="Vorname" stern="true"/>
                                        </div>
                                        <div>
                                            <x-custom.form.label-input id="form.nachname" wire:model="form.nachname" text="Nachname" stern="true"/>
                                        </div>
                                        <div>
                                            <x-custom.form.label-input id="form.strasse" wire:model="form.strasse" text="Strasse" stern="true"/>
                                        </div>
                                        <div>
                                            <div class="flex gap-4">
                                                <div class="w-1/3">
                                                    <x-custom.form.label-input id="form.plz" wire:model="form.plz" type="number" text="PLZ" stern="true"/>
                                                </div>
                                                <div class="w-2/3">
                                                    <x-custom.form.label-input id="form.wohnort" wire:model="form.wohnort" text="Wohnort" stern="true"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-full">
                                    <h1 class="mb-2 text-2xl">Kontaktdaten</h1>
                                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                                        <div>
                                            <x-custom.form.label-input id="form.telefon" wire:model="form.telefon" type="tel" text="Telefon"/>
                                        </div>
                                        <div>
                                            <x-custom.form.label-input id="form.mobilfunk" wire:model="form.mobil" type="tel" text="Mobilfunk" stern="true"/>
                                        </div>
                                        <div>
                                            <x-custom.form.label-input id="form.email" wire:model="form.email" type="email" text="E-Mail Adresse" stern="true"/>
                                        </div>
                                        <div>
                                            <x-custom.form.label-with-icon id="form.facebook">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-3 w-3 bi bi-facebook" viewBox="0 0 16 16">
                                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                                </svg>
                                                Facebook
                                                <div data-tooltip-target="tiktokTooltip" data-tooltip-placement="bottom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-3 w-3 fill-red-700 bi bi-info-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                    </svg>
                                                    <div id="tiktokTooltip" role="tooltip" class="invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm tooltip dark:bg-gray-800">
                                                        https://www.facebook.com/<span class="text-red-700">Nur das eintragen</span>
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                </div>
                                            </x-custom.form.label-with-icon>
                                            <x-custom.form.input id="form.facebook" wire:model="form.facebook" text="nur dein Facebook Name eintragen"/>
                                        </div>
                                        <div>
                                            <x-custom.form.label-with-icon id="form.tiktok">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-3 w-3 bi bi-tiktok" viewBox="0 0 16 16">
                                                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
                                                </svg>
                                                TikTok
                                                <div data-tooltip-target="tiktokTooltip" data-tooltip-placement="bottom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-3 w-3 fill-red-700 bi bi-info-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                    </svg>
                                                    <div id="tiktokTooltip" role="tooltip" class="invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm tooltip dark:bg-gray-800">
                                                        https://www.tiktok.com/@<span class="text-red-700">Nur das eintragen</span>
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                </div>
                                            </x-custom.form.label-with-icon>
                                            <x-custom.form.input id="form.tiktok" wire:model="form.tiktok" text="nur dein TikTok Name eintragen ohne @"/>
                                        </div>
                                        <div>
                                            <x-custom.form.label-with-icon id="form.instagram">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-3 w-3 bi bi-instagram" viewBox="0 0 16 16">
                                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                                </svg>
                                                Instagram
                                                <div data-tooltip-target="instagramTooltip" data-tooltip-placement="bottom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-3 w-3 fill-red-700 bi bi-info-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                    </svg>
                                                    <div id="instagramTooltip" role="tooltip" class="invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm tooltip dark:bg-gray-800">
                                                        https://www.instagram.com/<span class="text-red-700">Nur das eintragen</span>/
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                </div>
                                            </x-custom.form.label-with-icon>
                                            <x-custom.form.input id="form.instagram" wire:model="form.instagram" text="nur dein Instagram Name eintragen"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1 lg:col-span-2">
                                    <h1 class="mb-2 text-2xl">Über mich</h1>
                                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                                        <div>
                                            <x-custom.form.label-input id="form.geburtstag" wire:model="form.geburtstag" type="date" text="Geburtstag" stern="true"/>
                                        </div>
                                        <div>
                                            <x-custom.form.label-input id="form.beruf" wire:model="form.beruf" text="Beruf"/>
                                        </div>
                                        <div class="col-span-1 lg:col-span-2">
                                            <x-custom.form.label id="form.description" text="Beschreibung" stern="true"/>
                                            <x-custom.form.tiny-mce id="description" model="form.description"/>
                                            <x-custom.helpers.tinyMCEJS />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <x-custom.errors.errorMessages/>
                                <div class="my-4">
                                    Durch das Absenden dieses Formulars stimmst du unserer
                                    <a href="" class="underline underline-offset-2">Datenschutzrichtlinie</a>
                                    zu, in der erläutert wird, wie wir deine persönlichen Daten erfassen, verwenden und
                                    offenlegen dürfen,
                                    auch an Dritte.
                                </div>
                                <!-- Buttons -->
                                <div class="flex items-center justify-end gap-2 last:pr-0">
                                    <x-custom.button.loading-button target="edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="mr-2 h-4 w-4 bi bi-floppy" viewBox="0 0 16 16">
                                            <path d="M11 2H9v3h2V2Z"/>
                                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0ZM1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5Zm3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4v4.5ZM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5V15Z"/>
                                        </svg>
                                    </x-custom.button.loading-button>
                                </div>
                                <!-- end Buttons -->
                            </div>
                        </form>
                    </div>
                    <!-- end Team Einstellungen -->
                    <!-- Löschen -->
                    <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col">
                        <div class="flex flex-col items-start gap-4 mb-2">
                            <h3 class="mb-1 text-xl font-bold">Account löschen</h3>
                            <div>Sobald dein Konto gelöscht wurde, werden alle Ressourcen und Daten dauerhaft gelöscht. Laden dir vor dem Löschen deines Kontos alle Daten oder Informationen herunter, die du behalten möchtest.</div>
                            <livewire:frontend.helpers.all-delete :team="$team" text="Account Löschen"/>
                        </div>
                    </div>
                    <!-- end Löschen -->
                </div>
            </div>
            <!-- end Right -->

        </div>

    </div>
    <x-custom.delete.sweetAlert/>
</div>
