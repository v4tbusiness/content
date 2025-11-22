<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_description',
        'logo',
        'currency',
        'currency_symbol',
        'coin_price',
        'email',
        'phone',
        'telegram',
        'whatsapp',
        'main_header',
        'custom_css',
    ];
}
