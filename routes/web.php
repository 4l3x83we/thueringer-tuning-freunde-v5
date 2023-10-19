<?php

use App\Http\Controllers\Auth\MyWelcomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Frontend\Antrag\Annahme;
use App\Livewire\Frontend\Antrag\AnnahmeShow;
use App\Livewire\Frontend\Fahrzeuge\Create;
use App\Livewire\Frontend\Kontakt\Index;
use App\Livewire\Frontend\Team\Edit;
use App\Livewire\Frontend\Team\Show;
use App\Livewire\Intern\Activity\ActivityLog;
use App\Livewire\Intern\Calendar\CalendarCreate;
use App\Livewire\Intern\Calendar\CalendarEdit;
use App\Livewire\Intern\Calendar\CalendarIndex;
use App\Livewire\Intern\Calendar\CalendarShow;
use App\Models\Frontend\Team\Team;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\WelcomeNotification\WelcomesNewUsers;
use Yoeunes\Toastr\Facades\Toastr;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Frontend
Route::name('frontend.')->group(function () {
    Route::get('/', \App\Livewire\Frontend\Index::class)->name('index');
    Route::get('/mail', function () {
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
        /*$mail = [
            'subject' => 'Testmail',
            'name' => '',
            'description' => '<p>es wurde eine neue Galerie erstellt von '.$team->fullname().'.</p>  <p class="mt-4">zur Galerie:</p>',
        ];*/

        return view('intern.satzung', ['teams' => $teams, 'gruend' => $gruend]);
    });
    //  Ueber uns

    //  Team
    Route::get('/team', \App\Livewire\Frontend\Team\Index::class)->name('team.index');
    Route::get('/team/{team}', Show::class)->name('team.show');
    Route::get('/team/{team}/bearbeiten', Edit::class)->name('team.edit')->middleware(['role:member|super_admin|admin']);
    //  Fahrzeuge
    Route::get('/fahrzeuge', \App\Livewire\Frontend\Fahrzeuge\Index::class)->name('fahrzeuge.index');
    Route::get('/fahrzeuge/{fahrzeuge}', \App\Livewire\Frontend\Fahrzeuge\Show::class)->name('fahrzeuge.show');
    Route::get('/fahrzeug/erstellen', Create::class)->name('fahrzeuge.create')->middleware(['role:member|super_admin|admin']);
    Route::get('/fahrzeuge/{fahrzeuge}/bearbeiten', \App\Livewire\Frontend\Fahrzeuge\Edit::class)->name('fahrzeuge.edit')->middleware(['role:member|super_admin|admin']);
    //  Galerie
    Route::get('/galerie', \App\Livewire\Frontend\Galerie\Index::class)->name('galerie.index');
    Route::get('/galerie/erstellen', \App\Livewire\Frontend\Galerie\Album\Create::class)->name('galerie.album.create')->middleware(['role:member|super_admin|admin']);
    Route::get('/galerie/{galerie}/bearbeiten', \App\Livewire\Frontend\Galerie\Album\Edit::class)->name('galerie.edit')->middleware(['role:member|super_admin|admin']);
    Route::get('/galerie/{galerie}', \App\Livewire\Frontend\Galerie\Show::class)->name('galerie.show');
    //  Veranstaltungen
    Route::get('/veranstaltungen', \App\Livewire\Frontend\Veranstaltungen\Index::class)->name('veranstaltungen.index');
    Route::get('/veranstaltungen/pdf', [PDFController::class, 'veranstaltung'])->name('veranstaltungen.pdf');
    Route::get('/veranstaltungen/{veranstaltungen}', \App\Livewire\Frontend\Veranstaltungen\Show::class)->name('veranstaltungen.show');
    Route::get('/veranstaltung/erstellen', \App\Livewire\Frontend\Veranstaltungen\Create::class)->name('veranstaltungen.create');
    Route::get('/veranstaltungen/{veranstaltungen}/bearbeiten', \App\Livewire\Frontend\Veranstaltungen\Edit::class)->name('veranstaltungen.edit');

    //  Antrag
    Route::get('/antrag', \App\Livewire\Frontend\Antrag\Index::class)->name('antrag.index');
    //  Kontakt
    Route::get('/kontakt', Index::class)->name('kontakt.index');
    //  Gästebuch
    Route::get('/gaestebuch', App\Livewire\Frontend\Gaestebuch\Index::class)->name('gaestebuch.index');
});

// Backend
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

//  Mitglieder Bereich

//  Fahrzeug anlegern

//  Album anlegen

//  Neue Veranstaltung anlegen

//  Interne/Admin Route
Route::middleware(['auth'])->name('intern.')->prefix('intern')->group(function () {
    //  Intern

    //  Geburtagsliste
    Route::get('/geburtstagsliste', [PDFController::class, 'geburtstagsliste'])->name('pdf.geburtstagsliste')->middleware('role:member|admin|super_admin');

    //  Telefonliste
    Route::get('/telefonliste', [PDFController::class, 'telefonliste'])->name('pdf.telefonliste')->middleware('role:member|admin|super_admin');

    //  Kalender
    Route::get('/kalender', CalendarIndex::class)->name('calendar.index');
    Route::get('/kalender/erstellen/{start}', CalendarCreate::class)->name('calendar.create');
    Route::get('/kalender/{calendar}/bearbeiten', CalendarEdit::class)->name('calendar.edit');
    Route::get('/kalender/{calendar}', CalendarShow::class)->name('calendar.show');

    //  Satzung
    Route::get('/satzung', [PDFController::class, 'satzung'])->name('pdf.satzung')->middleware('role:member|admin|super_admin');

    //  Anträge
    Route::group(['middleware' => ['role:super_admin|admin']], function () {
        Route::get('/antrag', Annahme::class)->name('annahme.index');
        Route::get('/antrag/{team:id}', AnnahmeShow::class)->name('annahme.show');
    });

    //  Aktivitätsprotokoll
    Route::group(['middleware' => ['role:super_admin|admin']], function () {
        Route::get('/activityLog', ActivityLog::class)->name('activityLog.index');
    });

    //  Zahlungen
    Route::group(['middleware' => ['role:super_admin|admin']], function () {
        Route::get('zahlungen', App\Livewire\Intern\Zahlungen\Index::class)->name('zahlungen.index');
    });

    //  Mitglieder
    Route::group(['middleware' => ['role:super_admin|admin']], function () {
        Route::get('mitglieder', App\Livewire\Intern\Mitglieder\Index::class)->name('mitglieder.index');
        Route::get('mitglieder/{team}/bearbeiten', App\Livewire\Intern\Mitglieder\Edit::class)->name('mitglieder.edit');
    });
    Route::get('mitglieder/{team}', App\Livewire\Intern\Mitglieder\Show::class)->name('mitglieder.show');

    //  Rollen
    Route::group(['middleware' => ['role:super_admin|admin']], function () {
        Route::get('rollen', App\Livewire\Intern\Rollen\RollenIndex::class)->name('rollen.index');
        Route::get('rollen/{rollen}/create', App\Livewire\Intern\Rollen\RollenCreate::class)->name('rollen.create');
        Route::get('rollen/{rollen}/bearbeiten', App\Livewire\Intern\Rollen\RollenEdit::class)->name('rollen.edit');
        Route::get('rollen/{rollen}', App\Livewire\Intern\Rollen\RollenShow::class)->name('rollen.show');
    });
});

Route::get('/offline', function () {
    return view('errors.offline');
});

Route::group(['middleware' => ['web', WelcomesNewUsers::class]], function () {
    Route::get('welcome/{user}', [MyWelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [MyWelcomeController::class, 'savePassword']);
});

// Cache & Sitemap Route
Route::middleware(['auth'])->group(function () {
    Route::get('/sitemap-generate', function () {
        Artisan::call('generate:sitemap');
        Toastr::success('Sitemap wurde erfolgreich erstellt', 'Erfolgreich');

        return redirect(route('frontend.index'));
    });

    // Clear route Cache
    Route::get('/route-cache', function () {
        Artisan::call('route:cache');
        Toastr::success('Routes cache', 'Erfolgreich');

        return redirect(route('frontend.index'));
    });

    Route::get('/route-clear', function () {
        Artisan::call('route:clear');
        Toastr::success('Routes cache cleared', 'Erfolgreich');

        return redirect(route('frontend.index'));
    });
    // Clear config cache
    Route::get('/config-cache', function () {
        Artisan::call('config:clear');
        Toastr::success('Config cache cleared', 'Erfolgreich');

        return redirect(route('frontend.index'));
    });
    // Clear application cache
    Route::get('/cache-clear', function () {
        Artisan::call('cache:clear');
        Toastr::success('Application cache cleared', 'Erfolgreich');

        return redirect(route('frontend.index'));
    });
    // Clear view cache
    Route::get('/view-clear', function () {
        Artisan::call('view:clear');
        Toastr::success('View cache cleared', 'Erfolgreich');

        return redirect(route('frontend.index'));
    });
    // Clear cache using reoptimized class
    Route::get('/optimize-clear', function () {
        Artisan::call('optimize:clear');
        Toastr::success('View cache cleared', 'Erfolgreich');

        return redirect(route('frontend.index'));
    });
});

require __DIR__.'/auth.php';
