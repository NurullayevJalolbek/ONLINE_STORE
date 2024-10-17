<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{

    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'parent_id'
    ];
    public  function  products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);

    }

    public function subcategories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->products()->delete();
        });
    }



}
