<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">
        <form wire:submit.prevent="edit">
            <x-honeypot livewire-model="extraFields"/>
            <!-- Formular -->
            <div class="grid grid-cols-1 gap-4">

                <div class="my-8 rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                    <div wire:loading.class="opacity-50">
                        <h1 class="mb-2 text-2xl">Album bearbeiten</h1>

                        <div class="grid grid-cols-2 gap-4 lg:grid-cols-8">
                            <div class="col-span-2 lg:col-span-3">
                                <x-custom.form.label-input id="form.title" wire:model="form.title" text="Titel" stern="true"/>
                            </div>
                            <div class="col-span-2 lg:col-span-2">
                                <x-custom.form.select-label id="form.kategorie" wire:model="form.kategorie" text="Kategorie" stern="true">
                                    <option value="Treffen">Treffen</option>
                                    <option value="Club-interne-Treffen">Club interne Treffen</option>
                                    <option value="Club-intern">Club intern</option>
                                </x-custom.form.select-label>
                            </div>
                            <div class="col-span-2 lg:col-span-2">
                                <x-custom.form.label-input id="form.published_at" wire:model.live="form.published_at" type="datetime-local" text="Veröffentlichen am:" stern="true"/>
                            </div>
                            <div class="col-span-2 lg:col-span-1">
                                <x-custom.form.label text="Veröffentlichen"/>
                                <x-custom.form.toggle id="form.published"/>
                            </div>
                            <div class="col-span-2 lg:col-span-9">
                                <x-custom.form.label-input id="form.description" wire:model="form.description" text="Beschreibung"/>
                            </div>
                        </div>

                    </div>

                    <div>
                        <x-custom.errors.errorMessages/>
                        <div class="mb-4">
                            Durch das Absenden dieses Formulars stimmst du unserer <a href="" class="underline underline-offset-2">Datenschutzrichtlinie</a>
                            zu, in der erläutert wird, wie wir deine persönlichen Daten erfassen, verwenden und offenlegen dürfen,
                            auch an Dritte.
                        </div>
                        <!-- Buttons -->
                        @if(auth()->id() === $form->user_id or auth()->user()->hasAnyRole('admin|super_admin'))
                            @can('edit')
                                <div class="flex items-center justify-end gap-2 last:pr-0">
                                    <x-custom.links.button-link :href="route('frontend.galerie.show', $form->slug.'#add')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-images mr-2 -ml-1 h-4 w-4" viewBox="0 0 16 16">
                                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                                        </svg>
                                        Fotos hinzufügen
                                    </x-custom.links.button-link>
                                    <x-custom.button.loading-button target="edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="mr-2 h-4 w-4 bi bi-floppy" viewBox="0 0 16 16">
                                            <path d="M11 2H9v3h2V2Z"/>
                                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0ZM1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5Zm3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4v4.5ZM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5V15Z"/>
                                        </svg>
                                    </x-custom.button.loading-button>
                                </div>
                            @endcan
                        @endif
                        <!-- end Buttons -->
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
