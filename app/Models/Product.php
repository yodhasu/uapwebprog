<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'product_id';
    public $incrementing = true; // Ensure it's auto-incrementing
    protected $keyType = 'int';  // Specify the key type

    protected $fillable = ['name', 'category', 'description', 'price', 'image'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
