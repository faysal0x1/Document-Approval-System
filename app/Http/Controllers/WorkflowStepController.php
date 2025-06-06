<?php

namespace App\Http\Controllers;

use App\Models\Workflow;
use App\Models\WorkflowStep;
use Illuminate\Http\Request;

class WorkflowStepController extends Controller
{
    /**
     * Display a listing of steps for a workflow
     */
    public function index(Workflow $workflow)
    {
        $steps = $workflow->steps()->orderBy('step_number')->get();

        return view('admin.workflows.steps.index', [
            'workflow' => $workflow,
            'steps' => $steps,
        ]);
    }

    /**
     * Show the form for creating a new step
     */
    public function create(Workflow $workflow)
    {
        return view('admin.workflows.steps.create', compact('workflow'));
    }

    /**
     * Store a newly created step
     */
    public function store(Request $request, Workflow $workflow)
    {
        $validated = $request->validate([
            'step_number' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'approver_type' => 'required|in:role,department,user',
            'approver_value' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // Check for duplicate step numbers
        if ($workflow->steps()->where('step_number', $validated['step_number'])->exists()) {
            return back()->withInput()->withErrors([
                'step_number' => 'A step with this number already exists',
            ]);
        }

        $workflow->steps()->create($validated);

        return redirect()->route('admin.workflows.steps.index', $workflow)
            ->with('success', 'Step added successfully');
    }

    /**
     * Show the form for editing the specified step
     */
    public function edit(Workflow $workflow, WorkflowStep $step)
    {
        return view('admin.workflows.steps.edit', [
            'workflow' => $workflow,
            'step' => $step,
        ]);
    }

    /**
     * Update the specified step
     */
    public function update(Request $request, Workflow $workflow, WorkflowStep $step)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'approver_type' => 'required|in:role,department,user',
            'approver_value' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $step->update($validated);

        return redirect()->route('admin.workflows.steps.index', $workflow)
            ->with('success', 'Step updated successfully');
    }

    /**
     * Remove the specified step
     */
    public function destroy(Workflow $workflow, WorkflowStep $step)
    {
        $step->delete();

        // Reorder remaining steps if needed
        $steps = $workflow->steps()->orderBy('step_number')->get();
        $stepNumber = 1;

        foreach ($steps as $s) {
            if ($s->step_number !== $stepNumber) {
                $s->update(['step_number' => $stepNumber]);
            }
            $stepNumber++;
        }

        return redirect()->route('admin.workflows.steps.index', $workflow)
            ->with('success', 'Step deleted successfully');
    }
}
