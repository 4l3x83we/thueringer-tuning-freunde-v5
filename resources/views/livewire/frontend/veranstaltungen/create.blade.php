<div class="mt-[42px] lg:mt-0">
    <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6">

        <div class="bg-gray-100 dark:bg-gray-900 rounded shadow-xl p-4">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="col-span-3 pb-2 border-b border-primary-500">
                        <h1 class="text-2xl">Neue Veranstaltung erstellen</h1>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <x-custom.form.label-input type="datetime-local" id="form.datum_von" wire:model="form.datum_von" text="Datum von"/>
                        </div>
                        <div class="col-span-1">
                            <x-custom.form.label-input type="datetime-local" id="form.datum_bis" wire:model="form.datum_bis" text="Datum bis"/>
                        </div>
                    </div>
                    <div>
                        <x-custom.form.label-input id="form.veranstaltung" wire:model="form.veranstaltung" text="Veranstaltung"/>
                    </div>
                    <div>
                        <x-custom.form.label-input id="form.veranstaltungsort" wire:model="form.veranstaltungsort" text="Veranstaltungsort"/>
                    </div>
                    <div>
                        <x-custom.form.label-input id="form.veranstalter" wire:model="form.veranstalter" text="Veranstalter"/>
                    </div>
                    <div>
                        <x-custom.form.label-input id="form.quelle" wire:model="form.quelle" text="Quelleangabe"/>
                    </div>
                    <div>
                        <x-custom.form.label-input id="form.eintritt" wire:model="form.eintritt" text="Eintritt"/>
                    </div>
                    <div class="col-span-3">
                        <x-custom.form.label id="description" text="Beschreibung" />
                        <x-custom.form.tiny-mce id="description" model="form.description" />
                        <x-custom.helpers.tinyMCEJS />
                    </div>
                    <div class="col-span-3 flex justify-end items-center gap-4">
                        <x-custom.links.button-link href="{{ route('frontend.veranstaltungen.index') }}" color="dark">Schließen</x-custom.links.button-link>
                        <x-custom.button.loading-button type="submit">Speichern</x-custom.button.loading-button>
                    </div>
                </div>
            </form>
        </div>



    </div>
</div>
