@error($id ?? '')
<input type="{{ $type ?? 'text' }}" id="{{ $id ?? '' }}" name="{{ $id ?? '' }}" placeholder="{{ $text ?? '' }}" {{ $attributes->merge(['class' => 'block w-full p-2 text-gray-900 border border-red-300 rounded bg-gray-50 text-xs focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-red-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 shadow-xl']) }}>
<span class="text-xs text-red-600 dark:text-red-500">
        {{ $message }}
    </span>
@else
    <input type="{{ $type ?? 'text' }}" id="{{ $id ?? '' }}" name="{{ $id ?? '' }}" placeholder="{{ $text ?? '' }}" {{ $attributes->merge(['class' => 'block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 text-xs focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 shadow-xl']) }}>
@enderror
