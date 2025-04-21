<?php

namespace App\Services;

use App\Models\Approval;
use App\Models\Document;
use App\Models\Workflow;
use App\Models\WorkflowStep;
use RuntimeException;

class WorkflowEngine
{
    protected WorkflowStepHandler $stepHandler;

    public function __construct(WorkflowStepHandler $stepHandler)
    {
        $this->stepHandler = $stepHandler;
    }

    public function startWorkflow(Document $document)
    {
        $workflow = Workflow::where('document_type', $document->type)->first();

        if (! $workflow) {
            throw new RuntimeException("No workflow defined for document type: {$document->type}");
        }

        $firstStep = $workflow->steps()->orderBy('step_number')->first();

        if (! $firstStep) {
            throw new RuntimeException("No steps defined for workflow: {$workflow->id}");
        }

        $this->stepHandler->processStep($document, $firstStep);
    }

    public function processApproval(Approval $approval, string $action, ?string $comments = null): void
    {
        if ($approval->status !== 'pending') {
            throw new RuntimeException('Approval has already been processed');
        }

        $approval->update([
            'status' => $action,
            'comments' => $comments,
            'approved_at' => now(),
        ]);

        $document = $approval->document;
        $currentStep = $approval->workflowStep;

        if ($action === 'rejected') {
            $document->update(['status' => 'rejected']);

            return;
        }

        $nextStep = WorkflowStep::where('workflow_id', $currentStep->workflow_id)
            ->where('step_number', '>', $currentStep->step_number)
            ->orderBy('step_number')
            ->first();

        if ($nextStep) {
            $this->stepHandler->processStep($document, $nextStep);
        } else {
            // No more steps - document is fully approved
            $document->update(['status' => 'approved']);
        }
    }
}
