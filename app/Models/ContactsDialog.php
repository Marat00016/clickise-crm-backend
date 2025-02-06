<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactsDialog
 *
 * @property uuid $contact_uuid
 * @property uuid $dialog_uuid
 *
 * @property Contact $contact
 * @property Dialog $dialog
 *
 * @package App\Models
 */
class ContactsDialog extends Model
{
	protected $table = 'contacts_dialogs';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'contact_uuid' => 'uuid',
		'dialog_uuid' => 'uuid'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'contact_uuid');
	}

	public function dialog()
	{
		return $this->belongsTo(Dialog::class, 'dialog_uuid');
	}
}
