@error($id ?? '')
<label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-50">{{ $slot }}@if($stern ?? false)
        <span class="text-white">*</span>
    @endif
</label>
@else
    <label for="{{ $id ?? '' }}" class="mb-2 text-sm font-medium text-gray-900 dark:text-white inline-flex gap-2 items-center">{{ $slot }}@if($stern ?? false)
            <span class="text-red-500">*</span>
        @endif
    </label>
@enderror
