<?php

use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Team\Team;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Yoeunes\Toastr\Facades\Toastr;

if (! function_exists('canonical_url')) {
    function canonical_url(): array|string
    {
        if (Str::startsWith($current = url()->current(), 'https://www')) {
            return str_replace('https://www.', 'https://', $current);
        }

        return str_replace('https://', 'https://www.', $current);
    }
}

function teamInitials($query)
{
    $initials = [];
    foreach ($query as $item) {
        $name = $item->vorname.' '.$item->nachname;
        $name_array = explode(' ', trim($name));

        $firstWord = $name_array[0];
        $lastWord = $name_array[count($name_array) - 1];
        $initials[$item->id] = mb_substr($firstWord[0], 0, 1).''.mb_substr($lastWord[0], 0, 1);
    }

    return $initials;
}

function teamInitial($query)
{
    $initial = '';
    $name = $query->vorname.' '.$query->nachname;
    $name_array = explode(' ', trim($name));

    $firstWord = $name_array[0];
    $lastWord = $name_array[count($name_array) - 1];

    return mb_substr($firstWord[0], 0, 1).mb_substr($lastWord[0], 0, 1);
}

function replaceStrToLower($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', '-'];

    return strtolower(str_replace($search, $replace, $item));
}
function replaceStrToUpper($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', '-'];

    return strtoupper(str_replace($search, $replace, $item));
}
function replaceBlank($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', '-'];

    return str_replace($search, $replace, $item);
}
function replaceBlankMinus($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '-', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', ' ', '-'];

    return str_replace($search, $replace, $item);
}

function imageUpload($request, $path)
{
    $images = $request;
    if (isset($images)) {
        $name = getName($path);

        $make = Image::make($images->getRealPath())->encode('webp', 90);
        // Images Original
        $photo = $make->resize(624, 612, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->stream();
        File::put(public_path($path.'/'.$name), $photo);

        return $name;
    }

    return null;
}

function imageUploadWithThumbnailMultiple($request, $path)
{
    $data = [];
    $dataThumbnail = [];
    $size = [];
    if (! empty($request)) {
        foreach ($request as $images) {
            $rules = ['images' => 'image|mimes:jpg,jpeg,png,gif,webp|max:5120'];
            Validator::make(['images' => $images], $rules)->validate();
            $name = getNameThumbnails($path);

            $thumbnails = Image::make($images->getRealPath())->encode('webp', 90)->resize(624, 612, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream();
            File::put(public_path($path.'/thumbnails/'.$name), $thumbnails);

            // Images Original
            $photo = Image::make($images->getRealPath())->encode('webp', 90)->stream();
            File::put(public_path($path.'/'.$name), $photo);

            $data[] = $name;
            $dataThumbnail[] = 'thumbnails/'.$name;
            $size[] = bytesToHuman($images->getSize());
        }
    } else {
        if (! File::isDirectory(public_path($path))) {
            File::makeDirectory(public_path($path), 0777, true, true);
        }
        $data = null;
        $dataThumbnail = null;
        $size = null;
    }

    return [
        'data' => $data,
        'dataThumbnail' => $dataThumbnail,
        'size' => $size,
    ];
}

function bytesToHuman($getSize): string
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    $step = 1024;
    $i = 0;
    while (($getSize / $step) > 0.9) {
        $getSize /= $step;
        $i++;
    }

    return round($getSize, 2).' '.$units[$i];
}

function allFileSize($path)
{
    $fileSize = 0;
    foreach (File::allFiles(public_path($path)) as $file) {
        $fileSize += $file->getSize();
    }

    return bytesToHuman($fileSize);
}

function getNameThumbnails($path)
{
    $name = Str::random(40).'.webp';

    if (File::exists(public_path($path))) {
        File::delete(public_path($path));
    }

    if (! File::isDirectory(public_path($path))) {
        File::makeDirectory(public_path($path), 0777, true, true);
    }

    if (! File::isDirectory(public_path($path.'/thumbnails'))) {
        File::makeDirectory(public_path($path.'/thumbnails'), 0777, true, true);
    }

    return $name;
}

function getName($path)
{
    $name = Str::random(40).'.webp';

    if (File::exists(public_path($path))) {
        File::delete(public_path($path));
    }

    if (! File::isDirectory(public_path($path))) {
        File::makeDirectory(public_path($path), 0777, true, true);
    }

    /*if (! File::isDirectory(public_path($path.'/thumbnails'))) {
        File::makeDirectory(public_path($path.'/thumbnails'), 0777, true, true);
    }*/

    return $name;
}

function stopForumSpam()
{
    return simplexml_load_string(file_get_contents('https://www.stopforumspam.com/api?ip='.urlencode($_SERVER['REMOTE_ADDR'])));
}

function stopForumSpamEmail($email = '')
{
    return simplexml_load_string(file_get_contents('https://www.stopforumspam.com/api?email='.$email.'&ip='.urlencode($_SERVER['REMOTE_ADDR'])));
}

function stopForumSpamEntry($name = '', $ip = '', $message = '', $email = ''): string
{
    $spamString = '?username='.htmlentities(urlencode($name), ENT_COMPAT, 'UTF-8').'&ip_addr='.urlencode($ip).'&evidence='.htmlentities(urlencode($message), ENT_COMPAT, 'UTF-8').'&email='.urlencode($email).'&api_key='.env('STOP_FORUM_SPAM');
    Toastr::error("Your spam didn't go through have fun keeping spamming.", 'Spam Mail');

    return Http::get('https://www.stopforumspam.com/add.php'.$spamString);
}

function published_at()
{
    return Carbon\Carbon::parse(now())->toDateTimeLocalString();
}

function team($data, $slug, $entry, $userID = null, $fahrzeugesID = null, $published_at = null)
{
    return [
        'user_id' => $userID,
        'fahrzeuges_id' => $fahrzeugesID,
        'slug' => $slug,
        'anrede' => $entry->validate()['team']['anrede'],
        'vorname' => $entry->validate()['team']['vorname'],
        'nachname' => $entry->validate()['team']['nachname'],
        'strasse' => $entry->validate()['team']['strasse'],
        'plz' => $entry->validate()['team']['plz'],
        'wohnort' => $entry->validate()['team']['wohnort'],
        'telefon' => $entry->validate()['team']['telefon'],
        'mobil' => $entry->validate()['team']['mobilfunk'],
        'email' => $entry->validate()['team']['email'],
        'geburtsdatum' => $entry->validate()['team']['geburtstag'],
        'beruf' => $entry->validate()['team']['beruf'],
        'facebook' => $entry->validate()['team']['facebook'],
        'tiktok' => $entry->validate()['team']['tiktok'],
        'instagram' => $entry->validate()['team']['instagram'],
        'description' => $entry->validate()['team']['description'],
        'funktion' => null,
        'ip_adresse' => request()->getClientIp(),
        'fahrzeug_vorhanden' => $entry->fahrzeugvorhanden,
        'photo_id' => null,
        'path' => $data['profilPath'],
        'published' => 0,
        'published_at' => $published_at,
    ];
}

function fahrzeuge($data, $slug, $entry, $userID = null, $albumID = null, $teamID = null, $published_at = null)
{
    return [
        'album_id' => $albumID,
        'user_id' => $userID,
        'team_id' => $teamID,
        'fahrzeug' => $data['title'],
        'slug' => $data['slug'],
        'baujahr' => $entry->validate()['fahrzeuge']['baujahr'],
        'besonderheiten' => $data['besonderheiten'],
        'motor' => $entry->validate()['fahrzeuge']['motor'],
        'karosserie' => $data['karosserie'],
        'felgen' => $data['felgen'],
        'fahrwerk' => $data['fahrwerk'],
        'bremsen' => $data['bremsen'],
        'innenraum' => $data['innenraum'],
        'anlage' => $data['anlage'],
        'description' => $entry->beschreibungFz,
        'path' => $data['path'],
        'published' => 0,
        'published_at' => $published_at,
    ];
}

function photos($data, $title, $slug, $entry, $userID = null, $albumID = null, $fahrzeugesID = null, $published_at = null)
{
    if ($entry->images && count($entry->images) > 0) {
        foreach ($entry->images as $item => $value) {
            Photos::create([
                'album_id' => $albumID,
                'user_id' => $userID,
                'fahrzeuges_id' => $fahrzeugesID,
                'slug' => $slug,
                'size' => $data['size'][$item],
                'images' => $data['data'][$item],
                'images_thumbnail' => $data['dataThumbnail'][$item],
                'description' => Str::limit(strip_tags($title), 200),
                'published' => 0,
                'published_at' => $published_at,
            ]);
        }
    }
}

function album($data, $fileSize, $entry, $userID = null, $published_at = null)
{
    $album = [];
    if (! empty($entry->images)) {
        $album = [
            'user_id' => $userID,
            'title' => $data['title'],
            'slug' => $data['slug'],
            'path' => $data['path'],
            'kategorie' => $data['kategorie'] ?? null,
            'size' => $fileSize ?? null,
            'description' => Str::limit(strip_tags($entry->beschreibungFz), 200) ?? null,
            'published' => 0,
            'published_at' => $published_at,
        ];
    }

    return $album;
}

function albumFZ($data, $fileSize, $entry, $userID = null, $published_at = null)
{
    $album = [];
    if (! empty($entry->images)) {
        $album = [
            'user_id' => $userID,
            'title' => $data['title'],
            'slug' => $data['slug'],
            'path' => $data['path'],
            'kategorie' => $data['kategorie'] ?? null,
            'size' => $fileSize ?? null,
            'description' => Str::limit(strip_tags($entry->description), 200) ?? null,
            'published' => 0,
            'published_at' => $published_at,
        ];
    }

    return $album;
}

function teamPhoto($data, $slug, $entry, $userID = null, $albumID = null, $fahrzeugesID = null, $teamID = null, $published_at = null)
{
    $image = $entry->image;
    if ($image) {
        return [
            'album_id' => $albumID,
            'user_id' => $userID,
            'fahrzeuges_id' => $fahrzeugesID,
            'team_id' => $teamID,
            'slug' => $slug,
            'size' => bytesToHuman($image->getSize()),
            'images' => $data['profilImage'],
            'images_thumbnail' => null,
            'description' => null,
            'published' => 0,
            'published_at' => $published_at,
        ];
    }

    return null;
}

function teamPhotoUpdate($entry, $path)
{
    $image = $entry->image;
    if ($image) {
        $data = [
            'profilImage' => imageUpload($entry->image, $path),
        ];

        return [
            'user_id' => $entry->team->user_id,
            'team_id' => $entry->team->id,
            'size' => bytesToHuman($image->getSize()),
            'images' => $data['profilImage'],
            'published' => 1,
            'published_at' => Carbon::parse(now())->format('Y-m-d'),
        ];
    }

    return null;
}

function albenKategories()
{
    return Album::where('published', true)->where('kategorie', '!=', 'Fahrzeuge')->select('kategorie')->groupBy('kategorie')->get();
}

function metaTags($description = 'Marken offener Tuningclub Keine Markenbindung alle Fahrzeugtypen sind willkommen bei uns. Auch du musst nicht der Jugendliche sein Tuning macht auch im Alter Spaß.', $image = 'images/logo.svg', $title = '', $robots = '')
{
    $titleWithTitle = ! $title == '' ? $title.' | '.env('APP_NAME') : 'Thüringer Tuning Freunde';
    $robots = ! $robots == '' ? $robots : 'NOINDEX,NOFOLLOW';
    Meta::prependTitle(ucfirst($title));
    Meta::setDescription($description, 150);
    Meta::setRobots($robots);
    $og = new OpenGraphPackage('facebook');
    $og->setType('website')
        ->setSiteName(env('TTF_NAME'))
        ->setTitle($titleWithTitle)
        ->setDescription(strip_tags(Str::limit($description, 200)))
        ->setUrl(canonical_url())
        ->setLocale('de_DE')
        ->addImage(asset($image));
    $og->toHtml();
    Meta::registerPackage($og);

    $card = new TwitterCardPackage('twitter');
    $card->setType('website')
        ->setSite(env('TTF_NAME'))
        ->setTitle($titleWithTitle)
        ->setDescription(strip_tags(Str::limit($description, 200)))
        ->setImage(asset($image));
    Meta::registerPackage($card);
}

function passwort_generate($chars)
{
    $data = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_';

    return substr(str_shuffle($data), 0, $chars);
}

function previousPage($table, $where, $status = 'published')
{
    return DB::table($table)->where('id', '<', $where)->where($status, true)->orderBy('updated_at')->first();
}
function nextPage($table, $where, $status = 'published')
{
    return DB::table($table)->where('id', '>', $where)->where($status, true)->orderBy('updated_at')->first();
}

function getDaysRate($date_from, $date_to): int
{
    $start = Carbon::createFromFormat('Y-m-d H:i:s', $date_from);
    $end = Carbon::createFromFormat('Y-m-d H:i:s', $date_to);

    return $start->diffInDays($end);
}

function getHourRate($date_from, $date_to): string
{
    $start = Carbon::createFromFormat('Y-m-d H:i:s', $date_from);
    $end = Carbon::createFromFormat('Y-m-d H:i:s', $date_to);

    return number_format($start->floatDiffInHours($end), 2, ',', '.');
}

function geburtstag()
{
    $geb = Team::where('published', true)->orderBy('vorname')->get();
    foreach ($geb as $team) {
        if (Carbon::parse($team->geburtsdatum)->format('d.m') == date('d.m')) {
            return '<div>Alles Gute '.$team->vorname.' zum '.Carbon::parse($team->geburtsdatum)->age.'. Geburtstag</div>';
        }
    }
}
