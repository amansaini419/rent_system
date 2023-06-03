<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentData extends Model
{
	use HasFactory;

	protected $table = 'document_data';

	protected $fillable = [
		'user_data_id',
	];

	public function userData(): BelongsTo
	{
		return $this->BelongsTo(UserData::class, 'user_data_id');
	}
}
