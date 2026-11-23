<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'domain', 'package', 'status', 'overall_progress', 'total_contract_value', 'payment_received', 'notes'])]
class Client extends Model
{
    /** @use HasFactory<Client> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'total_contract_value' => 'decimal:2',
            'payment_received' => 'decimal:2',
        ];
    }

    public function auditTargets()
    {
        return $this->hasMany(AuditTarget::class);
    }

    public function getRemainingBalanceAttribute(): float
    {
        return $this->total_contract_value - $this->payment_received;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}