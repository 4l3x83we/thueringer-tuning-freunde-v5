<tr {{ $attributes->merge(['class' => 'even:bg-white even:hover:bg-neutral-100/50 odd:bg-neutral-50 odd:hover:bg-neutral-100/50 border-b even:dark:bg-neutral-900 even:dark:hover:bg-neutral-800/50 odd:dark:bg-neutral-800 odd:dark:hover:bg-neutral-800/50 dark:border-neutral-700' ]) }}>
    {{ $slot }}
</tr>
