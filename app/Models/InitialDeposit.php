<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitialDeposit extends Model
{
    use HasFactory;

    protected $table = 'initial_deposits';

	protected $fillable = [
		'application_id',
        'invoice_id',
	];
}
