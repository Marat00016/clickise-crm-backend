<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 *
 * @property uuid $uuid
 * @property string $name
 * @property string|null $email
 * @property int|null $phone
 * @property int $inn
 * @property int|null $ogrn
 * @property int|null $kpp
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Contact[] $contacts
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

	public function contacts()
	{
		return $this->hasMany(Contact::class, 'client_uuid');
	}
}
