<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'admin_id', 'academic_year_id', 'title',
        'category', 'start_date', 'end_date',
        'publish_at', 'description', 'attachment',
        'image_url', 'targeted_audience'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}