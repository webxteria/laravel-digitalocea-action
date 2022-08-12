<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_url',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function image()
    {
        return $this->morphOne(MediaFiles::class, 'imageable');
    }

    public function channels()
    {
        return $this->hasMany(Channel::class, 'company_id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'company_id');
    }
}
