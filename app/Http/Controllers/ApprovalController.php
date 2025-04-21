<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Services\WorkflowEngine;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    protected $workflowEngine;

    public function __construct(WorkflowEngine $workflowEngine)
    {
        $this->workflowEngine = $workflowEngine;
    }

    /**
     * Display a listing of pending approvals
     */
    public function index()
    {
        $approvals = Approval::where('approver_id', auth()->id())
            ->where('status', 'pending')
            ->with(['document.submitter', 'workflowStep'])
            ->latest()
            ->paginate(10);

        return view('admin.approvals.index', compact('approvals'));
    }

    /**
     * Display the specified approval
     */
    public function show($id)
    {
        $approval = Approval::with([
            'workflowStep',
            'approver',
            'document.submitter',
            'document.attachments',
            'document.approvals.workflowStep',
            'document.approvals.approver',
        ])->findOrFail($id);

        return view('admin.approvals.show', compact('approval'));
    }

    /**
     * Approve the specified approval
     */
    public function approve(Request $request, Approval $approval)
    {
        $validated = $request->validate([
            'comments' => 'nullable|string|max:500',
        ]);

        $this->workflowEngine->processApproval($approval, 'approved', $validated['comments'] ?? null);

        return redirect()->route('approvals.index')
            ->with('success', 'Document approved successfully');
    }

    /**
     * Reject the specified approval
     */
    public function reject(Request $request, Approval $approval)
    {
        $validated = $request->validate([
            'comments' => 'required|string|max:500',
        ]);

        $this->workflowEngine->processApproval($approval, 'rejected', $validated['comments']);

        return redirect()->route('approvals.index')
            ->with('success', 'Document rejected successfully');
    }
}
