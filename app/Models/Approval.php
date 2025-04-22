<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Approval extends Model
{
    protected $guarded = [];

    protected array $dates = ['approved_at'];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function workflowStep(): BelongsTo
    {
        return $this->belongsTo(WorkflowStep::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitter_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}
