<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['client_id', 'name', 'label', 'status', 'progress', 'critical', 'high', 'medium', 'low', 'notes'])]
class AuditTarget extends Model
{
    /** @use HasFactory<AuditTarget> */
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}