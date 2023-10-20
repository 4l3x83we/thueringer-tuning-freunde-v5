<?php

namespace App\Livewire\Frontend\Instagram;

use Livewire\Component;

class InstagramFeed extends Component
{
    public function render()
    {
        $feed = \Dymantic\InstagramFeed\InstagramFeed::for('tuning_freunde', 12);

        return view('livewire.frontend.instagram.instagram-feed', [
            'instagram_feed' => $feed,
        ]);
    }
}
