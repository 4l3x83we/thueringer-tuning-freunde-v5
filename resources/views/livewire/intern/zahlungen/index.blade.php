@php use App\Models\Frontend\Team\Team;use App\Models\Intern\Payment;use Carbon\Carbon; @endphp
<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">
        <div class="grid grid-cols-1 gap-4">

            <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                <!-- Filter -->
                <div class="flex items-center justify-center py-4 flex-wrap gap-4">
                    <div class="w-32">
                        <x-custom.form.select-label id="filters" wire:model.live="zahlungUpdate">
                            <option value="">All</option>
                            @foreach($years as $year)
                                <option value="{{ Carbon::create($year->year)->year }}">{{ $year->year }}</option>
                            @endforeach
                        </x-custom.form.select-label>
                    </div>
                </div>
                <!-- end Filter -->
                <x-custom.table.table>
                    <x-slot:thead>
                        <tr>
                            <x-custom.table.responsive.th class="w-12" text="#"/>
                            <x-custom.table.responsive.th text="Name"/>
                            <x-custom.table.responsive.th class="w-24 text-right" text="Betrag"/>
                            <x-custom.table.responsive.th class="w-24 text-center" text="Bezahlt am"/>
                            <x-custom.table.responsive.th class="w-12" text=""/>
                        </tr>
                    </x-slot:thead>
                    <x-slot:tbody>
                        @foreach(json_decode($zahlungen, false) as $month => $zahlung)
                            <x-custom.table.responsive.tr>
                                <x-custom.table.responsive.td class="!p-2 font-bold text-primary-500 dark:text-primary-500 !whitespace-normal text-center align-middle" :text="Carbon::create($month)->isoFormat('MMMM YYYY')" colspan="5"/>
                            </x-custom.table.responsive.tr>
                            @foreach($zahlung as $key => $item)
                                <x-custom.table.responsive.tr>
                                    <x-custom.table.responsive.td class="!p-2 font-medium {{ $item->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $item->id }}')" :text="$item->id"/>
                                    <x-custom.table.responsive.td class="!p-2 font-medium {{ $item->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top" wire:click="show('{{ $item->id }}')" :text="$item->name"/>
                                    <x-custom.table.responsive.td class="!p-2 font-medium {{ $item->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top text-right" wire:click="show('{{ $item->id }}')" :text="number_format($item->betrag, 2, ',', '.').' €'"/>
                                    <x-custom.table.responsive.td class="!p-2 font-medium {{ $item->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal align-top text-center" wire:click="show('{{ $item->id }}')" :text="$item->date_of_payment ? Carbon::parse($item->date_of_payment)->isoFormat('DD.MM.YY') : null"/>
                                    <x-custom.table.responsive.td class="!p-2 font-medium {{ $item->bezahlt ? 'text-success-500 dark:text-success-700' : 'text-red-500 dark:text-red-700' }} cursor-pointer !whitespace-normal text-center">
                                        <div class="flex justify-end items-center leading-none">
                                            @if($item->bezahlt)
                                                <x-custom.button.button-blank wire:click="pay('{{ $item->id }}', '0')" color="red-2" wire:loading.remove>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-circle h-4 w-4" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </x-custom.button.button-blank>
                                                <div wire:loading wire:target="pay('{{ $item->id }}', '0')">
                                                    <div role="status">
                                                        <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                        </svg>
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div>
                                            @else
                                                <x-custom.button.button-blank wire:click="pay('{{ $item->id }}', '1')" color="green" wire:loading.remove>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-check2-circle h-4 w-4" viewBox="0 0 16 16">
                                                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                                    </svg>
                                                </x-custom.button.button-blank>
                                                <div wire:loading wire:target="pay('{{ $item->id }}', '1')">
                                                    <div role="status">
                                                        <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                        </svg>
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </x-custom.table.responsive.td>
                                </x-custom.table.responsive.tr>
                            @endforeach
                        @endforeach
                        <x-custom.table.responsive.tr>
                            <x-custom.table.responsive.td colspan="3" class="!p-2 font-medium cursor-pointer !whitespace-normal text-right" :text="$zahlungGesamt"/>
                            <x-custom.table.responsive.td colspan="2" class="!p-2 font-medium cursor-pointer !whitespace-normal text-right" text=""/>
                        </x-custom.table.responsive.tr>
                    </x-slot:tbody>
                </x-custom.table.table>
            </div>
        </div>
    </div>
</div>
