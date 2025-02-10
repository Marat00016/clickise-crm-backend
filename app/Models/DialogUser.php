<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DialogUser
 *
 * @property uuid $dialog_uuid
 * @property int $user_id
 *
 * @property Dialog $dialog
 * @property User $user
 *
 * @package App\Models
 */
class DialogUser extends Model
{
	protected $table = 'dialogs_users';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'dialog_uuid' => 'string',
		'user_id' => 'int'
	];

    protected $fillable = [
        'dialog_uuid',
        'user_id'
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
