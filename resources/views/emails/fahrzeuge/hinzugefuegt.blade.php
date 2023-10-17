<x-mail-layout>
    {{ metaTags('', '', 'Fahrzeug hinzugefügt') }}
    <p class="mt-2">Hallo,</p>
    <p class="mt-2">soeben wurde ein Fahrzeug hinzugefügt.</p>

    <p class="mt-4">Hier der Link zur Überprüfung des Fahrzeuges: <br>
        <x-custom.links.button-link class="my-4" href="{{ url('fahrzeuge') }}">zum Fahrzeug</x-custom.links.button-link>
    </p>
    <p class="mt-2">Liebe Grüße</p>
    <p class="mt-2">{{ auth()->user()->vorname }}</p>
</x-mail-layout>
