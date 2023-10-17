<?php

namespace Database\Seeders;

use App\Models\Frontend\Team\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeamAlexSeeder extends Seeder
{
    public function run(): void
    {
        $team = Team::create([
            'slug' => 'alex',
            'anrede' => 'Herr',
            'vorname' => 'Alexander',
            'nachname' => 'Guthmann',
            'strasse' => 'Fuldaer Straße 141',
            'plz' => '99423',
            'wohnort' => 'Weimar',
            'telefon' => '03643731814',
            'mobil' => '01721020770',
            'email' => 'aguthmann83@gmail.com',
            'geburtsdatum' => '1983-03-24',
            'beruf' => 'keinen',
            'facebook' => 'alex83we',
            'tiktok' => 'alex83we',
            'instagram' => 'alex83we',
            'description' => '<p class="trennung">Hallo, ich bin der Alex und ich komme aus der Klassiker- und Kulturstadt 99 Weimar im sch&ouml;nen Th&uuml;ringen!</p>
 <p class="trennung">Ich bin 38 Jahre jung und treibe hier bei den Tuning Freunden mein Unwesen als Webmaster und stehe auch mal in der Werkstatt und mache mir die Fingerchen schmutzig.</p>
 <p class="trennung">Aktuell besitze ich kein Fahrzeug, da ich meinen Lappen in Flensburg hinterlegt habe mit einem vollen Punktekonto.</p>
 <p class="trennung">Man sollte halt die Fahrerlaubnis nicht mit Payback verwechseln und P&uuml;nktchen sammeln :-).</p>
 <p class="trennung">In meiner Vergangenheit war ich mit einem Opel Astra F 1,6 Liter aus dem Jahre 1996 in Weinrot unterwegs:</p>
 <ul>
 <li>Frontmaske CSR-FM005</li>
 <li>Frontsto&szlig;stange CS4-Look</li>
 <li>Schwarze R&uuml;ckleuchten</li>
 <li>Hecksch&uuml;rze FM-Look</li>
 <li>Momo Sportlenkrad</li>
 <li>Tieferlegungs Fahrwerk 60/40 von Sportline</li>
 </ul>
 <p class="trennung">Einen Ford Escort MK5 1.6i Liter kann ich auch zu meinen Fahrzeugen z&auml;hlen dieser war Original.</p>
 <p class="trennung">Des Weiteren habe ich einen Ford Scorpio 2,4-Liter-V6 aus dem Jahre 1994 besessen.</p>
 <p class="trennung">Einen BMW E30 318i aus dem Jahre 1989 kann ich auch zu meinen Fahrzeugen z&auml;hlen.</p>
 <p class="trennung">Dann habe ich einen Honda Civic 1,6i EG6 Liter der 5. Generation aus dem Jahre 1995 also einen von den letzten besessen.</p>
 <ul>
 <li>LT Streetfighter Frontsto&szlig;stange</li>
 <li>Haubenverl&auml;ngerung und Lufthutze in Haube</li>
 <li>Hecksto&szlig;stange von Rieger</li>
 <li>KW Fahrwerk</li>
 </ul>
 <p class="trennung">Aktuell bin ich hier nur der Typ der f&uuml;r die Technik und Website zust&auml;ndig ist.</p>',
            'funktion' => 'Gründungsmitglied',
            'ip_adresse' => request()->getClientIp(),
            'fahrzeug_vorhanden' => false,
            'photo_id' => null,
            'path' => null,
            'published' => 1,
            'published_at' => '2017-07-07',
        ]);

        $user = User::create([
            'vorname' => $team->vorname,
            'nachname' => $team->nachname,
            'email' => $team->email,
            'email_verified_at' => '2017-07-07 14:14:10',
            'password' => Hash::make('alex2801'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole([4]);

        Team::where('id', $team->id)->update(['user_id' => $user->id]);
    }
}
