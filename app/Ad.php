<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $perPage = 5;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'user_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', false);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', false);
    }
}