<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    public function steps()
    {
        return $this->hasMany(WorkflowStep::class)->orderBy('step_number');
    }

    public function getNextStepNumber()
    {
        $lastStep = $this->steps()->orderByDesc('step_number')->first();

        return $lastStep ? $lastStep->step_number + 1 : 1;
    }
}
