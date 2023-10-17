@php use Carbon\Carbon; @endphp
    <!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Geburtstagsliste</title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}" type="text/css"/>
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
        #uebersicht #liste tr:nth-child(even) {background: #CCC}
        #uebersicht #liste tr:nth-child(odd) {background: #FFF}
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
<h2 style="text-align: center; font-weight: bold; padding: 4px; font-size: 18px; margin-bottom: 12px;">Geburtstagsliste</h2>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="uebersicht">
    <thead>
    <tr>
        <th>Name</th>
        <th>Geburtstag</th>
        <th>Alter</th>
        <th></th>
    </tr>
    </thead>
    <tbody id="liste">
        @foreach($teams as $month => $team)
            <tr>
                <td style="text-align: center; font-weight: bold; padding: 4px; color: #ff4400; font-size: 16px; margin-bottom: 12px;" colspan="4">{{ $month }}</td>
            </tr>
            @foreach($team as $item)
                <tr>
                    <td>{{ $item->vorname . ' ' . $item->nachname }}</td>
                    <td>{{ Carbon::parse($item->geburtsdatum)->isoFormat('DD.MM.YYYY') }}</td>
                    <td>{{ Carbon::parse($item->geburtsdatum)->age . ' Jahre' }}</td>
                    <td>{{ Carbon::parse($item->geburtsdatum)->age + 1 . ' Jahre' }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
</main>
<footer>
    <div style="text-align: right; margin-top: 12px;">Diese Seite wurde am:
        <span style="font-weight: bold; color: #ff4400">{{ Carbon::parse(now())->format('d.m.Y H:i') }}</span> erstellt.
    </div>
</footer>
</body>
</html>
