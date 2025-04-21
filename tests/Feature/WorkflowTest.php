<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStep;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_workflow_creation()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post('/admin/workflows', [
            'document_type' => 'leave_application',
            'name' => 'Leave Application',
            'description' => 'Workflow for leave applications',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('workflows', ['document_type' => 'leave_application']);
    }

    public function test_workflow_step_processing()
    {
        // Create a workflow with steps
        $workflow = Workflow::create([
            'document_type' => 'test_document',
            'name' => 'Test Workflow',
        ]);

        $approver = User::factory()->create();
        $approver->roles()->create(['name' => 'manager']);

        WorkflowStep::create([
            'workflow_id' => $workflow->id,
            'step_number' => 1,
            'approver_type' => 'role',
            'approver_value' => 1, // role ID
            'name' => 'First Approval',
        ]);

        // Create a document
        $user = User::factory()->create();
        $document = Document::create([
            'type' => 'test_document',
            'content' => ['test' => 'data'],
            'submitter_id' => $user->id,
        ]);

        // Process the workflow
        $response = $this->actingAs($approver)->post("/approvals/{$document->approvals->first()->id}/approve");

        $response->assertStatus(200);
        $this->assertEquals('approved', $document->approvals->first()->fresh()->status);
    }
}
