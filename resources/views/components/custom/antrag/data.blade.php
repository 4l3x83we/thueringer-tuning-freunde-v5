<div class="w-1/3 bg-transparent h-20 xl:flex xl:items-center xl:justify-center icon-step hidden">
    {!! $pages[$step]['icon'] !!}
</div>
<div class="w-2/3 bg-gray-50 dark:bg-gray-800 h-24 xl:flex xl:flex-col xl:items-center xl:justify-center px-2 rounded-r-lg body-step hidden">
    <h2 class="font-bold text-sm">{{ $pages[$step]['heading'] }}</h2>
    <p class="text-xs text-gray-400">{{ $pages[$step]['subheading'] }}</p>
</div>
