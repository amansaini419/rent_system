<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Loan extends Model
{
	use HasFactory;

	protected $table = 'loans';

	protected $fillable = [
		'application_id',
		'starting_date',
		'loan_amount',
		'interest_rate',
		'loan_period',
		'monthly_payment',
		'loan_code',
		'loan_status',
		'closed_date',
	];

	public function userData(): HasOneThrough{
		return $this->hasOneThrough(
			UserData::class,
			Application::class,
			'id',
			'id',
			'application_id',
			'user_data_id'
		);
	}

	public function application(): BelongsTo{
		return $this->belongsTo(Application::class);
	}

	public function monthlyPlan(): HasMany{
		return $this->hasMany(MonthlyPlan::class)->orderBy('id', 'asc');
	}
}
