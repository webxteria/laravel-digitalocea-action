<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFiles extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'file_path',
        'file_ext',
        'file_name'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
