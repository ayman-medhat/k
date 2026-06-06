<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = [
        'name', 'name_ar', 'level_order', 'description'
    ];

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'grade_stage');
    }
}
