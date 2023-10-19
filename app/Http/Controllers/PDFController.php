<?php

namespace App\Http\Controllers;

use App\Models\Frontend\Team\Team;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PDFController extends Controller
{
    public function veranstaltung()
    {
        $veranstaltungen = Veranstaltungen::where('datum_bis', '>=', now())->orderBy('datum_von')->get();
        $pdf = PDF::loadView('frontend.veranstaltungen.pdf', ['veranstaltungen' => $veranstaltungen])->setOption('isPhpEnabled', true)->setPaper('A4');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'veranstaltungen.pdf');
    }

    public function geburtstagsliste()
    {
        $teams = Team::where('published', true)
            ->orderBy('geburtsdatum')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->geburtsdatum)->monthName;
            });

        $pdf = Pdf::loadView('intern.geburtstagsliste', compact('teams'))->setPaper('A4', 'portrait');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'geburtstagsliste.pdf');
    }

    public function telefonliste()
    {
        $teams = Team::where('published', true)
            ->orderBy('vorname')
            ->get()
            ->groupBy(function ($date) {
                return $date->vorname[0];
            });

        $pdf = Pdf::loadView('intern.telefonliste', compact('teams'))->setPaper('A4', 'portrait');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'telefonliste.pdf');
    }

    public function satzung()
    {
        $teams = Team::where('published', true)->where('funktion', '!=', 'Werkstattmieter')->get();
        $gruend = Team::where('funktion', 'Gründungsmitglied')->get();
        $zahlungGesamt = [];
        $zahlungWerkstatt = [];
        $zahlungMitgliedsbeitrag = [];
        foreach ($teams as $team) {
            $zahlungGesamt[] = $team->zahlung;
            if ($team->zahlungs_art === 'Werkstatt') {
                $zahlungWerkstatt[] = $team->zahlung;
            }
            if ($team->zahlungs_art === 'Mitgliedsbeitrag') {
                $zahlungMitgliedsbeitrag[] = $team->zahlung;
            }
        }
        $teams->gesamt = array_sum($zahlungGesamt);
        $teams->werkstatt = array_sum($zahlungWerkstatt);
        $teams->mitgliedsbeitrag = array_sum($zahlungMitgliedsbeitrag);

        $pdf = Pdf::loadView('intern.satzung', compact('teams', 'gruend'))->setPaper('A4', 'portrait');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Satzung_Thueringer_Tuning_Freunde_Stand_'.Carbon::parse(now())->format('m.Y').'.pdf');
    }
}
