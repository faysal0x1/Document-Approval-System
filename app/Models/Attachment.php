<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'document_id',
        'original_name',
        'path',
        'mime_type',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
