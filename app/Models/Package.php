<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /** @use HasFactory<\Database\Factories\PackageFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'cover', 'price'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
