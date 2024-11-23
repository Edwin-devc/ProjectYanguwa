<?php

namespace App\Filament\Widgets;

use App\Models\Service;
use App\Models\ServiceProvider;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ServiceProviderOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user(); // Get the logged-in user

        if ($user->hasRole('service_provider')) {
            // For service providers, filter stats based on their services
            $servicesCount = Service::whereHas('serviceProviders', function ($query) use ($user) {
                $query->where('service_provider_id', $user->id);
            })->count();

            $availableServicesCount = Service::where('available', true)
                ->whereHas('serviceProviders', function ($query) use ($user) {
                    $query->where('service_provider_id', $user->id);
                })->count();

            return [
                Stat::make('Your Total Services', $servicesCount)
                    ->description('Total number of your services'),

                Stat::make('Your Available Services', $availableServicesCount)
                    ->description('Your services that are currently available'),
            ];
        }

        if ($user->hasRole('super_admin')) {
            // For admins, show stats for the entire project
            return [
                Stat::make('Total Service Providers', ServiceProvider::query()->count()),

                Stat::make('Total Services', Service::query()->count())
                    ->description('Total number of services offered'),

                Stat::make('Available Services', Service::query()->where('available', true)->count())
                    ->description('Services that are currently available'),
            ];
        }

        // Default behavior for other roles: no stats displayed
        return [];
    }
}
