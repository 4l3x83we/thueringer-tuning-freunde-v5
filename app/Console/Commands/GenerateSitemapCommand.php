<?php

namespace App\Console\Commands;

use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Gaestebuch\Gaestebuch;
use App\Models\Frontend\Team\Team;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Carbon\Carbon;
use File;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'generate:sitemap';

    protected $description = 'Generieren Sie die Sitemap.';

    public function handle(): void
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setLastModificationDate(Carbon::create(env('LAST_MODIFIED'))))
            ->add(Url::create('/#ueber-uns')->setLastModificationDate(Carbon::create(env('LAST_MODIFIED'))))
            ->add(Url::create('/team')->setLastModificationDate(Carbon::create(Team::where('updated_at', '<=', now())->first()->updated_at)))
            ->add(Url::create('/fahrzeuge')->setLastModificationDate(Carbon::create(Fahrzeuge::where('updated_at', '<=', now())->first()->updated_at)))
            ->add(Url::create('/galerie')->setLastModificationDate(Carbon::create(Album::where('updated_at', '<=', now())->first()->updated_at)))
            ->add(Url::create('/veranstaltungen')->setLastModificationDate(Carbon::create(Veranstaltungen::where('updated_at', '<=', now())->first()->updated_at)))
            ->add(Url::create('/kontakt')->setLastModificationDate(Carbon::create(env('LAST_MODIFIED'))))
            ->add(Url::create('/impressum')->setLastModificationDate(Carbon::create(env('LAST_MODIFIED'))))
            ->add(Url::create('/datenschutz')->setLastModificationDate(Carbon::create(env('LAST_MODIFIED'))));

        if (Gaestebuch::all() === null) {
            $sitemap->add(Url::create('/gaestebuch')->setLastModificationDate(Carbon::create(Gaestebuch::where('updated_at', '<=', now())->first()->updated_at)));
        } else {
            $sitemap->add(Url::create('/gaestebuch')->setLastModificationDate(Carbon::create(env('LAST_MODIFIED'))));
        }

        if (! File::exists(public_path('sitemap.xml'))) {
            File::put(public_path('sitemap.xml'), '<?xml version="1.0" encoding="UTF-8"?>');
        }

        Team::where('published', true)->get()->each(function (Team $team) use ($sitemap) {
            if ($team->funktion !== 'Werkstattmieter') {
                $sitemap->add(Url::create("/team/{$team->slug}")->setLastModificationDate(Carbon::create($team->updated_at)));
            }
        });

        Fahrzeuge::where('published', true)->get()->each(function (Fahrzeuge $fahrzeuge) use ($sitemap) {
            $sitemap->add(Url::create("/fahrzeuge/{$fahrzeuge->slug}")->setLastModificationDate(Carbon::create($fahrzeuge->updated_at)));
        });

        Album::where('published', true)->get()->each(function (Album $galerie) use ($sitemap) {
            if ($galerie->kategorie !== 'Fahrzeuge') {
                $sitemap->add(Url::create("/galerie/{$galerie->slug}")->setLastModificationDate(Carbon::create($galerie->updated_at)));
            }
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
