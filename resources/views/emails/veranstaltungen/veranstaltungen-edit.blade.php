<x-mail-layout>
    {{ metaTags('', '', 'Die Veranstaltung '.$veranstaltungen['veranstaltung'].' wurde bearbeitet und wartet auf Prüfung.') }}
    <p class="mt-2">Hallo Alex und Heiko,</p>
    <p class="mt-4">wir haben soeben unsere Veranstaltung ({{ $veranstaltungen['veranstaltung'] }}) geändert.</p>
    <p class="mt-2">Bitte prüft die Veranstaltung schnell, sodass sie bald wieder Online ist.</p>
    <p class="mt-2">Zur Veranstaltung hier lang: <x-custom.links.a-blank color="primary" href="{{ route('frontend.veranstaltungen.show', $veranstaltungen['slug']) }}">{{ $veranstaltungen['veranstaltung'] }}</x-custom.links.a-blank></p>
    <p class="mt-4">Danke sagt der Veranstalter {{ $veranstaltungen['veranstalter'] }}.</p>
</x-mail-layout>
