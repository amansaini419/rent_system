<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyPlan extends Model
{
    use HasFactory;

    protected $table = 'monthly_plans';

	protected $fillable = [
		'loan_id',
		'invoice_id',
		'payment_date',
		'paid_date',
		'penalty',
	];
}
