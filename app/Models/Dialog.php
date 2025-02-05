<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dialog
 *
 * @property uuid $uuid
 * @property int $chat_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Dialog extends Model
{
    use HasUuids;

	protected $table = 'dialogs';
	protected $primaryKey = 'uuid';
	public $incrementing = false;

	protected $casts = [
		'uuid' => 'uuid',
		'chat_id' => 'int'
	];

	protected $fillable = [
		'chat_id'
	];
}
