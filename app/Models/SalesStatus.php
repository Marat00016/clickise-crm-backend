<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SalesStatus
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @property Collection|Contact[] $contacts
 *
 * @package App\Models
 */
class SalesStatus extends Model
{
	protected $table = 'sales_statuses';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'slug'
	];

	public function contacts()
	{
		return $this->hasMany(Contact::class);
	}
}
