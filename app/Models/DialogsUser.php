<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DialogsUser
 *
 * @property uuid $dialog_uuid
 * @property int $user_id
 *
 * @property Dialog $dialog
 * @property User $user
 *
 * @package App\Models
 */
class DialogsUser extends Model
{
	protected $table = 'dialogs_users';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'dialog_uuid' => 'uuid',
		'user_id' => 'int'
	];

	public function dialog()
	{
		return $this->belongsTo(Dialog::class, 'dialog_uuid');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
