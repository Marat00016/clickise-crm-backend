<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 *
 * @property uuid $uuid
 * @property uuid $dialog_uuid
 * @property uuid $contact_uuid
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Message extends Model
{
    use HasUuids;

	protected $table = 'messages';
	protected $primaryKey = 'uuid';
	public $incrementing = false;

	protected $casts = [
		'uuid' => 'uuid',
		'dialog_uuid' => 'uuid',
		'contact_uuid' => 'uuid'
	];

	protected $fillable = [
		'dialog_uuid',
		'contact_uuid'
	];
}
