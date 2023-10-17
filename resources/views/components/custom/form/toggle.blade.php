<label class="relative inline-flex items-center cursor-pointer h-[34px]">
    <input type="checkbox" value="true" wire:model.live="{{ $id ?? '' }}" class="sr-only peer">
    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-300 dark:peer-focus:ring-primary-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[9px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600"></div>
    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{!! $text ?? '' !!}</span>
</label>
