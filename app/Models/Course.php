<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'age_group',
        'created_at',
        'updated_at',
    ];


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function registerusers()
    {
        return $this->belongsToMany(Register::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
