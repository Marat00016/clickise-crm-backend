<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 *
 * @property uuid $uuid
 * @property uuid $client_uuid
 * @property int $telegram_chat_id
 * @property string|null $name
 * @property string|null $email
 * @property int|null $phone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Contact extends Model
{
    use HasUuids;

	protected $table = 'contacts';
	protected $primaryKey = 'uuid';
	public $incrementing = false;

	protected $casts = [
		'client_uuid' => 'uuid',
		'telegram_chat_id' => 'int',
		'phone' => 'int'
	];

	protected $fillable = [
		'client_uuid',
		'telegram_chat_id',
		'name',
		'email',
		'phone'
	];
}
