<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
	use HasFactory;

	protected $table = 'applications';

	protected $fillable = [
		'user_data_id',
		'application_type',
		'application_code'
	];

	public function userData(): BelongsTo
	{
		return $this->BelongsTo(UserData::class, 'user_data_id');
	}

	public function currentStatus(): HasOne
	{
		return $this->HasOne(ApplicationStatus::class)->latestOfMany();
	}
}
