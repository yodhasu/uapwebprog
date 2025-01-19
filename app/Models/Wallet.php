<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'address', 'balance', 'points'];

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
