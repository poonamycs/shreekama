<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialSetting extends Model
{
    protected $table = 'social_settings';
    protected $fillable = [
        'whatsapp', 'sms', 'email','category'
    ];
}
