@php
    $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$email['ip_adresse']));
    $currentUserInfo = Stevebauman\Location\Facades\Location::get($email['ip_adresse']);
@endphp
<x-mail-layout>
    <table width="100%" border="0">
        <tbody>
        <tr>
            <td style="width: 200px;">Name:</td>
            <td>{{ $email['name'] }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">E-Mail:</td>
            <td>{{ $email['email'] }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Betreff:</td>
            <td>{{ $email['subject'] }}</td>
        </tr>
        <tr>
            <td style="width: 200px; vertical-align: top;">Nachricht:</td>
            <td>{!! nl2br($email['message']) !!}</td>
        </tr>
        @if($email['ip_adresse'])
            @if($currentUserInfo)
                <tr class="align-top">
                    <th class="py-1 text-left w-1/3">IP Adresse:</th>
                    <td class="py-1 w-2/3">{{ $currentUserInfo->ip }}</td>
                </tr>
                <tr class="align-top">
                    <th class="py-1 text-left w-1/3">Land:</th>
                    <td class="py-1 w-2/3"><img src="https://flagsapi.com/{{ $currentUserInfo->countryCode }}/shiny/24.png" alt="{{ $currentUserInfo->countryCode }}"></td>
                </tr>
                <tr class="align-top">
                    <th class="py-1 text-left w-1/3">Bundesland:</th>
                    <td class="py-1 w-2/3">{{ $currentUserInfo->regionName }}</td>
                </tr>
                <tr class="align-top">
                    <th class="py-1 text-left w-1/3">Ort:</th>
                    <td class="py-1 w-2/3">{{ $currentUserInfo->zipCode.' '.$currentUserInfo->cityName }}</td>
                </tr>
                <tr class="align-top">
                    <td colspan="2">
                        <iframe class="mt-2" width="100%" height="150px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?hl=de&amp;q='.{{ $currentUserInfo->latitude.', '.$currentUserInfo->longitude }}.'&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </td>
                </tr>
            @endif
        @endif
        </tbody>
    </table>
</x-mail-layout>
