<x-mail-layout>
    {{ metaTags('', '', 'Austrittsanfrage von '.$team['vorname'].' '.$team['nachname'].'.') }}
    <p class="mt-2">Hallo Heiko & Alex,</p>
    <p class="mt-2">ich möchte die {{ env('TTF_NAME') }} gerne verlassen.</p>
    <p class="mt-2">Bitte bestätige den Austritt mit der Löschung der Mitgliedsdaten.</p>
    <div class="my-4 text-center">
        <x-custom.links.button-link class="shadow-xl" color="dark" href="{{ route('intern.annahme.show', $team['id']) }}" >Hier geht es zum Antrag</x-custom.links.button-link>
    </div>
    <p class="mt-2">Mit freundlichem Gruß</p>
    <p class="mt-2"> {{ $team['vorname'].' '.$team['nachname'] }}</p>
</x-mail-layout>
