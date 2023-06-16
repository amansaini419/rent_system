<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Invoice extends Model
{
	use HasFactory;

	protected $table = 'invoices';

	protected $fillable = [
		'users_id',
		'invoice_amount',
		'invoice_code',
		'invoice_type',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(Users::class, 'users_id');
	}

	public function payments(): HasMany{
		return $this->hasMany(Payment::class)->orderBy('id', 'desc');
	}

	public function loan(): HasOneThrough{
		return $this->hasOneThrough(
			Loan::class,
			MonthlyPlan::class,
			'invoice_id', // where (key) on monthly plan table
			'id', // inner join on loan table
			'id', // where (value) local key on invoice table
			'loan_id' // inner join on monthly plan table
			// SELECT loans.* FROM loans INNER JOIN monthly_plan ON monthly_plan.loan_id = loan.id WHERE monthly_plan.invoice_id = ?
		);
	}

	public function userData(): HasOneThrough{
		return $this->hasOneThrough(
			UserData::class,
			RegistrationFee::class,
			'invoice_id',
			'id',
			'id',
			'user_data_id'
		);
	}

	public function application(): HasOneThrough{
		return $this->hasOneThrough(
			Application::class,
			InitialDeposit::class,
			'invoice_id',
			'id',
			'id',
			'application_id'
		);
	}
}
