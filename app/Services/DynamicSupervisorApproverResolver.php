<?php

namespace App\Services;

use App\Interfaces\ApproverResolverInterface;
use App\Models\Document;
use App\Models\User;
use App\Models\WorkflowStep;
use RuntimeException;

class DynamicSupervisorApproverResolver implements ApproverResolverInterface
{
    public function resolveApprover(WorkflowStep $step, Document $document): User
    {
        $submitter = $document->submitter;

        if (! $submitter) {
            throw new RuntimeException('Document submitter not found');
        }

        $supervisorField = $step->approver_value ?: 'supervisor_id';

        if ($submitter->{$supervisorField} instanceof User) {
            $supervisor = $submitter->{$supervisorField};
        } else {
            $supervisor = User::find($submitter->{$supervisorField});
        }

        if (! $supervisor) {
            throw new RuntimeException("No supervisor found for user {$submitter->id} using field {$supervisorField}");
        }

        if (! $supervisor->active) {
            throw new RuntimeException("Supervisor {$supervisor->id} is not active");
        }

        return $supervisor;
    }
}
