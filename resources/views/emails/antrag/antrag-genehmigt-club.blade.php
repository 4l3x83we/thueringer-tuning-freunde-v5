<x-mail-layout>
    {{ metaTags('', '', 'Wir heißen unser neues Mitglied herzlich willkommen.') }}
    <?php
        $teams = DB::table('teams')->get();
    ?>
    <p class="mt-2">Soeben wurde der Mitgliedsantrag von {{ $team->fullname() }} genehmigt.</p>

    <p class="mt-2">Ich der Webmaster und Clubmitgründer Alex begrüße unser neues Mitglied {{ $team->vorname }}</p>

    <p class="mt-2">Viel Spaß bei uns wünsche ich dir.</p>

    <p class="mt-2">Liebe Grüße Alex</p>

    <hr class="my-2">
    <p class="mt-2">Zum Teammitglied: <a href="{{ url('team', $team->slug) }}" class="hover:text-primary-500">hier klicken</a> </p>

    @if ($team->fahrzeug_vorhanden == true)
        <hr class="my-2">
        <p class="mt-2">Zu deinem Fahrzeug: <a href="{{ url('fahrzeuge', $team->fahrzeuge->slug) }}" class="hover:text-primary-500">hier klicken</a> </p>
    @endif

    <hr class="my-2">

    <p class="my-2 font-bold text-xl">----  A N H A N G ----</p>

    <p class="my-2">Wir bitten euch darum unsere Domain (<i class="text-primary-500">"thueringer-tuning-freunde.de"</i>) in eurem E-Mail-Postfach freizugeben. Damit ihr <u>alle Informationen</u> per E-Mail von uns erhaltet.</p>

    <table class="w-full border-0 text-left">
        <tbody>
        <tr class="align-top">
            <th class="w-1/3">Standard E-Mail-Adressen:</th>
            <td class="w-2/3">
                <a class="group" href="mailto:info@thueringer-tuning-freunde.de" target="_blank">Allgemeine Mail für Anfragen diese wird an Heiko & Alex weitergeleitet <span class="group-hover:text-primary-500">info@thueringer-tuning-freunde.de</span></a><br><br>
                <a class="group" href="mailto:webmaster@thueringer-tuning-freunde.de" target="_blank">E-Mails werden an Alex weitergeleitet <span class="group-hover:text-primary-500">webmaster@thueringer-tuning-freunde.de</span></a><br>
            </td>
        </tr>
        @if(count($teams) > 0)
            @foreach($teams as $item)
                @if($item->funktion !== 'Werkstattmieter')
                    @if($item->published == true)
                        <tr class="align-top">
                            <th class="w-1/3 py-2">{{ $item->vorname }}:</th>
                            <td class="w-2/3 py-2">
                                <a class="hover:text-primary-500" href="mailto:{{ $item->email }}" target="_blank">{{ $item->email }}</a>
                            </td>
                        </tr>
                    @endif
                @endif
            @endforeach
        @endif
        </tbody>
    </table>

    <p class="mt-2 group">Solltet ihr uns allen eine E-Mail schreiben wollen so kannst du das an die E-Mail-Adresse <a class="group-hover:text-primary-500" href="mailto:club@thueringer-tuning-freunde.de" target="_blank">club@thueringer-tuning-freunde.de</a>?
        Hier kannst du gerne Informationen hinschicken z.b.: für Treffen oder sonstiges was für dich Relevant scheint und du uns das gerne mitteilen möchtest.</p>
</x-mail-layout>
