<x-mail-layout>
    {{ metaTags('', '', 'Wir wurden verlassen von '.$team->vorname.'.') }}
    <p class="mt-2">Hallo,</p>
    <p class="mt-2">soeben hat uns {{ $team->vorname }} verlassen.</p>
    <p class="mt-2">Wir wünschen dir viel Spaß auf deinem weiteren Weg.</p>
    <p class="mt-2">Das Team von Thüringer Tuning Freunde.</p>
</x-mail-layout>
