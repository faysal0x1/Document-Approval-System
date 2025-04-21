<?php

namespace App\Interfaces;

use App\Models\Document;
use App\Models\WorkflowStep;

interface ApproverResolverInterface
{
    public function resolveApprover(WorkflowStep $step, Document $document);
}
