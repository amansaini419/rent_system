<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlyPlan extends Model
{
    use HasFactory;

    protected $table = 'monthly_plans';

	protected $fillable = [
		'loan_id',
		'invoice_id',
		'due_date',
		'payment_date',
		'penalty',
		'tenant_note',
	];

	public function loan(): BelongsTo{
		return $this->belongsTo(Loan::class);
	}

	public function payments(): HasMany{
		return $this->hasMany(Payment::class, 'invoice_id', 'invoice_id');
	}

	public function invoice(): BelongsTo{
		return $this->belongsTo(Invoice::class);
	}
}
