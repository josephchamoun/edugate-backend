<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterMaterial extends Model
{
    protected $fillable = [
        'chapter_id', 'title', 'description',
        'file_path', 'file_type', 'file_size'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}