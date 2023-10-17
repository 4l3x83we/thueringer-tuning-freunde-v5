<?php

use Butschster\Head\MetaTags\Viewport;

return [
    /*
     * Meta title section
     */
    'title' => [
        'default' => env('APP_NAME'),
        'separator' => '|',
        'max_length' => 70,
    ],

    /*
     * Meta description section
     */
    'description' => [
        'default' => 'Marken offener Tuningclub Keine Markenbindung alle Fahrzeugtypen sind willkommen bei uns. Auch du musst nicht der Jugendliche sein Tuning macht auch im Alter Spaß.',
        'max_length' => 155,
    ],

    /*
     * Meta keywords section
     */
    'keywords' => [
        'default' => null,
        'max_length' => 255,
    ],

    /*
     * Default packages
     *
     * Packages, that should be included everywhere
     */
    'packages' => [
        // 'jquery', 'bootstrap', ...
        //        'favicons',
    ],

    'charset' => 'utf-8',
    'robots' => 'NOINDEX,NOFOLLOW',
    'viewport' => Viewport::RESPONSIVE,
    'csrf_token' => true,
];
