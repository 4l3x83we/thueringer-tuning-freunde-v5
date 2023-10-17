<?php

namespace App\Providers;

use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Butschster\Head\Contracts\Packages\ManagerInterface;
use Butschster\Head\Facades\PackageManager;
use Butschster\Head\MetaTags\Entities\Favicon;
use Butschster\Head\MetaTags\Meta;
use Butschster\Head\Packages\Package;
use Butschster\Head\Providers\MetaTagsApplicationServiceProvider as ServiceProvider;

class MetaTagsServiceProvider extends ServiceProvider
{
    protected function packages()
    {
        /*PackageManager::create('favicons', function (Package $package) {
            $sizes = ['72x72', '96x96', '128x128', '144x144', '152x152', '192x192', '384x384', '512x512'];

            foreach ($sizes as $size) {
                $package->addTag(
                    'favicon.'.$size,
                    new Favicon(asset('images/icons/icon-'.$size.'.png'), [
                        'sizes' => $size,
                    ])
                );
            }
        });*/
    }

    // if you don't want to change anything in this method just remove it
    protected function registerMeta(): void
    {
        $this->app->singleton(MetaInterface::class, function () {
            $meta = new Meta(
                $this->app[ManagerInterface::class],
                $this->app['config']
            );

            //             It just an imagination, you can automatically
            //             add favicon if it exists
            if (file_exists(public_path('images/icons'))) {
                //                $meta->setFavicon(asset('images/icons/icon-512x512.png'), ['sizes' => '512x512', 'type' => 'image/png']);
                $meta->setFavicon(asset('images/logo.svg'), ['type' => 'image/svg+xml']);
            }

            // This method gets default values from config and creates tags, includes default packages, e.t.c
            // If you don't want to use default values just remove it.
            $meta->initialize();
            $meta->setContentType('text/html');
            $meta->setCanonical(canonical_url());
            $meta->addMeta('author', ['content' => env('META_AUTHOR')]);
            $meta->addMeta('generator', ['content' => env('TTF_NAME').' '.env('META_VERSION')]);

            return $meta;
        });
    }
}
