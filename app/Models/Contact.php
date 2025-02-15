<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 *
 * @property string $uuid
 * @property string|null $client_uuid
 * @property int $telegram_chat_id
 * @property string|null $name
 * @property string|null $email
 * @property int|null $phone
 * @property int $sales_status_id
 * @property int $support_status_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Client|null $client
 * @property SalesStatus $sales_status
 * @property SupportStatus $support_status
 * @property Collection|Message[] $messages
 * @property Collection|Dialog[] $dialogs
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
		'client_uuid' => 'string',
		'chat_id' => 'int',
		'phone' => 'int',
		'sales_status_id' => 'int',
		'support_status_id' => 'int'
	];

	protected $fillable = [
		'client_uuid',
		'chat_id',
		'name',
		'email',
		'phone',
		'sales_status_id',
		'support_status_id'
	];

	public function clients()
	{
		return $this->belongsTo(Client::class, 'client_uuid');
	}

	public function salesStatuses()
	{
		return $this->belongsTo(SalesStatus::class, 'sales_status_id', 'id', 'sales_status_id');
	}

	public function supportStatuses()
	{
		return $this->belongsTo(SupportStatus::class, 'support_status_id', 'id', 'support_status_id');
	}

	public function messages()
	{
		return $this->hasMany(Message::class, 'contact_uuid');
	}

	public function dialogs()
	{
		return $this->belongsToMany(Dialog::class, 'dialogs_contacts', 'contact_uuid', 'dialog_uuid');
	}
}
