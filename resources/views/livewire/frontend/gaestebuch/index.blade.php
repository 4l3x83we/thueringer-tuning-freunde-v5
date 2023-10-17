@php use Carbon\Carbon; @endphp
<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">

        <!-- formular -->
        <div x-data="{gbFormCreate: false}">
            <div class="flex justify-end items-center mb-4">
                <x-custom.button.button @click="gbFormCreate = !gbFormCreate" color="primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-vector-pen mr-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.646.646a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1 0 .708l-1.902 1.902-.829 3.313a1.5 1.5 0 0 1-1.024 1.073L1.254 14.746 4.358 4.4A1.5 1.5 0 0 1 5.43 3.377l3.313-.828L10.646.646zm-1.8 2.908-3.173.793a.5.5 0 0 0-.358.342l-2.57 8.565 8.567-2.57a.5.5 0 0 0 .34-.357l.794-3.174-3.6-3.6z"/>
                        <path fill-rule="evenodd" d="M2.832 13.228 8 9a1 1 0 1 0-1-1l-4.228 5.168-.026.086.086-.026z"/>
                    </svg>
                    Ins Gästebuch schreiben
                </x-custom.button.button>
            </div>
            <div x-show="gbFormCreate" x-cloak>
                <form wire:submit.prevent="save" class="bg-gray-100 dark:bg-gray-900 p-4 rounded shadow border border-gray-200 dark:border-gray-700 mb-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div>
                            <x-custom.form.label-input id="form.name" wire:model="form.name" text="Name"/>
                        </div>
                        <div>
                            <x-custom.form.label-input id="form.email" type="email" wire:model="form.email" text="E-Mail Adresse"/>
                        </div>
                        <div>
                            <x-custom.form.label-input id="form.webseite" type="url" wire:model="form.webseite" text="Webseite"/>
                        </div>
                        <div>
                            <x-custom.form.label-input id="form.facebook" wire:model="form.facebook" text="Facebook"/>
                        </div>
                        <div>
                            <x-custom.form.label-input id="form.tiktok" wire:model="form.tiktok" text="TikTok"/>
                        </div>
                        <div>
                            <x-custom.form.label-input id="form.instagram" wire:model="form.instagram" text="Instagram"/>
                        </div>
                        <div class="col-span-2">
                            <x-custom.form.label for="message" text="Nachricht"/>
                            <x-custom.form.tiny-mce id="message" model="form.message"/>
                            <x-custom.helpers.tinyMCEJS />
                        </div>
                        <div class="flex items-center justify-end col-span-2">
                            <x-custom.button.button type="submit">Speichern</x-custom.button.button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end formular -->

        <!-- gaestebucheintrag -->
        @if(count($gaestebuch) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($gaestebuch as $key => $item)
{{--                @if($item->published)--}}
                    <article class="{{ $item->published ? 'bg-gray-100 dark:bg-gray-900' : 'bg-gray-100/30 dark:bg-gray-900/30' }} p-4 rounded shadow border border-gray-200 dark:border-gray-700" id="gaestebuch">
                        <footer class="flex justify-between items-center mb-2">
                            <div>
                                <span class="font-semibold text-sm">{{ $item->name }}</span>
                                <ul class="flex flex-wrap items-center text-gray-700 dark:text-gray-400 gap-4 mt-1">
                                    @if($item->email)
                                        <li class="inline-flex gap-2 items-center">
                                            <x-custom.links.a-blank href="mailto:{{ $item->email }}" target="_blank" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                                                    <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                                                    <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                                                </svg>
                                            </x-custom.links.a-blank>
                                        </li>
                                    @endif
                                    @if($item->facebook)
                                        <li class="inline-flex gap-2 items-center">
                                            <x-custom.links.a-blank href="{{ $item->facebook }}" target="_blank" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                                </svg>
                                            </x-custom.links.a-blank>
                                        </li>
                                    @endif
                                    @if($item->tiktok)
                                        <li class="inline-flex gap-2 items-center">
                                            <x-custom.links.a-blank href="{{ $item->tiktok }}" target="_blank" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                                                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
                                                </svg>
                                            </x-custom.links.a-blank>
                                        </li>
                                    @endif
                                    @if($item->instagram)
                                        <li class="inline-flex gap-2 items-center">
                                            <x-custom.links.a-blank href="{{ $item->instagram }}" target="_blank" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                                </svg>
                                            </x-custom.links.a-blank>
                                        </li>
                                    @endif
                                    @if($item->webseite)
                                        <li class="inline-flex gap-2 items-center">
                                            <x-custom.links.a-blank href="{{ $item->webseite }}" target="_blank" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                                                    <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                                </svg>
                                            </x-custom.links.a-blank>
                                        </li>
                                    @endif
                                    @if($item->published_at)
                                        <li class="inline-flex gap-2 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                                <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                                                <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                            </svg>
                                            {{ Carbon::parse($item->published_at)->fromNow() }}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                @hasanyrole('super_admin|admin')
                                    @if(!$item->published)
                                        <x-custom.button.button-blank wire:click="published('{{ $item->id }}', '1')" color="green">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check2-circle h-4 w-4 mr-2" viewBox="0 0 16 16">
                                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                            </svg>
                                        </x-custom.button.button-blank>
                                   @endif
                                    <x-custom.button.button-blank wire:click="destroy('{{ $item->id }}')" color="red-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3 h-4 w-4 mr-2" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </x-custom.button.button-blank>
                                @endhasanyrole
                            </div>
                        </footer>
                        <div class="text-gray-700 dark:text-gray-400">{!! $item->message !!}</div>
                        <div class="flex justify-between items-center mt-4 sticky top-[100vh]">
                            <div class="flex flex-wrap items-center gap-2">
                                <div>{{ '#'.($key + 1).' |' }}</div>
                                <div>{{ Carbon::parse($item->published_at)->isoFormat('ddd DD. MMMM YYYY') }}</div>
                            </div>
                        </div>
                    </article>
{{--                @endif--}}
            @endforeach
            </div>
        @endif
        <!-- end gaestebucheintrag -->

    </div>
</div>
