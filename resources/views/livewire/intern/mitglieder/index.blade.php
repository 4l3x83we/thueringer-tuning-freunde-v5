<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">

        <div class="grid grid-cols-1 gap-4">

            <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                <x-custom.table.responsive.table>
                    <x-custom.table.responsive.thead>
                        <tr>
                            <x-custom.table.responsive.th text="#"/>
                            <x-custom.table.responsive.th text="Name"/>
                            <x-custom.table.responsive.th text="E-Mail Adresse"/>
                            <x-custom.table.responsive.th text="Zahlung"/>
                            <x-custom.table.responsive.th text="Fahrzeuge"/>
                            <x-custom.table.responsive.th text="Alben"/>
                            <x-custom.table.responsive.th style="width: 200px" text="Rollen"/>
                            <x-custom.table.responsive.th style="width: 120px" text=""/>
                        </tr>
                    </x-custom.table.responsive.thead>
                    <x-custom.table.responsive.tbody>
                        @foreach($teams as $team)
                            <x-custom.table.responsive.tr>
                                <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" :text="$team->id"/>
                                <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" :text="$team->fullname()"/>
                                <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" :text="$team->email"/>
                                <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" text="{{ $team->zahlungs_art }} ( {{  number_format($team->zahlung, 2, ',', '.') . ' €' }} )"/>
                                <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" :text="$team->fahrzeuges->count()"/>
                                <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" text="{{  $team->albums->where('published', true)->count().' ( '.$team->photos->where('published', true)->count().' )' }}"/>
                                <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $team->slug }}')" >
                                    @foreach($team->users->roles as $role)
                                        <x-custom.badge.badge color="gray" class="m-1">{{ __($role->name) }}</x-custom.badge.badge>
                                    @endforeach
                                </x-custom.table.responsive.td>
                                <x-custom.table.responsive.td class="!p-2 font-medium text-neutral-900 dark:text-white">
                                    <div class="flex items-center justify-center">
                                        <x-custom.links.a-blank href="{{ route('intern.mitglieder.show', $team->slug) }}"  class="mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye fill-yellow-300 hover:fill-yellow-400" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                        </x-custom.links.a-blank>
                                        <x-custom.links.a-blank href="{{ route('intern.mitglieder.edit', $team->slug) }}"  class="mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen fill-blue-700 hover:fill-blue-600" viewBox="0 0 16 16">
                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                            </svg>
                                        </x-custom.links.a-blank>
                                        {{--<x-custom.links.a-blank href="{{ route('intern.mitglieder.index') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3 fill-red-700 hover:fill-red-600" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                        </x-custom.links.a-blank>--}}
                                    </div>
                                </x-custom.table.responsive.td>
                            </x-custom.table.responsive.tr>
                        @endforeach
                    </x-custom.table.responsive.tbody>
                </x-custom.table.responsive.table>
            </div>

        </div>

    </div>
</div>
