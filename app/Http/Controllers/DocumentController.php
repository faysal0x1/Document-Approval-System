<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Workflow;
use App\Services\WorkflowEngine;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    protected $workflowEngine;

    public function __construct(WorkflowEngine $workflowEngine)
    {
        $this->workflowEngine = $workflowEngine;
    }

    /**
     * List user's documents
     */
    public function index()
    {
        $documents = Document::with(['approvals.workflowStep'])
            ->where('submitter_id', auth()->id())
            ->latest()
            ->paginate(10);

        $documents->each(function ($doc) {
            $doc->setRelation(
                'currentApproval',
                $doc->approvals
                    ->where('status', 'pending')
                    ->sortByDesc('created_at')
                    ->first()
            );
        });

        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $workflows = Workflow::where('is_active', true)->get();

        return view('admin.documents.create', compact('workflows'));
    }

    /**
     * Show the form for creating a specific document type
     */
    public function showForm(Request $request)
    {
        $request->validate([
            'document_type' => 'required|exists:workflows,document_type',
        ]);

        $documentType = $request->document_type;

        return view('admin.documents.form', compact('documentType'));
    }

    /**
     * Store a newly created document
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'type' => 'required|exists:workflows,document_type',
                'content' => 'required|array',
                'attachments' => 'nullable|array',
                'attachments.*' => 'file|max:2048',
            ]);

            $document = Document::create([
                'type' => $validated['type'],
                'content' => $validated['content'],
                'submitter_id' => Auth::id(),
            ]);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('attachments', 'public');
                    $document->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'path' => $path,
                        'mime_type' => $file->getClientMimeType(),
                    ]);
                }
            }
            // Start workflow
            $this->workflowEngine->startWorkflow($document);
            DB::commit();

            return redirect()->back()
                ->with('success', 'Document submitted successfully!');
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show submitted confirmation
     */
    public function submitted(Document $document)
    {
        return view('admin.documents.submitted', compact('document'));
    }

    /**
     * Display the specified document
     */
    public function show(Document $document)
    {
        $viewName = 'documents.partials.content_'.$document->type;

        return view('admin.documents.show', [
            'document' => $document->load(['approvals.workflowStep', 'approvals.approver']),
            'contentView' => view()->exists($viewName) ? $viewName : 'documents.partials.content_default',
        ]);
    }
}
