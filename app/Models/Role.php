<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'slug'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'role_id');
	}
}
