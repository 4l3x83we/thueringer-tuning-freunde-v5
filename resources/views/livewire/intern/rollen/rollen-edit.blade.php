<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">
        <div class="grid grid-cols-1 gap-4">

            <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                <form wire:submit.prevent="save" class="bg-gray-100 dark:bg-gray-900 p-4 rounded shadow border border-gray-200 dark:border-gray-700 mb-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            @role('super_admin')
                                <x-custom.form.label-input id="form.name" wire:model="form.name" text="Name"/>
                            @else
                                <x-custom.form.label-input id="form.name" wire:model="form.name" text="Name" readonly/>
                            @endrole
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
                                            <td class="p-2"><x-custom.form.input-checkbox id="form.permission" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" wire:model="form.permission" wire:key="{{ $permission->name }}"/></td>
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
    </div>
</div>
