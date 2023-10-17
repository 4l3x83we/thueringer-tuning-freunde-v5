@php
    $color = [
        'gray' => 'text-gray-900 dark:text-white hover:text-gray-900/60 hover:dark:text-white/60',
        'primary' => 'text-primary-700 dark:text-primary-600 hover:text-primary-700/60 hover:dark:text-primary-600/60',
        'green' => 'text-green-400 dark:text-green-400 hover:text-green-400/60 hover:dark:text-green-400/60',
        'red' => 'text-red-700 dark:text-red-700 hover:text-red-700/60 hover:dark:text-red-700/60',
        'red-2' => 'text-red-500 dark:text-red-700 hover:text-red-500/60 hover:dark:text-red-700/60',
        'yellow' => 'text-yellow-300 dark:text-yellow-300 hover:text-yellow-300/80 hover:dark:text-yellow-300/80',
        'purple' => 'text-purple-700 dark:text-purple-600 hover:text-purple-700/60 hover:dark:text-purple-600/60',
        'blue' => 'text-blue-500 dark:text-blue-500 hover:text-blue-500/60 hover:dark:text-blue-500/60',
        'indigo' => 'text-indigo-700 dark:text-indigo-600 hover:text-indigo-700/60 hover:dark:text-indigo-600/60',
        'pink' => 'text-pink-500 dark:text-pink-500 hover:text-pink-500/80 hover:dark:text-pink-500/80',
        'dark' => 'text-gray-800 dark:text-gray-800 hover:text-gray-800/60 hover:dark:text-gray-800/60',
    ][$color ?? 'gray'];
@endphp

<button type="{{ $type ?? 'button' }}" {{ $attributes->merge(['class' => 'inline-flex items-center font-medium duration-300 shadow-xl '. $color]) }}>
    {{ $slot }}
</button>
