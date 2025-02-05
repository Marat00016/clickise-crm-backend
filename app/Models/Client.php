<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 *
 * @property uuid $uuid
 * @property string $name
 * @property string $email
 * @property int $phone
 * @property int $inn
 * @property int $ogrn
 * @property int $kpp
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Client extends Model
{
    use HasUuids;

	protected $table = 'clients';
	protected $primaryKey = 'uuid';
	public $incrementing = false;

	protected $casts = [
		'uuid' => 'uuid',
		'phone' => 'int',
		'inn' => 'int',
		'ogrn' => 'int',
		'kpp' => 'int'
	];

	protected $fillable = [
		'name',
		'email',
		'phone',
		'inn',
		'ogrn',
		'kpp'
	];
}
