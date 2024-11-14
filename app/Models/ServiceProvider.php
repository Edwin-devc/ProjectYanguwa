<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'bio', 'verified', 'profile_picture'
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
