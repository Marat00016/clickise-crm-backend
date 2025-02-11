<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bot
 *
 * @property int $id
 * @property int $space_id
 * @property string $name
 * @property string $slug
 * @property string $token
 *
 * @property Space $space
 * @property Collection|Dialog[] $dialogs
 *
 * @package App\Models
 */
class Bot extends Model
{
	protected $table = 'bots';
	public $timestamps = false;

	protected $casts = [
		'space_id' => 'int'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'space_id',
		'name',
		'slug',
		'token'
	];

	public function spaces()
	{
		return $this->belongsTo(Space::class, 'space_id');
	}

	public function dialogs()
	{
		return $this->hasMany(Dialog::class, 'bot_id');
	}
}
