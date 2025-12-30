<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    // relasi artikel
    protected $fillable = [
        'article_id',
        'user_id',
        'name',
        'email',
        'comment',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // relasi user (nullable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
