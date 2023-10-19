@php use App\Models\User; @endphp
<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">
        <div class="grid grid-cols-1 gap-4">

            <div class="rounded bg-gray-50 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                <div class=" overflow-auto m-4">
                    <x-custom.table.table>
                        <x-slot:thead>
                            <x-ag.table.th style="min-width: 100px;">Log Name</x-ag.table.th>
                            <x-ag.table.th style="min-width: 250px;">Beschreibung</x-ag.table.th>
                            <x-ag.table.th style="min-width: 180px;">Thementyp</x-ag.table.th>
                            <x-ag.table.th style="min-width: 100px;">Vorgang</x-ag.table.th>
                            <x-ag.table.th style="min-width: 100px;" class="text-center">Vorgangs-ID</x-ag.table.th>
                            <x-ag.table.th style="min-width: 180px;">Art der Ursache</x-ag.table.th>
                            <x-ag.table.th style="min-width: 180px;">User</x-ag.table.th>
                            <x-ag.table.th style="min-width: 100px;">Batch-UUID</x-ag.table.th>
                        </x-slot:thead>
                        <x-slot:tbody>
                            @foreach($activityLogs as $activityLog)
                                <x-ag.table.tr class="align-middle">
                                    <td class="p-2">{{ $activityLog->log_name }}</td>
                                    <td class="p-2">{{ $activityLog->description }}</td>
                                    <td class="p-2">{{ $activityLog->subject_type }}</td>
                                    <td class="p-2">{{ $activityLog->event }}</td>
                                    <td class="p-2 text-center">{{ $activityLog->subject_id }}</td>
                                    <td class="p-2">{{ $activityLog->causer_type }}</td>
                                    <td class="p-2">
                                        @if($activityLog->causer_id)
                                            {{ User::userActivity($activityLog->causer_id) }}
                                        @endif
                                    </td>
                                    <td class="p-2">{{ $activityLog->batch_uuid }}</td>
                                </x-ag.table.tr>
                            @endforeach
                        </x-slot:tbody>
                    </x-custom.table.table>
                </div>
            </div>

        </div>
    </div>
</div>
