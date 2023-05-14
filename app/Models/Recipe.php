<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_url',
        'description',
        'prep_time',
        'cooking_time',
        'serving_size',
        'user_id',
        'category_ids'
    ];


    protected function imageUrl(): Attribute {
        return Attribute::make(
            get: fn(string $value) => str_replace('public/', 'storage/', $value)
        );
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
