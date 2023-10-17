@php use Butschster\Head\Facades\Meta;use Carbon\Carbon; @endphp
<div>
    <div class="max-w-screen-2xl px-4 py-8 mx-auto mt-[63px] md:mt-0 lg:py-10 lg:px-6">

        <div class="profile-page">
            <div class="bg-gray-100 dark:bg-gray-900 rounded shadow-xl p-4">
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="grid grid-cols-3 text-center order-last md:order-first mt-6 md:mt-0">
                        <div class="col-span-3">
                            <p class="font-bold text-xl purecounter" data-purecounter-start="0" data-purecounter-end="{{ $album->photos->count() }}" data-purecounter-duration="1">
                                0</p>
                            <p class="text-gray-400">Photos</p>
                        </div>
                    </div>
                    <div class="relative"></div>
                    <div class="gap-4 flex flex-wrap justify-between mt-0 md:justify-end">
                        @can('edit')
                            <div>
                                @hasanyrole('super_admin|admin')
                                @if(auth()->user()->id !== $team->user_id)
                                    <x-custom.links.button-link color="blue" href="{{ route('frontend.galerie.edit', $album->slug) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil h-4 w-4" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </x-custom.links.button-link>
                                @endif
                                @endhasanyrole
                                @if(auth()->user()->id === $team->user_id)
                                    <x-custom.links.button-link color="blue" href="{{ route('frontend.galerie.edit', $album->slug) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen h-4 w-4" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </x-custom.links.button-link>
                                @endif
                            </div>
                        @endcan
                        <div>
                            @hasanyrole('super_admin|admin|member|silent_member')
                                <x-custom.delete.sweetAlert />
                                @if(auth()->id() === $team->user_id)
                                    <x-custom.delete.delete-button delete-i-d="{{ $album->slug }}" color="red" />
                                @else
                                    <x-custom.delete.delete-button delete-i-d="{{ $album->slug }}" color="red-border" />
                                @endif
                            @endhasanyrole
                        </div>
                        <div>
                            <x-custom.links.button-link href="{{ route('frontend.galerie.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-skip-backward h-4 w-4" viewBox="0 0 16 16">
                                    <path d="M.5 3.5A.5.5 0 0 1 1 4v3.248l6.267-3.636c.52-.302 1.233.043 1.233.696v2.94l6.267-3.636c.52-.302 1.233.043 1.233.696v7.384c0 .653-.713.998-1.233.696L8.5 8.752v2.94c0 .653-.713.998-1.233.696L1 8.752V12a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm7 1.133L1.696 8 7.5 11.367V4.633zm7.5 0L9.196 8 15 11.367V4.633z"/>
                                </svg>
                            </x-custom.links.button-link>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="hidden xl:block"></div>
                    <div class="mt-9 text-center md:col-span-2 lg:col-span-2 xl:col-span-1">
                        <h1 class="text-4xl font-medium">{{ $album->title }}</h1>
                        {{--                        <p class="text-base opacity-75 mt-1">{!! $album->description !!}</p>--}}
                    </div>
                    <div class="md:mt-9">
                        <table class="w-full border-0 text-base">
                            <tbody>
                            <tr class="align-top">
                                <th class="text-right px-2">Kategorie:</th>
                                <td class="text-left px-2">{{ $album->kategorie }}</td>
                            </tr>
                            <tr class="align-top">
                                <th class="text-right px-2">Erstellt von:</th>
                                <td class="text-left px-2">{{ $team->vorname }}</td>
                            </tr>
                            <tr class="align-top">
                                <th class="text-right px-2">Erstellt am:</th>
                                <td class="text-left px-2">{{ Carbon::parse($album->created_at)->format('d.m.Y') }}</td>
                            </tr>
                            <tr class="align-top">
                                <th class="text-right px-2">Zuletzt aktualisiert:</th>
                                <td class="text-left px-2 pb-2">{{ Carbon::parse($album->updated_at)->fromNow() }}</td>
                            </tr>
                            <tr class="align-top border-t border-primary-500">
                                <td class="text-left p-2" colspan="2"></td>
                            </tr>
                            <tr class="align-top">
                                <td class="text-left px-2" colspan="2">{!! $album->description !!}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 flex flex-col text-base border-t border-primary-500 pt-6">
                    <div class="flex flex-wrap justify-start md:items-center gap-4 mb-4">
                        <div class="inline-flex items-center gap-2">Legende:</div>
                        <div class="inline-flex items-center gap-2">
                            <x-custom.button.button color="primary" class="!p-1.5" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrows-fullscreen h-4 w-4" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
                                </svg>
                            </x-custom.button.button>
                            Vollbild
                        </div>
                        <div class="inline-flex items-center gap-2">
                            <x-custom.button.button class="!p-1.5" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-eye w-4 h-4" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </x-custom.button.button>
                            Vorschaubild
                        </div>
                        <div class="inline-flex items-center gap-2">
                            <x-custom.button.button color="red" class="!p-1.5" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3w-4 h-4" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg>
                            </x-custom.button.button>
                            Bild löschen
                        </div>
                    </div>
                    <div class="w-full mx-auto gap-4 columns-2 md:columns-4 xl:columns-6">
                        @foreach($album->photos as $photo)
                            @if($photo->published_at <= now() and $photo->published)
                                <div class="rounded bg-gray-200 dark:bg-gray-800 group mb-4">
                                    <div class="overflow-hidden text-center rounded border {{ $photo->id !== $album->thumbnail_id ? 'border-gray-300/60 dark:border-gray-700/60 bg-gray-50 dark:bg-gray-800' : 'border-green-300/60 dark:border-green-700/60 bg-green-200 dark:bg-green-800' }} mx-px relative z-10
                                    before:bg-gray-50/60 before:dark:bg-gray-800/60 before:absolute before:top-0 before:left-0 before:right-0 before:bottom-0 before:z-20 before:opacity-0 group-hover:before:opacity-100 group-hover:before:rounded">
                                        <div class="rounded overflow-hidden relative m-1">
                                            <a data-src="{{ asset($album->path.'/'.$photo->images) }}" data-fancybox>
                                                <img src="{{ asset($album->path.'/'.$photo->images_thumbnail) }}" data-src="{{ asset($album->path.'/'.$photo->images) }}" class="w-full h-auto object-cover object-center rounded duration-300 lozad group-hover:scale-110" alt="{{ $album->title }}">
                                            </a>
                                        </div>
                                        <div class="absolute z-30 left-0 right-0 top-0 bottom-0 text-center transition-all duration-300 ease-in-out flex flex-row justify-center items-center opacity-0 group-hover:opacity-100 gap-2">
                                            <x-custom.links.button-link href="{{ asset($album->path.'/'.$photo->images) }}" data-fancybox="images" color="primary" class="!p-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrows-fullscreen h-4 w-4" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
                                                </svg>
                                            </x-custom.links.button-link>
                                            @hasanyrole('member|super_admin|admin')
                                            @if(auth()->id() === $photo->user_id)
                                                @if($photo->id !== $album->thumbnail_id)
                                                    <x-custom.button.button wire:click="preview('{{ $photo->id }}')" class="!p-1.5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-eye w-4 h-4" viewBox="0 0 16 16">
                                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                        </svg>
                                                    </x-custom.button.button>
                                                    <livewire:frontend.galerie.photo.destroy :photo="$photo"/>
                                                @else
                                                    <x-custom.button.button color="green" class="!p-1.5" disabled>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-images w-4 h-4 mr-2" viewBox="0 0 16 16">
                                                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                                            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                                                        </svg>
                                                        Vorschaubild
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check2-circle w-4 h-4 ml-2" viewBox="0 0 16 16">
                                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                                        </svg>
                                                    </x-custom.button.button>
                                                @endif
                                            @endif
                                            @endhasanyrole
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-2" wire:loading wire:target="preview">
                        <div class="mt-4 text-center">
                            <div role="status">
                                <svg aria-hidden="true" class="mr-2 inline h-8 w-8 animate-spin text-gray-200 fill-primary-600 dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2" wire:loading wire:target="destroy">
                        <div class="mt-4 text-center">
                            <div role="status">
                                <svg aria-hidden="true" class="mr-2 inline h-8 w-8 animate-spin text-gray-200 fill-primary-600 dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="gap-4 border-t border-primary-500 mt-4 pt-4" id="alben">
                    <div
                        x-data="{ uploading: false, progress: 0 }"
                        x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-error="uploading = false"
                    >
                        @if($images)
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-12">
                                    <h1 class="mb-2 text-lg">Vorschau</h1>
                                </div>
                                @foreach($images as $image)
                                    @if($image->getFilename() != 'livewire-tmp')
                                        <div>
                                            <img src="{{ $image->temporaryUrl() }}" class="h-auto w-full rounded-lg">
                                        </div>
                                    @else
                                        <div>
                                            <span class="text-red-700">Irgendetwas stimmt nicht mit ihrem Bild.</span>
                                        </div>
                                    @endif
                                @endforeach
                                @error('images')
                                <span class="text-xs text-red-600 dark:text-red-500">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        @else
                            <x-custom.form.file-dropzone id="images" model="images" multiple="true" text="Weitere Bilder hinzufügen"/>
                        @endif
                        <div x-show="uploading">
                            <div class="mt-4 text-center">
                                <div role="status">
                                    <svg aria-hidden="true" class="mr-2 inline h-8 w-8 animate-spin text-gray-200 fill-primary-600 dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

