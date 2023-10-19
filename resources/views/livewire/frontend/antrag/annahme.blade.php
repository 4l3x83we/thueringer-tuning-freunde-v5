@php use Carbon\Carbon; @endphp
<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">

        <div class="grid grid-cols-1 gap-4">
            <div class="rounded bg-gray-50 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                <div class=" overflow-auto m-4">
                    @if(count($teams) > 0)
                        <x-custom.table.table>
                            <x-slot:thead>
                                <x-ag.table.th style="min-width: 25px;">ID</x-ag.table.th>
                                <x-ag.table.th style="min-width: 100px;">IP Adresse</x-ag.table.th>
                                <x-ag.table.th>Antragsteller</x-ag.table.th>
                                <x-ag.table.th style="min-width: 500px;">Gespeicherte Daten</x-ag.table.th>
                                <x-ag.table.th style="min-width: 15%;">Erstellt am</x-ag.table.th>
                                <x-ag.table.th></x-ag.table.th>
                            </x-slot:thead>
                            <x-slot:tbody>
                                @foreach($teams as $team)
                                    <x-ag.table.tr>
                                        <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="antrag({{ $team->id }})" :text="$team->id"/>
                                        <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="antrag({{ $team->id }})" :text="$team->ip_adresse"/>
                                        <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="antrag({{ $team->id }})" :text="$team->anrede.' '.$team->fullname()"/>
                                        <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top opacity-75 text-sm" wire:click="antrag({{ $team->id }})">
                                            Anrede, Vorname, Nachname, Straße, PLZ, Ort, Telefon, Mobil, eMail, Geburtsdatum,
                                            Beruf, Facebook, Twitter, Instagram, Beschreibung, Profilbild
                                            @if($team->fahrzeug_vorhanden)
                                                <br><span class="font-bold text-primary-500">Fahrzeugdaten:</span> Fahrzeug, Baujahr,
                                                Besonderheiten, Motor, Karosserie, Felgen, Fahrwerk, Bremsen, Innenraum, Anlage,
                                                Beschreibung, Fahrzeugbilder
                                            @endif
                                        </x-custom.table.responsive.td>
                                        <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="antrag({{ $team->id }})" :text="Carbon::parse($team->created_at)->isoFormat('ddd DD MMMM YYYY HH:mm:ss')"/>
                                        <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white">
                                            @if(!$team->published)
                                                <svg class="w-4 h-4 text-red-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-success-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                            @endif
                                        </x-custom.table.responsive.td>
                                    </x-ag.table.tr>
                                @endforeach
                            </x-slot:tbody>
                        </x-custom.table.table>
                        </div>
                    </div>
                    @else
                <div class="grid gap-4 grid-cols-1">
                    <div class="h-[317px]">
                        <div class="flex justify-center items-center my-auto h-full font-bold text-2xl">Es sind noch
                            keine
                            Anträge eingegangen.
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
