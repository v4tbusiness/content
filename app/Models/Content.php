<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /** @use HasFactory<\Database\Factories\ContentFactory> */
    use HasFactory;

    protected $fillable = ['package_id', 'title', 'slug', 'content_type', 'source_type', 'source', 'thumbnail', 'is_premium'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
