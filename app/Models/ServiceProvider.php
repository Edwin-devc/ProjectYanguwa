<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceProviderWelcomeMail;
use App\Models\User;

class ServiceProvider extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'verified',
        'price',
        'profile_picture'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_provider_service', 'service_provider_id', 'service_id');
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($serviceProvider) {
            // Generate a random password
            $password = str()->random(10);

            // Create a user for the service provider
            $user = User::create([
                'name' => $serviceProvider->name,
                'email' => $serviceProvider->email,
                'password' => Hash::make($password), // Hash the password before saving
            ]);

            $user->assignRole('service_provider');

            // Send the password to the service provider via email
            Mail::to($user->email)->send(new ServiceProviderWelcomeMail($user, $password));
        });
    }
}
