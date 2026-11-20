<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserPhone extends Model
{
    use HasFactory;

    protected $table = 'user_phones';

    protected $fillable = [
        'name',
    ];

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class, 'user_phone_id');
    }
}
