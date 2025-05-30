<?php

namespace App\Services;

use App\Interfaces\ApproverResolverInterface;
use App\Models\Approval;
use App\Models\Document;
use App\Models\User;
use App\Models\WorkflowStep;
use App\Notifications\ApprovalRequested;
use Exception;
use InvalidArgumentException;
use Log;
use RuntimeException;

class WorkflowStepHandler
{
    protected $resolvers = [
        'role' => RoleBasedApproverResolver::class,
        'department' => DepartmentBasedApproverResolver::class,
        'user' => SpecificUserApproverResolver::class,
        'dynamic' => DynamicSupervisorApproverResolver::class,
    ];

    public function processStep(Document $document, WorkflowStep $step)
    {
        try {
            $resolver = $this->getResolver($step->approver_type);
            $approver = $resolver->resolveApprover($step, $document);

            if (! $approver) {
                throw new RuntimeException("No approver found for step {$step->id}");
            }
            $approval = Approval::create([
                'document_id' => $document->id,
                'workflow_step_id' => $step->id,
                'approver_id' => $approver->id,
                'status' => 'pending',
            ]);

            $this->sendNotification($approver, $approval);

        } catch (Exception $e) {
            Log::error('Failed to process workflow step', [
                'document_id' => $document->id,
                'step_id' => $step->id,
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException('Could not process approval step: '.$e->getMessage());
        }
    }

    protected function getResolver(string $type): ApproverResolverInterface
    {
        if (! array_key_exists($type, $this->resolvers)) {
            throw new InvalidArgumentException("No resolver found for type: {$type}");
        }

        return app($this->resolvers[$type]);
    }

    protected function sendNotification(User $approver, Approval $approval): void
    {
        try {
            $approver->notify(new ApprovalRequested($approval));
        } catch (Exception $e) {
            Log::error('Failed to send approval notification', [
                'approver_id' => $approver->id,
                'document_id' => $approval->document_id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
