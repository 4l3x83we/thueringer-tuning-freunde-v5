@php use Carbon\Carbon; @endphp
<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">

        <div class="grid grid-cols-1 gap-4">

            <div class="rounded bg-gray-50 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                <div class="overflow-auto m-4">
                    <x-custom.table.table>
                        <x-slot:thead>
                            <tr>
                                <x-custom.table.responsive.th text="#"/>
                                <x-custom.table.responsive.th text="Name"/>
                                <x-custom.table.responsive.th text="E-Mail Adresse"/>
                                <x-custom.table.responsive.th style="min-width: 200px" text="Zahlung"/>
                                <x-custom.table.responsive.th text="Fahrzeuge"/>
                                <x-custom.table.responsive.th style="min-width: 100px" text="Alben"/>
                                <x-custom.table.responsive.th style="width: 200px" text="Rollen"/>
                                <x-custom.table.responsive.th style="min-width: 155px; width: 155px;" text="Letzter Login"/>
                                <x-custom.table.responsive.th style="width: 120px" text=""/>
                            </tr>
                        </x-slot:thead>
                        <x-slot:tbody>
                            @foreach($teams as $team)
                                <x-custom.table.responsive.tr>
                                    <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" :text="$team->id"/>
                                    <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" :text="$team->fullname()"/>
                                    <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" :text="$team->email"/>
                                    <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" text="{{ $team->zahlungs_art }} ( {{  number_format($team->zahlung, 2, ',', '.') . ' €' }} )"/>
                                    <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" :text="$team->fahrzeuges->count()"/>
                                    <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" text="{{  $team->albums->where('published', true)->count().' ( '.$team->photos->where('published', true)->count().' )' }}"/>
                                    <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')">
                                        @foreach($team->users->roles as $role)
                                            <x-custom.badge.badge color="gray" class="m-1">{{ __($role->name) }}</x-custom.badge.badge>
                                        @endforeach
                                    </x-custom.table.responsive.td>
                                    <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')">
                                        <div class="flex flex-col">
                                            @if($team->users->last_login_at !== $team->users->last_seen)
                                                <span class="text-success-700">{{ Carbon::parse($team->users->last_seen)->format('d.m.Y H:i:s') }}</span>
                                            @elseif($team->users->last_login_at)
                                                <span class="text-red-700">{{ Carbon::parse($team->users->last_login_at)->format('d.m.Y H:i:s') }}</span>
                                            @endif
                                            <span>{{ $team->users->last_login_ip }}</span>
                                        </div>
                                    </x-custom.table.responsive.td>
                                    <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white">
                                        <div class="flex items-center justify-end gap-4">
                                            @hasanyrole('super_admin|admin')
                                            <x-custom.button.button-blank color="primary" wire:click="sendNewPassword('{{ $team->user_id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </x-custom.button.button-blank>
                                            <x-custom.links.a-blank href="{{ route('intern.annahme.show', $team->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3 fill-red-700 hover:fill-red-600" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                </svg>
                                            </x-custom.links.a-blank>
                                            @endhasanyrole
                                        </div>
                                    </x-custom.table.responsive.td>
                                </x-custom.table.responsive.tr>
                            @endforeach
                        </x-slot:tbody>
                    </x-custom.table.table>
                </div>
            </div>

        </div>

    </div>
</div>
