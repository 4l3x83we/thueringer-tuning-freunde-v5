<div>
    <div class="cookieconsent-optin-marketing">
        <iframe data-cookieconsent="marketing" data-cookieblock-src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3190.922872876048!2d11.10425717659835!3d51.14328917173278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a405bfa95dab67%3A0x95ced3453404d44a!2sTh%C3%BCringer%20Tuning%20Freunde!5e1!3m2!1sde!2sde!4v1694502206245!5m2!1sde!2sde" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="cookieconsent-optout-marketing flex justify-center font-bold mt-4 text-xl">
        Bitte&nbsp;<a href="javascript: Cookiebot.renew()" class="underline">Marketing-Cookies akzeptieren</a>, um diesen Inhalt anzuzeigen.
    </div>

    <div class="max-w-screen-2xl px-4 py-8 mx-auto lg:py-10 lg:px-6">

        <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <div class="col-span-full lg:col-span-2 xl:col-span-3">
                <form wire:submit.prevent="save">
                    <x-honeypot livewire-model="extraFields"/>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <x-custom.form.label-input text="Name" id="name" wire:model.blur="name" :stern="true"/>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <x-custom.form.label-input type="email" id="email" wire:model.blur="email" text="E-Mail" :stern="true"/>
                        </div>
                        <div class="col-span-2">
                            <x-custom.form.label-input text="Betreff" id="subject" wire:model.blur="subject" :stern="true"/>
                        </div>
                        <div class="col-span-2">
                            <x-custom.form.textarea id="message" wire:model.blur="message" class="h-48"/>
                        </div>
                        <div class="col-span-2">
                            Durch das Absenden dieses Formulars stimmen Sie unserer <a href="" class="underline underline-offset-2">Datenschutzrichtlinie</a> zu, in der erläutert wird, wie wir Ihre persönlichen Daten erfassen, verwenden und offenlegen dürfen, auch an Dritte.
                        </div>
                        <div class="col-span-2">
                            <x-custom.button.button type="submit">
                                Absenden
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-send w-4 h-4 ml-2" viewBox="0 0 16 16">
                                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                </svg>
                            </x-custom.button.button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-span-full lg:col-span-1 xl:col-span-1">
                <div class="flex flex-col justify-center items-center gap-4">
                    <div class="flex flex-col justify-center items-center gap-4 text-center">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-900 rounded-lg flex items-center justify-center shadow-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt w-8 h-8 shadow-lg" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold">Adresse:</h4>
                        <address>
                            <div>{{ env('TTF_STRASSE') }}</div>
                            <div>{{ env('TTF_ORT') }}</div>
                        </address>
                    </div>
                    <div class="flex flex-col justify-center items-center gap-4 text-center">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-900 rounded-lg flex items-center justify-center shadow-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-envelope-at w-8 h-8 shadow-lg" viewBox="0 0 16 16">
                                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                                <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold">Schreiben Sie eine E-Mail:</h4>
                        <x-custom.links.a-blank href="mailto:{{ env('TTF_EMAIL') }}">{{ env('TTF_EMAIL') }}</x-custom.links.a-blank>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
