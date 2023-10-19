@php use App\Models\Frontend\Veranstaltungen\Veranstaltungen;use Carbon\Carbon; @endphp
    <!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Veranstaltungsübersicht</title>
    <link rel="stylesheet" href="./css/pdf.css" type="text/css"/>
    <style>
        #uebersicht th {
            width: 3cm;
            padding: 2px;
            text-align: left;
        }

        #uebersicht td {
            white-space: normal;
            padding: 2px;
        }

        #uebersicht .spacer {
            border-bottom: 1px solid #ff4400; margin: 8px 0;
        }

        #uebersicht tr:last-child .spacer {
            border-bottom: 0;
            margin: 0;
        }
    </style>
</head>
<body>
<header>
    <table style="height: 2cm; max-height: 2cm;">
        <tr>
            <td style="text-align: left; width: 50%;">
                <img src="./images/logo.png" alt="Logo" style="height: 2cm;">
            </td>
        </tr>
    </table>
</header>
<main id="container">
<h2 class="mb-2">Veranstaltungsübersicht</h2>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    @foreach(Veranstaltungen::sort_by_month() as $month => $veranstaltung)
        <tr>
            <td colspan="2" style="text-align: center; font-weight: bold; padding: 4px; font-size: 18px; background: #e5e5e5;">{{ $month }}</td>
        </tr>
        @foreach($veranstaltung as $item)
            <tr>
                <th style="width: 3cm; padding: 2px; text-align: left;">Datum von</th>
                <td style="white-space: normal; padding: 2px;">{{ $item->veranstaltungenDate($item->datum_von, $item->datum_bis)['von'] }}</td>
            </tr>
            <tr>
                <th style="width: 3cm; padding: 2px; text-align: left;">Datum bis</th>
                <td style="white-space: normal; padding: 2px;">{{ $item->veranstaltungenDate($item->datum_von, $item->datum_bis)['bis'] }}</td>
            </tr>
            <tr>
                <th style="width: 3cm; padding: 2px; text-align: left;">Treffen</th>
                <td style="white-space: normal; padding: 2px;">{{ $item->veranstaltung }}</td>
            </tr>
            <tr>
                <th style="width: 3cm; padding: 2px; text-align: left; color: red; font-weight: bold;">Veranstalter</th>
                <td style="white-space: normal; padding: 2px; color: red; font-weight: bold;">{{ $item->veranstalter }}</td>
            </tr>
            <tr>
                <th style="width: 3cm; padding: 2px; text-align: left;">Ort</th>
                <td style="white-space: normal; padding: 2px;"><a href="https://maps.google.com/maps?saddr=&daddr={{ $item->veranstaltungsort }}" target="_blank" style="text-decoration: none; color: #000000;">{{ $item->veranstaltungsort }}</a></td>
            </tr>
            <tr>
                <th style="width: 3cm; padding: 2px; text-align: left;">Quelle</th>
                <td style="white-space: normal; padding: 2px;">{{ $item->quelle }}</td>
            </tr>
            <tr>
                <th style="width: 3cm; padding: 2px; text-align: left;">Eintritt</th>
                <td style="white-space: normal; padding: 2px;">@if($item->eintritt === 'link in der Beschreibung' or $item->eintritt === 'siehe Beschreibung' or empty($item->eintritt))
                        Kein Eintrittspreis bekannt.
                    @else
                        {{ $item->eintritt. ' €' }}
                    @endif</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="border-bottom: 1px solid #ff4400; margin: 8px 0;"></div>
                </td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
</main>
<footer>
    <div style="text-align: right;">Diese Seite wurde am:
        <span style="font-weight: bold; color: #ff4400">{{ Carbon::parse(now())->format('d.m.Y H:i') }}</span> erstellt.
    </div>
</footer>
</body>
</html>
