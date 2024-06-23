<?php

namespace App\Observers;

use App\Models\PrimaryClass;
use Illuminate\Support\Facades\Storage;

class PrimaryClassObserver
{
    /**
     * Handle the PrimaryClass "created" event.
     */
    public function created(PrimaryClass $primaryClass): void
    {
        //
    }

    /**
     * Handle the PrimaryClass "saved" event.
     */
    public function saved(PrimaryClass $primaryClass): void
    {
        if ($primaryClass->isDirty('logo_url')) {
            // dd($primaryClass->getOriginal('logo_url'));
            Storage::disk('public')->delete($primaryClass->getOriginal('logo_url'));
        }
    }

    /**
     * Handle the PrimaryClass "updated" event.
     */
    public function updated(PrimaryClass $primaryClass): void
    {
        //
    }

    /**
     * Handle the PrimaryClass "deleted" event.
     */
    public function deleted(PrimaryClass $primaryClass): void
    {
        if (!is_null($primaryClass->logo_url)) {
            Storage::disk('public')->delete($primaryClass->logo_url);
        }
    }

    /**
     * Handle the PrimaryClass "restored" event.
     */
    public function restored(PrimaryClass $primaryClass): void
    {
        //
    }

    /**
     * Handle the PrimaryClass "force deleted" event.
     */
    public function forceDeleted(PrimaryClass $primaryClass): void
    {
        //
    }
}
