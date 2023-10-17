<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">
        <div class="grid grid-cols-1 gap-4">

            <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                <div x-data="{roleFormCreate: false}">
                    <div class="flex justify-end items-center mb-4">
                        <x-custom.button.button @click="roleFormCreate = !roleFormCreate">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-vector-pen mr-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.646.646a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1 0 .708l-1.902 1.902-.829 3.313a1.5 1.5 0 0 1-1.024 1.073L1.254 14.746 4.358 4.4A1.5 1.5 0 0 1 5.43 3.377l3.313-.828L10.646.646zm-1.8 2.908-3.173.793a.5.5 0 0 0-.358.342l-2.57 8.565 8.567-2.57a.5.5 0 0 0 .34-.357l.794-3.174-3.6-3.6z"/>
                                <path fill-rule="evenodd" d="M2.832 13.228 8 9a1 1 0 1 0-1-1l-4.228 5.168-.026.086.086-.026z"/>
                            </svg>
                            Rolle erstellen
                        </x-custom.button.button>
                    </div>
                    <div x-show="roleFormCreate" x-cloak>
                        <form wire:submit.prevent="save" class="bg-gray-100 dark:bg-gray-900 p-4 rounded shadow border border-gray-200 dark:border-gray-700 mb-4">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <x-custom.form.label-input id="form.name" wire:model="form.name" text="Name"/>
                                </div>
                                <div>
                                    <x-custom.table.table>
                                        <x-slot:thead>
                                            <x-ag.table.th></x-ag.table.th>
                                            <x-ag.table.th>Name</x-ag.table.th>
                                            <x-ag.table.th>Guard</x-ag.table.th>
                                        </x-slot:thead>
                                        <x-slot:tbody>
                                            @foreach($permissions as $permission)
                                                <x-ag.table.tr>
                                                    <td class="p-2"><x-custom.form.input-checkbox id="form.permission" value="{{ $permission->name }}" wire:model="form.permission" wire:key="{{ $permission->name }}"/></td>
                                                    <td class="p-2">{{ __($permission->name) }}</td>
                                                    <td class="p-2">{{ $permission->guard_name }}</td>
                                                </x-ag.table.tr>
                                            @endforeach
                                        </x-slot:tbody>
                                    </x-custom.table.table>
                                </div>
                                <div class="flex items-center justify-end">
                                    <x-custom.button.button type="submit">Speichern</x-custom.button.button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <x-custom.table.responsive.table>
                    <x-custom.table.responsive.thead>
                        <tr>
                            <x-custom.table.responsive.th class="w-12" text="ID"/>
                            <x-custom.table.responsive.th text="Name"/>
                            <x-custom.table.responsive.th class="w-12" text=""/>
                        </tr>
                    </x-custom.table.responsive.thead>
                    <x-custom.table.responsive.tbody>
                        <x-custom.delete.sweetAlert/>
                        @foreach($roles as $role)
                            @if($role->name !== auth()->user()->getRoleNames()->first())
                            <x-custom.table.responsive.tr>
                                <x-custom.table.responsive.td class="!p-2 font-medium cursor-pointer !whitespace-normal align-top" wire:click="edit({{ $role->id }})" :text="$role->id"/>
                                <x-custom.table.responsive.td class="!p-2 font-medium cursor-pointer !whitespace-normal align-top" wire:click="edit({{ $role->id }})" :text="__($role->name)"/>
                                <x-custom.table.responsive.td class="!p-2 font-medium cursor-pointer !whitespace-normal align-middle">
                                    <div class="flex justify-end items-center gap-4">
                                        <!-- edit -->
                                        <x-custom.button.button-blank wire:click="edit({{ $role->id }})" color="blue">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen w-4 h-4" viewBox="0 0 16 16">
                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                            </svg>
                                        </x-custom.button.button-blank>
                                        <!-- trash -->
                                        <x-custom.button.button-blank wire:click="$dispatch('triggerDelete','{{ $role->id }}')" color="red">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3 w-4 h-4" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                        </x-custom.button.button-blank>
                                    </div>
                                </x-custom.table.responsive.td>
                            </x-custom.table.responsive.tr>
                            @endif
                        @endforeach
                        <x-custom.delete.script id="triggerDelete" function="destroy" />
                    </x-custom.table.responsive.tbody>
                </x-custom.table.responsive.table>
            </div>

        </div>
    </div>
</div>
