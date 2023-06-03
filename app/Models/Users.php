<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
    'phone_number',
    'user_type',
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

  protected function role(): Attribute
  {
    return new Attribute(
      get: fn($value) => ["TENANT", "STAFF", "AGENT", "ADMIN"][$value],
    );
  }

  /**
   * Always encrypt the password when it is updated.
   *
   * @param $value
   * @return string
   */
  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = bcrypt($value);
  }

  public function allUserData(): HasMany{
    return $this->hasMany(UserData::class);
  }

  public function userData(): HasOne{
    return $this->HasOne(UserData::class)->latestOfMany();
  }
}
