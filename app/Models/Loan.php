<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
