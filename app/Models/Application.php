<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Application extends Model
{
	use HasFactory;

	protected $table = 'applications';

	protected $fillable = [
		'user_data_id',
		'application_type',
		'application_code',
		'subadmin_id',
		'application_remark',
		'admin_remark'
	];

	public function userData(): BelongsTo
	{
		return $this->belongsTo(UserData::class, 'user_data_id');
	}

	public function applicationData(): HasOneThrough{
		return $this->hasOneThrough(
			ApplicationData::class,
			UserData::class,
			'id',
			'user_data_id',
			'user_data_id',
			'id'
		);
	}

	public function currentStatus(): HasOne
	{
		return $this->hasOne(ApplicationStatus::class)->latestOfMany();
	}

	/* public function initialDeposits(): HasMany{
		return $this->hasMany(InitialDeposit::class);
	} */

	/* public function initialDeposits(): HasManyThrough{
		return $this->hasManyThrough(
			Invoice::class,
			InitialDeposit::class
		);
	} */

	public function initialDeposits(): BelongsToMany{
		return $this->belongsToMany(Invoice::class, 'initial_deposits');
	}

	public function loan(): HasOne{
		return $this->hasOne(Loan::class);
	}

	/* public function user(): HasOneThrough
	{
		return $this->hasOneThrough(
			Users::class,
			UserData::class,
			'users_id', // Foreign key of 2nd Model
			'id', // Foreign key of 1st model
		);
	} */
}
