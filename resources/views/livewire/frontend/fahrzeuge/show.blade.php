@php use Butschster\Head\Facades\Meta;use Carbon\Carbon; @endphp
<div>
    <div class="max-w-screen-2xl px-4 py-8 mx-auto mt-[63px] md:mt-0 lg:py-10 lg:px-6">

        <div class="profile-page">
            <div class="px-4 pb-4 mt-0 md:mt-12">
                <div class="flex justify-between items-center">
                    <div>
                        @if(isset($previous))
                            @php
                                Meta::setPrevHref(route('frontend.fahrzeuge.show', $previous->slug));
                            @endphp
                            <x-custom.links.a-blank href="{{ route('frontend.fahrzeuge.show', $previous->slug) }}" title="{{ ucfirst($previous->slug) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left h-4 w-4" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                </svg>
                            </x-custom.links.a-blank>
                        @endif
                    </div>
                    <div>
                        @if(isset($next))
                            @php
                                Meta::setNextHref(route('frontend.fahrzeuge.show', $next->slug));
                            @endphp
                            <x-custom.links.a-blank href="{{ route('frontend.fahrzeuge.show', $next->slug) }}" title="{{ ucfirst($next->slug) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-right h-4 w-4" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </x-custom.links.a-blank>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-gray-900 rounded shadow-xl p-4">
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="grid grid-cols-3 text-center order-last md:order-first mt-6 md:mt-0">
                        {{--<div>
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
                        </div>--}}
                        <div class="col-span-3">
                            <p class="font-bold text-xl purecounter" data-purecounter-start="0" data-purecounter-end="{{ $photos->count() }}" data-purecounter-duration="1">
                                0</p>
                            <p class="text-gray-400">Photos</p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="w-32 h-32 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-20 flex items-center justify-center bg-gray-200 dark:bg-gray-600">
                            @if($fahrzeuge->fahrzeugBild($team->id))
                                <img src="{{ $fahrzeuge->fahrzeugBild() }}" alt="{{ $fahrzeuge->teams->vorname }}" class="w-32 h-32 object-cover object-center rounded-full">
                            @else
                                <div class="relative inline-flex items-center justify-center w-32 h-32 overflow-hidden bg-gray-200 rounded-full dark:bg-gray-700">
                                    <span class="font-medium text-gray-600 dark:text-gray-300 text-6xl">{{ teamInitial($team) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="space-x-4 flex justify-between mt-16 md:mt-0 md:justify-end items-center">
                        @can('edit')
                            <div>
                                @hasanyrole('super_admin|admin')
                                @if(auth()->user()->id !== $team->user_id)
                                    <x-custom.links.button-link color="blue" href="{{ route('frontend.fahrzeuge.edit', $fahrzeuge->slug) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil h-4 w-4" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </x-custom.links.button-link>
                                @endif
                                @endhasanyrole
                                @if(auth()->user()->id === $team->user_id)
                                    <x-custom.links.button-link color="blue" href="{{ route('frontend.fahrzeuge.edit', $fahrzeuge->slug) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen h-4 w-4" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                        </svg>
                                    </x-custom.links.button-link>
                                @endif
                            </div>
                        @endcan
                            @hasanyrole('super_admin|admin|member|silent_member')
                                <x-custom.delete.sweetAlert />
                                @if(auth()->id() === $team->user_id)
                                    <x-custom.delete.delete-button delete-i-d="{{ $fahrzeuge->slug }}" color="red" />
                                @else
                                    <x-custom.delete.delete-button delete-i-d="{{ $fahrzeuge->slug }}" color="red-border" />
                                @endif
                            @endhasanyrole
                        <div>
                            <x-custom.links.button-link href="{{ route('frontend.fahrzeuge.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-skip-backward h-4 w-4" viewBox="0 0 16 16">
                                    <path d="M.5 3.5A.5.5 0 0 1 1 4v3.248l6.267-3.636c.52-.302 1.233.043 1.233.696v2.94l6.267-3.636c.52-.302 1.233.043 1.233.696v7.384c0 .653-.713.998-1.233.696L8.5 8.752v2.94c0 .653-.713.998-1.233.696L1 8.752V12a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm7 1.133L1.696 8 7.5 11.367V4.633zm7.5 0L9.196 8 15 11.367V4.633z"/>
                                </svg>
                            </x-custom.links.button-link>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div></div>
                    <div class="md:mt-9 text-center">
                        <h1 class="text-4xl font-medium">{{ $fahrzeuge->fahrzeug }}</h1>
                        <p class="text-base opacity-75 mt-1"><a href="{{ route('frontend.team.show', $team->slug) }}">Fahrer: {{ ucfirst($team->vorname) }}</a>
                        </p>
                    </div>
                    <div class="md:mt-9">
                        <table class="w-full border-0 text-base">
                            <tbody>
                            <tr class="align-top">
                                <th class="text-right px-2">Fahrzeug:</th>
                                <td class="text-left px-2">{!! $fahrzeuge->fahrzeug !!}</td>
                            </tr>
                            <tr class="align-top">
                                <th class="text-right px-2">Baujahr:</th>
                                <td class="text-left px-2">{!! $fahrzeuge->baujahr() !!}</td>
                            </tr>
                            <tr class="align-top">
                                <th class="text-right px-2">Besonderheiten:</th>
                                <td class="text-left px-2">{!! $fahrzeuge->besonderheiten !!}</td>
                            </tr>
                            <tr class="align-top">
                                <th class="text-right px-2">Motor:</th>
                                <td class="text-left px-2">{!! $fahrzeuge->motor !!}</td>
                            </tr>
                            <tr class="align-top">
                                <th class="text-right px-2">Letzte Änderungen:</th>
                                <td class="text-left px-2">{{ Carbon::parse($fahrzeuge->updated_at)->fromNow() }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 flex flex-col text-base border-t border-primary-500 pt-6">
                    <table class="w-full border-0 text-base text-left">
                        <tbody>
                        <tr class="align-top">
                            <th class="bg-gray-200 dark:bg-gray-800 p-2 w-1/2">Karosserie:</th>
                            <th class="bg-gray-200 dark:bg-gray-800 p-2 w-1/2">Bremsen:</th>
                        </tr>
                        <tr class="align-top">
                            <td class="p-2 w-1/2">{!! nl2br($fahrzeuge->karosserie) !!}</td>
                            <td class="p-2 w-1/2">{!! nl2br($fahrzeuge->bremsen) !!}</td>
                        </tr>
                        <tr class="align-top">
                            <th class="bg-gray-200 dark:bg-gray-800 p-2 w-1/2">Fahrwerk:</th>
                            <th class="bg-gray-200 dark:bg-gray-800 p-2 w-1/2">Innenraum:</th>
                        </tr>
                        <tr class="align-top">
                            <td class="p-2 w-1/2">{!! nl2br($fahrzeuge->fahrwerk) !!}</td>
                            <td class="p-2 w-1/2">{!! nl2br($fahrzeuge->innenraum) !!}</td>
                        </tr>
                        <tr class="align-top">
                            <th class="bg-gray-200 dark:bg-gray-800 p-2 w-1/2">Felgen:</th>
                            <th class="bg-gray-200 dark:bg-gray-800 p-2 w-1/2">Anlage:</th>
                        </tr>
                        <tr class="align-top">
                            <td class="p-2 w-1/2">{!! nl2br($fahrzeuge->felgen) !!}</td>
                            <td class="p-2 w-1/2">{!! nl2br($fahrzeuge->anlage) !!}</td>
                        </tr>
                        <tr class="align-top">
                            <th class="bg-gray-200 dark:bg-gray-800 p-2" colspan="2">Beschreibung:</th>
                        </tr>
                        <tr class="align-top">
                            <td class="p-2" colspan="2">
                                <div class="profilText">{!! html_entity_decode($fahrzeuge->description) !!}</div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                @if(count($photos) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-8 gap-4 border-t border-primary-500 mt-4 pt-4" id="alben">
                        <div class="col-span-2 md:col-span-4 xl:col-span-8">
                            <h4 class="text-2xl">Galerie</h4>
                        </div>
                        @foreach($photos as $photo)
                            <a data-src="{{ asset($photo->albums->path.'/'.$photo->images) }}" data-fancybox="images" data-caption="{{ $photo->albums->title }}">
                                <div class="relative overflow-hidden bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 shadow-xl group">
                                    <div class="w-full p-1 relative overflow-hidden">
                                        <img src="{{ asset('images/logo.svg') }}" data-src="{{ asset($photo->albums->path.'/'.$photo->images_thumbnail) }}" class="h-[150px] w-full rounded group-hover:scale-110 overflow-hidden object-cover object-center duration-400 lozad" alt="{{ $photo->albums->title }}">
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
