<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SupportStatus
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $space_id
 *
 * @property Collection|Contact[] $contacts
 *
 * @package App\Models
 */
class SupportStatus extends Model
{
	protected $table = 'support_statuses';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'slug',
		'space_id'
	];

	public function contacts()
	{
		return $this->hasMany(Contact::class);
	}

    public function spaces()
    {
        return $this->belongsTo(Space::class, 'space_id');
    }
}
