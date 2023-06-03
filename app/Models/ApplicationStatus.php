<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationStatus extends Model
{
	use HasFactory;

	protected $table = 'application_statuses';

	protected $fillable = [
		'application_id',
	];

	public function application(): BelongsTo
	{
		return $this->BelongsTo(Application::class, 'application_id');
	}
}
