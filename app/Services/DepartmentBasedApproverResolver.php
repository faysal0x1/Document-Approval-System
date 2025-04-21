<?php

namespace App\Services;

use App\Interfaces\ApproverResolverInterface;
use App\Models\Document;
use App\Models\User;
use App\Models\WorkflowStep;

class DepartmentBasedApproverResolver implements ApproverResolverInterface
{
    public function resolveApprover(WorkflowStep $step, Document $document)
    {
        return User::whereHas('department', function ($query) use ($step) {
            $query->where('id', $step->approver_value);
        })->where('is_manager', true)
            ->first();
    }
}
