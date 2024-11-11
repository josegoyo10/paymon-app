<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    // Generar slug automáticamente al crear una categoría
    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
}
