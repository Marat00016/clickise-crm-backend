<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
 * @property Collection|Message[] $messages
 * @property Collection|User[] $users
 * @property Collection|Contact[] $contacts
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
		'chat_id' => 'int'
	];

	protected $fillable = [
		'chat_id'
	];

	public function messages()
	{
		return $this->hasMany(Message::class, 'dialog_uuid');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'dialogs_users', 'dialog_uuid');
	}

	public function contacts()
	{
		return $this->belongsToMany(Contact::class, 'contacts_dialogs', 'dialog_uuid', 'contact_uuid');
	}
}
