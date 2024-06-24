<?php

namespace App\Observers;

use App\Models\Gender;
use Illuminate\Support\Facades\Storage;

class GenderObserver
{
    /**
     * Handle the Gender "created" event.
     */
    public function created(Gender $gender): void
    {
        //
    }

    /**
     * Handle the Gender "saved" event.
     */
    public function saved(Gender $gender): void
    {
        //
    }

    /**
     * Handle the Gender "updated" event.
     */
    public function updated(Gender $gender): void
    {
        if ($gender->isDirty('logo_url')) {
            Storage::disk('public')->delete($gender->getOriginal('logo_url'));
        }
    }

    /**
     * Handle the Gender "deleted" event.
     */
    public function deleted(Gender $gender): void
    {
        if (!is_null($gender->logo_url)) {
            Storage::disk('public')->delete($gender->logo_url);
        }
    }

    /**
     * Handle the Gender "restored" event.
     */
    public function restored(Gender $gender): void
    {
        //
    }

    /**
     * Handle the Gender "force deleted" event.
     */
    public function forceDeleted(Gender $gender): void
    {
        //
    }
}
