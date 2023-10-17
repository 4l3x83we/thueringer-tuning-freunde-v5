<?php

namespace App\Livewire\Intern\Activity;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Component
{
    public function render()
    {
        metaTags('Hier kannst du alle Aktivitäten auf der Webseite sehen.', 'images/logo.svg', 'Aktivitätsprotokoll', 'NOINDEX,NOFOLLOW');
        $activityLogs = Activity::orderByDesc('id')->paginate(30);

        return view('livewire.intern.activity.activity-log', ['activityLogs' => $activityLogs]);
    }
}
