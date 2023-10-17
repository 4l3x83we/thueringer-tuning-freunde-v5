<div class="grid grid-cols-1 gap-4 lg:grid-cols-2" wire:loading.class="opacity-50">
    <div class="h-full">
        <h1 class="mb-2 text-2xl">Antragsteller</h1>
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
            <div class="h-full">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <div>
                        <x-custom.form.label-input id="form.geburtstag" wire:model="form.geburtstag" type="date" text="Geburtstag" stern="true"/>
                    </div>
                    <div>
                        <x-custom.form.label-input id="form.beruf" wire:model="form.beruf" text="Beruf"/>
                    </div>
                </div>
            </div>
            <div
                x-data="{ uploading: false }"
                x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-error="uploading = false"
            >
                @if($image)
                    <x-custom.form.file wire:model.live="image" text="Profilbild" aria-label="Image"/>
                    <img src="{{ $image->temporaryUrl() }}" class="mb-4 h-auto w-36">
                @else
                    <x-custom.form.file id="image" wire:model.live="image" text="Profilbild" accept="image/*" aria-label="Image"/>
                    @if($oldImage)
                        <img src="{{ $team->profilBild() }}" class="mt-4 h-auto w-36">
                    @else
                        <div class="relative inline-flex items-center justify-center w-36 h-36 overflow-hidden drop-shadow-xl bg-gray-200 rounded-full dark:bg-gray-700 mt-4">
                            <span class="font-medium text-gray-600 dark:text-gray-300 text-7xl">{{ teamInitial($team) }}</span>
                        </div>
                    @endif
                @endif
                <div x-show="uploading"
                     x-transition.duration.300ms
                     x-cloak
                >
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
            <div class="col-span-1 lg:col-span-2">
                <x-custom.form.label id="form.description" text="Beschreibung" stern="true"/>
                <div wire:ignore>
                    <textarea wire:model="form.description" class="min-h-fit h-48 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" name="{{ $id ?? '' }}" id="{{ $id ?? '' }}"></textarea>
                </div>
                @error('form.description')
                <span class="text-xs text-red-600 dark:text-red-500">
                    {{ $message }}
                </span>
                @enderror

                @push('js')
                    <script src="{{ 'https://cdn.tiny.cloud/1/'.env('tinyMCE').'/tinymce/6/tinymce.min.js' }}" referrerpolicy="origin"></script>
                    <script src="{{ asset('js/de/langs/de.js') }}"></script>
                @endpush

                @push('scripts')
                    <script>
                        tinymce.init({
                            selector: 'textarea',
                            height: '250',
                            menubar: false,
                            plugins: 'anchor autolink charmap codesample emoticons image link lists searchreplace table visualblocks wordcount',
                            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                            language: 'de',
                            // forced_root_block: false,
                            setup: function (editor) {
                                editor.on('init change', function () {
                                    editor.save();
                                });
                                editor.on('change', function () {
                                    @this.set('form.description', editor.getContent());
                                });
                            }
                        });
                    </script>
                @endpush
            </div>
        </div>
    </div>
</div>
