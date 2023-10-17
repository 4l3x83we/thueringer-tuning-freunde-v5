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

        return $pdf->download('geburtstagsliste.pdf');

        /*return response()->streamDownload(function () use ($pdf) {
            echo $pdf->download();
        }, 'geburtstag.pdf');*/
        //        return $pdf;
    }

    public function telefonliste()
    {
        return redirect()->back();
    }

    public function satzung()
    {
        return redirect()->back();
    }
}
