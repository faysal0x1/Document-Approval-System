<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Document extends Model
{
    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(Workflow::class, 'type', 'document_type');
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(Approval::class);
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitter_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function currentApproval(): HasOne
    {
        return $this->hasOne(Approval::class)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->with('workflowStep');
    }
}
