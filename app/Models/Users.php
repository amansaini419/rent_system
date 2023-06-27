<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{
  use HasFactory, HasApiTokens, Notifiable;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'email',
    'password',
		'country_code',
    'phone_number',
    'user_type',
    'name'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /* protected function role(): Attribute
  {
    return new Attribute(
      get: fn ($value) => ["TENANT", "STAFF", "AGENT", "ADMIN"][$value],
    );
  } */

  /**
   * Always encrypt the password when it is updated.
   *
   * @param $value
   * @return string
   */
  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = Hash::make($value);
  }

  public function applications(): HasManyThrough
  {
    return $this->hasManyThrough(Application::class, UserData::class)->latest();
  }

  public function allApplications(): HasManyThrough
  {
    return $this->hasManyThrough(Application::class, UserData::class);
  }

  public function allUserData(): HasMany
  {
    return $this->hasMany(UserData::class);
  }

  public function latestApplications(): HasManyThrough{
    return $this->hasManyThrough(Application::class, UserData::class)->orderBy('id', 'desc');
  }

  public function userData(): HasOne
  {
    return $this->hasOne(UserData::class)->latestOfMany();
  }

  public function applicationData(): HasOneThrough{
    return $this->hasOneThrough(ApplicationData::class, UserData::class)->latest();
  }

  public function invoices(): HasMany{
    return $this->hasMany(Invoice::class);
  }
}
