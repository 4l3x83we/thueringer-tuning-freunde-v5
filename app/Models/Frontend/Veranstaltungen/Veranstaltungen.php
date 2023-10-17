<?php

namespace App\Models\Frontend\Veranstaltungen;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Veranstaltungen extends Model
{
    use Sluggable;

    protected $fillable = ['datum_von', 'datum_bis', 'veranstaltung', 'veranstaltungsort', 'veranstalter', 'description', 'quelle', 'slug', 'eintritt', 'published', 'published_at', 'anwesend', 'calendar_id'];

    protected $casts = ['datum_von' => 'datetime', 'datum_bis' => 'datetime', 'published_at' => 'datetime'];

    public static function veranstaltungenDate($von, $bis): array
    {
        $dateVon = Carbon::parse($von)->isoFormat('DD.MM.YYYY HH:mm');
        $dateBis = Carbon::parse($bis)->isoFormat('DD.MM.YYYY HH:mm');

        return [
            'von' => $dateVon,
            'bis' => $dateBis,
        ];
    }

    public static function sort_by_month(): Collection
    {
        return self::whereBetween('datum_von', [now()->startOfDay(), now()->addMonths(12)])
            ->orderBy('datum_von')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->datum_von)->isoFormat('MMMM');
            });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'veranstaltung',
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
