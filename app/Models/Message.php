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
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Dialog $dialog
 * @property Contact $contact
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
        'dialog_uuid' => 'string',
		'contact_uuid' => 'string',
	];

	protected $fillable = [
		'dialog_uuid',
		'contact_uuid',
		'text'
	];

	public function dialog()
	{
		return $this->belongsTo(Dialog::class, 'dialog_uuid');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'contact_uuid');
	}
}
