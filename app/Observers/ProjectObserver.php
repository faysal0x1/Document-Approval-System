<?php

namespace App\Observers;

use App\Jobs\SendProjectCreatedEmail;
use App\Jobs\SendProjectStatusChangedEmail;
use App\Models\Project;

class ProjectObserver
{
    public function created(Project $project): void
    {
        SendProjectCreatedEmail::dispatch($project);
    }

    public function updated(Project $project): void
    {
        if ($project->isDirty('status')) {
            SendProjectStatusChangedEmail::dispatch($project);
        }
    }
}
