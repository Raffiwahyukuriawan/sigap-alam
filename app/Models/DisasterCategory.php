<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisasterCategory extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'description'
    ];

    public function getGradientClassAttribute()
    {
        return match ($this->name) {

            // 🌊 Hidrometeorologi
            'Banjir'                => 'gradient-blue',
            'Banjir Bandang'        => 'gradient-blue',
            'Rob'                   => 'gradient-blue',
            'Kekeringan'            => 'gradient-yellow',
            'Hujan Ekstrem'         => 'gradient-cyan',
            'Angin Puting Beliung'  => 'gradient-gray',
            'Badai'                 => 'gradient-gray',
            'Gelombang Tinggi'      => 'gradient-cyan',

            // 🌍 Geologi
            'Gempa Bumi'            => 'gradient-orange',
            'Tsunami'               => 'gradient-cyan',
            'Letusan Gunung Api'    => 'gradient-red',
            'Gunung Meletus'        => 'gradient-red',
            'Tanah Longsor'         => 'gradient-yellow',

            // 🔥 Kebakaran
            'Kebakaran Hutan'       => 'gradient-red',
            'Kebakaran Lahan'       => 'gradient-red',

            // 🌫 Lingkungan
            'Kabut Asap'            => 'gradient-gray',
            'Abrasi'                => 'gradient-blue',

            // ☣️ Lainnya (opsional)
            'Wabah Penyakit'        => 'gradient-purple',
            'Gagal Teknologi'       => 'gradient-black',
            'Bencana Sosial'        => 'gradient-black',

            default                 => 'gradient-green',
        };
    }

    // artikel berdasarkan bencana
    public function articles()
    {
        return $this->hasMany(Article::class, 'id');
    }

    // tips pencegahan per bencana
    public function preventionTips() {}
}
