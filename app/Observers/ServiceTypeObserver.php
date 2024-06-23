<?php

namespace App\Observers;

use App\Models\ServiceType;
use Illuminate\Support\Facades\Storage;

class ServiceTypeObserver
{
    /**
     * Handle the ServiceType "created" event.
     */
    public function created(ServiceType $serviceType): void
    {
        //
    }

    /**
     * Handle the ServiceType "saved" event.
     */
    public function saved(ServiceType $serviceType): void
    {
        if ($serviceType->isDirty('logo_url')) {
            Storage::disk('public')->delete($serviceType->getOriginal('logo_url'));
        }
    }

    /**
     * Handle the ServiceType "updated" event.
     */
    public function updated(ServiceType $serviceType): void
    {
        //
    }

    /**
     * Handle the ServiceType "deleted" event.
     */
    public function deleted(ServiceType $serviceType): void
    {
        if (!is_null($serviceType->logo_url)) {
            Storage::disk('public')->delete($serviceType->logo_url);
        }
    }

    /**
     * Handle the ServiceType "restored" event.
     */
    public function restored(ServiceType $serviceType): void
    {
        //
    }

    /**
     * Handle the ServiceType "force deleted" event.
     */
    public function forceDeleted(ServiceType $serviceType): void
    {
        //
    }
}
