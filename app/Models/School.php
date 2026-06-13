<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'nameEn',
        'nameAr',
        'address',
        'phone',
        'email',
        'website',
        'logo',
        'principal_name',
        'mission',
        'vision',
        'social_facebook',
        'social_twitter',
        'social_instagram',
        'social_linkedin',
        'established_year',
    ];

    protected static function booted(): void
    {
        static::creating(function ($school) {
            if (static::count() > 0) {
                return false;
            }
        });
    }
}
