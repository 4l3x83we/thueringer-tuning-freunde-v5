<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">
        <form wire:submit.prevent="save">
{{--            <x-honeypot livewire-model="extraFields"/>--}}
            <!-- Formular -->
            <div class="grid grid-cols-1 gap-4">

                <div class="my-8 rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                    <div wire:loading.class="opacity-50">
                        <div class="flex flex-col lg:flex-row justify-between items-center mb-4">
                            <h1 class="text-2xl">Neues Album Anlegen</h1>
                            <x-custom.links.button-link href="{{ route('frontend.galerie.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward mr-2 -ml-1" viewBox="0 0 16 16">
                                    <path d="M.5 3.5A.5.5 0 0 1 1 4v3.248l6.267-3.636c.52-.302 1.233.043 1.233.696v2.94l6.267-3.636c.52-.302 1.233.043 1.233.696v7.384c0 .653-.713.998-1.233.696L8.5 8.752v2.94c0 .653-.713.998-1.233.696L1 8.752V12a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm7 1.133L1.696 8 7.5 11.367V4.633zm7.5 0L9.196 8 15 11.367V4.633z"/>
                                </svg>
                                Zurück
                            </x-custom.links.button-link>
                        </div>

                        @include('livewire.frontend.galerie.album.form.form')

                    </div>

                    <div>
                        <x-custom.errors.errorMessages/>
                        <div class="mb-4">
                            Durch das Absenden dieses Formulars stimmst du unserer <a href="" class="underline underline-offset-2">Datenschutzrichtlinie</a>
                            zu, in der erläutert wird, wie wir deine persönlichen Daten erfassen, verwenden und offenlegen dürfen,
                            auch an Dritte.
                        </div>
                        <!-- Buttons -->
                        <div class="flex items-center justify-end gap-2 last:pr-0">
                            <x-custom.button.loading-button target="save">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="mr-2 h-4 w-4 bi bi-floppy" viewBox="0 0 16 16">
                                    <path d="M11 2H9v3h2V2Z"/>
                                    <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0ZM1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5Zm3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4v4.5ZM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5V15Z"/>
                                </svg>
                            </x-custom.button.loading-button>
                        </div>
                        <!-- end Buttons -->
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>
