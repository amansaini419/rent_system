<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserData extends Model
{
	use HasFactory;

	protected $table = 'user_data';

	protected $fillable = [
		'users_id',
	];

	public function user(): BelongsTo{
		return $this->BelongsTo(Users::class, 'users_id');
	}

	public function application(): HasOne{
    return $this->HasOne(Application::class)->latestOfMany();
  }

	public function applicationData(): HasOne{
    return $this->HasOne(ApplicationData::class);
  }

	public function accomodationData(): HasOne{
    return $this->HasOne(AccomodationData::class);
  }

	public function documentData(): HasOne{
    return $this->HasOne(DocumentData::class);
  }

	public function landlordData(): HasOne{
    return $this->HasOne(LandlordData::class);
  }

	public function fees(): HasOne{
		return $this->hasOne(RegistrationFee::class);
	}

	/* public function application(): HasMany{
		return $this->hasMany(Application::class);
	} */
}
