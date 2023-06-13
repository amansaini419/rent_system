<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
	];

	public function loan(): BelongsTo{
		return $this->belongsTo(Loan::class);
	}
}
