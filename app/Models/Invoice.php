<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
