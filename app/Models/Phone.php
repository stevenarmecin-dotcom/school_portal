<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['user_phone_id', 'phone_number'];

    public function userPhone(): BelongsTo
    {
        return $this->belongsTo(UserPhone::class, 'user_phone_id');
    }
}