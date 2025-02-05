<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DialogsUser
 *
 * @property uuid $dialog_uuid
 * @property int $user_id
 *
 * @package App\Models
 */
class DialogsUser extends Model
{
    use HasUuids;

	protected $table = 'dialogs_users';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'dialog_uuid' => 'uuid',
		'user_id' => 'int'
	];
}
