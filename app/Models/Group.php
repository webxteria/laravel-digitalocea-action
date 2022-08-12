<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'company_id',
        'visibility'
    ];

    function scopeActiveGroups($query)
    {
        return $query->where('visibility', 1);
    }

    function scopeArchivedGroups($query)
    {
        return $query->onlyTrashed();
    }

    function users()
    {
        return $this->belongsToMany(User::class, 'user_groups');
    }
}
