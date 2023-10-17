<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">
        <div class="grid grid-cols-1 gap-4">
            <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">

                <form wire:submit.prevent="save" wire:key="{{ $form->start }}">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="col-span-2 lg:col-span-1">
                            <input type="hidden" wire:model="form.event_id">
                            <x-custom.form.select-label id="form.color" text="Kategorie" stern="true" wire:model.live="form.color">
                                <option value="">Bitte auswählen</option>
                                <option value="Hebebühne">Hebebühne Reservieren</option>
                                <option value="Stellplatz">Stellplatz Reservieren</option>
                                <option value="Reifen">Reifenservice</option>
                                <option value="Andere">Andere</option>
                            </x-custom.form.select-label>
                        </div>
                        <div class="col-span-2 lg:col-span-1">
                            <x-custom.form.label-input id="form.title" text="Titel" stern="true" wire:model="form.title"/>
                        </div>
                        <div class="col-span-2 lg:col-span-1">
                            <x-custom.form.input-checkbox id="form.is_all_day" value="1" text="Den ganzen Tag" stern="true" wire:model.live="form.is_all_day" />
                        </div>
                        <div class="col-span-2 lg:col-span-1">

                        </div>
                        @if($isAllDay)
                            <div class="col-span-2 lg:col-span-1">
                                <x-custom.form.label-input id="form.start" type="date" text="Startdatum" stern="true" wire:model="form.start"/>
                            </div>
                            <div class="col-span-2 lg:col-span-1">
                                <x-custom.form.label-input id="form.end" type="date" text="Enddatum" stern="true" wire:model="form.end"/>
                            </div>
                        @else
                            <div class="col-span-2 lg:col-span-1">
                                <x-custom.form.label-input id="form.start" type="datetime-local" text="Startdatum/-uhrzeit" stern="true" wire:model="form.start"/>
                            </div>
                            <div class="col-span-2 lg:col-span-1">
                                <x-custom.form.label-input id="form.end" type="datetime-local" text="Enddatum/-uhrzeit" stern="true" wire:model="form.end"/>
                            </div>
                        @endif
                        <div class="col-span-full">
                            <x-custom.form.textarea id="form.description" wire:model="form.description" stern="true" text="Beschreibung"></x-custom.form.textarea>
                        </div>
                        <div class="col-span-full">
                            <div class="flex flex-wrap justify-between items-center gap-4">
                                <x-custom.button.loading-button target="save" wire:ignore/>
                                <x-custom.button.button-trash wire:click="destroy('{{ $calendar->id }}')" wire:ignore>Löschen</x-custom.button.button-trash>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
