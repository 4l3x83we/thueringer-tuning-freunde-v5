@php use Carbon\Carbon; @endphp
<x-mail-layout>
    <p>Hallo {{ $kalender->team->vorname }},<br>
        dein Kalendereintrag wurde gelöscht.
    </p>
    <table style="width: 100%; border: none;">
        <tr>
            <td style="width: 200px;">Datum:</td>
            <td>{{ Carbon::parse($kalender->start)->isoFormat('DD.MM.YYYY') . ' - ' . Carbon::parse($kalender->end)->isoFormat('DD.MM.YYYY') }}</td>
        </tr>
        @if($kalender->is_all_day == false)
            <tr>
                <td style="width: 200px;">Uhrzeit:</td>
                @if(Carbon::parse($kalender->start)->isoFormat('HH:mm') != Carbon::parse($kalender->end)->isoFormat('HH:mm'))
                    <td>{{ Carbon::parse($kalender->start)->isoFormat('HH:mm') . ' - ' . Carbon::parse($kalender->end)->isoFormat('HH:mm') . ' Uhr' }}</td>
                @else
                    <td>{{ 'ab: ' . Carbon::parse($kalender->start)->isoFormat('HH:mm') . ' Uhr' }}</td>
                @endif
            </tr>
        @endif
        <tr>
            <td style="width: 200px;">Was:</td>
            <td>{{ $kalender->title }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Beschreibung:</td>
            <td>{!! $kalender->description !!}</td>
        </tr>
    </table>
</x-mail-layout>
