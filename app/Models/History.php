<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class History extends Model
{
    protected $table = 'history';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'method',
        'url',
        'request_data',
        'ip_address',
        'user_agent',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
