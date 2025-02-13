<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 *
 * @property string $uuid
 * @property string $dialog_uuid
 * @property string $contact_uuid
 * @property int|null $user_id
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Dialog $dialog
 * @property Contact|null $contact
 * @property User|null $user
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
		'uuid' => 'string',
		'dialog_uuid' => 'string',
		'contact_uuid' => 'string',
		'user_id' => 'int'
	];

	protected $fillable = [
		'dialog_uuid',
		'contact_uuid',
		'user_id',
		'text'
	];

	public function dialogs()
	{
		return $this->belongsTo(Dialog::class, 'dialog_uuid');
	}

	public function contacts()
	{
		return $this->belongsTo(Contact::class, 'contact_uuid');
	}

	public function users()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
