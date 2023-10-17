<div wire:loading.class="opacity-50">
    <div class="flex flex-col lg:flex-row justify-between">
        <h1 class="mb-2 text-2xl">Fahrzeugdaten</h1>
        <x-custom.links.button-link href="{{ route('frontend.fahrzeuge.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward mr-2 -ml-1" viewBox="0 0 16 16">
                <path d="M.5 3.5A.5.5 0 0 1 1 4v3.248l6.267-3.636c.52-.302 1.233.043 1.233.696v2.94l6.267-3.636c.52-.302 1.233.043 1.233.696v7.384c0 .653-.713.998-1.233.696L8.5 8.752v2.94c0 .653-.713.998-1.233.696L1 8.752V12a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm7 1.133L1.696 8 7.5 11.367V4.633zm7.5 0L9.196 8 15 11.367V4.633z"/>
            </svg>
            Zurück
        </x-custom.links.button-link>
    </div>

        <div class="grid grid-cols-2 gap-4 lg:grid-cols-6">
            <div class="col-span-2 lg:col-span-3">
                <x-custom.form.label-input id="form.fahrzeug" wire:model="form.fahrzeug" text="Fahrzeug" stern="true"/>
            </div>
            <div class="col-span-2 lg:col-span-3">
                <x-custom.form.label-input id="form.baujahr" type="date" wire:model="form.baujahr" text="Baujahr" stern="true"/>
            </div>
            <div class="col-span-2 lg:col-span-3">
                <x-custom.form.label-input id="form.besonderheiten" wire:model="form.besonderheiten" text="Besonderheiten"/>
            </div>
            <div class="col-span-2 lg:col-span-3">
                <x-custom.form.label-input id="form.motor" wire:model="form.motor" text="Motor" stern="true"/>
            </div>
            <div class="col-span-2 lg:col-span-3">
                <x-custom.form.label-input id="form.karosserie" wire:model="form.karosserie" text="Karosserie"/>
            </div>
            <div class="col-span-2 lg:col-span-3">
                <x-custom.form.label-input id="form.felgen" wire:model="form.felgen" text="Felgen"/>
            </div>
            <div class="col-span-2 lg:col-span-3">
                <x-custom.form.label-input id="form.fahrwerk" wire:model="form.fahrwerk" text="Fahrwerk"/>
            </div>
            <div class="col-span-2 lg:col-span-3">
                <x-custom.form.label-input id="form.bremsen" wire:model="form.bremsen" text="Bremsen"/>
            </div>
            <div class="col-span-2 lg:col-span-3">
                <x-custom.form.label-input id="form.innenraum" wire:model="form.innenraum" text="Innenraum"/>
            </div>
            <div class="col-span-2 lg:col-span-3">
                <x-custom.form.label-input id="form.anlage" wire:model="form.anlage" text="Anlage"/>
            </div>
            <div class="col-span-2 lg:col-span-6">
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
