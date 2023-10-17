<?php

namespace App\View\Components;

use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Butschster\Head\Facades\Meta;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    protected $meta;
    public function __construct(MetaInterface $meta)
    {
        $this->meta = $meta;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
