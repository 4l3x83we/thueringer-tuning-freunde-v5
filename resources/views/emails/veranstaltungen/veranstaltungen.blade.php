<x-mail-layout>
    {{ metaTags('', '', 'Neue Veranstaltung') }}
    <table width="100%" border="0">
        <tbody>
        <tr>
            <th class="py-2 w-1/3 align-top text-left">Veranstaltung:</th>
            <td class="py-2 w-2/3 align-top">
                am {{ Carbon\Carbon::parse($veranstaltungen['datum_von'])->isoFormat('DD.MM.YYYY HH:mm') }}
                bis {{ Carbon\Carbon::parse($veranstaltungen['datum_bis'])->isoFormat('DD.MM.YYYY HH:mm') }}<br><br>
                {{ $veranstaltungen['veranstaltung'] }}<br>
                {{ $veranstaltungen['veranstaltungsort'] }}<br>
                {{ $veranstaltungen['veranstalter'] }}<br>
            </td>
        </tr>
        @if($veranstaltungen['quelle'] == true)
            <tr>
                <th class="py-2 w-1/3 align-top text-left">Kontakt:</th>
                <td class="py-2 w-2/3 align-top">
                    @if($veranstaltungen['quelle'])
                        <x-custom.links.a-blank href="{{ $veranstaltungen['quelle'] }}" color="primary">{{ $veranstaltungen['quelle'] }}</x-custom.links.a-blank><br>
                    @endif
                </td>
            </tr>
        @endif
        <tr>
            <th class="py-2 w-full align-top text-left" colspan="2">Beschreibung:</th>
        </tr>
        <tr>
            <td class="py-2 w-full align-top" colspan="2">{!! Str::limit($veranstaltungen['description'], 250) !!}</td>
        </tr>
        </tbody>
    </table>
</x-mail-layout>
