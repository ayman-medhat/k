<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactDocument extends Model
{
    protected $fillable = [
        'contact_id', 'file_path', 'file_name', 'file_type', 'notes',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
