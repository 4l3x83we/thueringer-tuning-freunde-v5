<x-mail-layout>
    {{ metaTags('', '', 'Dein Mitgliedsantrag wurde soeben genehmigt.') }}
    <p>Hallo {{ $team->vorname, }}</p>
    <p class="mt-2">soeben wurde dein Mitgliedsantrag genehmigt.</p>
    <p class="mt-2">Du erhältst im Anschluss noch eine E-Mail, in der du aufgefordert wirst, ein Passwort festzulegen, dieses benötigst
        du für den internen Bereich und um auf der Webseite dein Profil zu bearbeiten oder Bilder hinzuzufügen.</p>
    <p class="mt-2">Des Weiteren kannst du auch Galerien anlegen und Veranstaltungen einstellen.</p>
    <p class="mt-2">Oder du kannst einfach ein weiteres Fahrzeug anlegen, oder ein Projektfahrzeug von dir, was du gerade aufbaust.</p>

    <p class="mt-2">Das gesamte Team der Thüringer Tuning Freunde wünscht dir viel Spaß bei uns.</p>

    <hr class="my-2">
    <p class="mt-2">Zu deinem Eintrag: <a href="{{ url('team', $team->slug) }}" class="hover:text-primary-500">hier klicken</a> </p>

    @if ($team->fahrzeug_vorhanden == true)
        <hr class="my-2">
        <p class="mt-2">Zu deinem Fahrzeug: <a href="{{ url('fahrzeuge', $team->fahrzeuge->slug) }}" class="hover:text-primary-500">hier klicken</a> </p>
    @endif
    <hr class="my-2">
    <p class="mt-2 text-red-700 font-bold">Deine Zugangsdaten zum internen Bereich vorab:</p>
        <p class="mt-2 ml-10"><span class="font-bold">E-Mail-Adresse:</span> {{ $team->email }}</p>
        <p class="mt-2 ml-10"><span class="font-bold">Password:</span> <span class="text-red-700">{{ $team->password }}</span></p>

    <hr class="my-2">
    <div class="mt-2 text-center">
    <x-custom.links.button-link href="{{ route('login') }}" class="hover:text-primary-500">zum Login</x-custom.links.button-link>
    </div>
</x-mail-layout>
