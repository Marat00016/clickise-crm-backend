<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactsDialog
 *
 * @property uuid $contact_uuid
 * @property uuid $dialog_uuid
 *
 * @package App\Models
 */
class ContactsDialog extends Model
{
    use HasUuids;

	protected $table = 'contacts_dialogs';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'contact_uuid' => 'uuid',
		'dialog_uuid' => 'uuid'
	];
}
