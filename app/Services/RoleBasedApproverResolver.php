<?php

namespace App\Services;

use App\Interfaces\ApproverResolverInterface;
use App\Models\Document;
use App\Models\User;
use App\Models\WorkflowStep;

class RoleBasedApproverResolver implements ApproverResolverInterface
{
    public function resolveApprover(WorkflowStep $step, Document $document): mixed
    {
        return User::whereHas('roles', function ($query) use ($step) {
            $query->where('id', $step->approver_value);
        })->first();
    }
}
