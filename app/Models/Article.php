<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'disaster_category_id',
        'title',
        'slug',
        'view',
        'content',
        'cover_image',
        'status',
        'published_at'
    ];
    // relasi ke user
    public function category()
    {
        return $this->belongsTo(DisasterCategory::class, 'disaster_category_id');
    }

    // relasi ke bencana
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // komentar artikel
    public function comments()
    {
        return $this->hasMany(ArticleComment::class);
    }
    // histori aprove
    public function approvals() {}

    // helper status rtikel
    public function isPublished() {}
}
