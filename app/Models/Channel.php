<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'visibility',
        'company_id',
    ];


    function scopeActiveChannels($query)
    {
        return $query->where('visibility', 1);
    }

    function scopeArchivedChannel($query)
    {
        return $query->onlyTrashed();
    }

    function users()
    {
        return $this->belongsToMany(User::class);
    }
}
