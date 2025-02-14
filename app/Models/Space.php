<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Space
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @property Collection|Bot[] $bots
 *
 * @package App\Models
 */
class Space extends Model
{
	protected $table = 'spaces';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'slug'
	];

	public function bots()
	{
		return $this->hasMany(Bot::class, 'space_id', 'id');
	}

    public function users()
    {
        return $this->hasMany(User::class, 'space_id', 'id');
    }

    public function salesStatuses()
    {
        return $this->hasMany(SalesStatus::class, 'space_id', 'id');
    }

    public function supportStatuses()
    {
        return $this->hasMany(SupportStatus::class, 'space_id', 'id');
    }
}
