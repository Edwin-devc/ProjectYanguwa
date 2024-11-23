<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Service extends Model
{
    protected $fillable = [
        'name', 'description', 'category', 'available'
    ];

    public function serviceProviders(){
        return $this->belongsToMany(ServiceProvider::class, 'service_provider_service', 'service_id', 'service_provider_id')
            ->withTimestamps();
    }
}
