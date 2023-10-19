<x-mail-layout>
    <style>
        p {
            padding-bottom: 16px;
        }
    </style>
    <p>Hallo,</p>
    <p>soeben wurde ein neues Album hinzugefügt.</p>

    <p>Hier der Link zur Überprüfung des neuen Albums: <x-custom.links.button-link href="{{ route('frontend.galerie.edit', $alben->slug) }}">zum Album</x-custom.links.button-link></p>
    <p>Danke sagt euer Mitglied {{ auth()->user()->teams->vorname }}.</p>
</x-mail-layout>
