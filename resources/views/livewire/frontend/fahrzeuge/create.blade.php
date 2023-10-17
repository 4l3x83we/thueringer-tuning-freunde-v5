<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">
        <form wire:submit.prevent="edit">
            <x-honeypot livewire-model="extraFields"/>
            <!-- Formular -->
            <div class="grid grid-cols-1 gap-4">

                <div class="my-8 rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                    @include('livewire.frontend.fahrzeuge.form.fahrzeuge')
                    <!-- Fahrzeugbilder -->
{{--                    @if($fahrzeugvorhanden === true)--}}
                        <div wire:loading.class="opacity-50">
                            <h1 class="mb-2 text-2xl">Fahrzeugbilder</h1>
                            <div
                                x-data="{ uploading: false, progress: 0 }"
                                x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                            >
                                @if($form->images)
                                    <div class="grid grid-cols-12 gap-2">
                                        <div class="col-span-12">
                                            <h1 class="mb-2 text-lg">Vorschau</h1>
                                        </div>
                                        @foreach($form->images as $image)
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
                                    <x-custom.form.file id="form.images" wire:model="form.images" text="" multiple accept="image/*"/>
                                @else
                                    <x-custom.form.file id="form.images" wire:model="form.images" text="" multiple accept="image/*"/>
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
{{--                    @endif--}}
                    <!-- end Fahrzeugbilder -->
                    <div>
                        <x-custom.errors.errorMessages/>
                        <div class="mb-4">
                            Durch das Absenden dieses Formulars stimmst du unserer <a href="" class="underline underline-offset-2">Datenschutzrichtlinie</a>
                            zu, in der erläutert wird, wie wir deine persönlichen Daten erfassen, verwenden und offenlegen dürfen,
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
                </div>

            </div>
        </form>
    </div>
</div>
