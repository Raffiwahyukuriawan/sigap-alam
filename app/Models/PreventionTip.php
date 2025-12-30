<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreventionTip extends Model
{
    // relasi ke jenis bencana
    protected $fillable = [
        'disaster_category_id',
        'title',
        'content',
    ];

    public function category()
    {
        return $this->belongsTo(DisasterCategory::class, 'disaster_category_id');
    }
}
