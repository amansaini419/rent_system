<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{
  use HasFactory, HasApiTokens, Notifiable;

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

  protected function role(): Attribute
  {
    return new Attribute(
      get: fn($value) => ["tenant", "staff", "agent", "admin"][$value],
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

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'users';
}
