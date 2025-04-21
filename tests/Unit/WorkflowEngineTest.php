<?php

namespace Tests\Unit;

use App\Models\Document;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStep;
use App\Services\WorkflowEngine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkflowEngineTest extends TestCase
{
    use RefreshDatabase;

    public function test_workflow_starts_correctly(): void
    {
        $workflow = Workflow::create([
            'document_type' => 'test_doc',
            'name' => 'Test',
        ]);

        WorkflowStep::create([
            'workflow_id' => $workflow->id,
            'step_number' => 1,
            'approver_type' => 'role',
            'approver_value' => '1',
            'name' => 'Step 1',
        ]);

        $user = User::factory()->create();
        $document = Document::create([
            'type' => 'test_doc',
            'content' => [],
            'submitter_id' => $user->id,
        ]);

        $engine = app(WorkflowEngine::class);
        $engine->startWorkflow($document);

        $this->assertCount(1, $document->approvals);
        $this->assertEquals(1, $document->approvals->first()->workflow_step_id);
    }
}
