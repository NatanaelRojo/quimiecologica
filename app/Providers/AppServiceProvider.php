<?php

namespace App\Providers;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('validationErrorResponse', function (MessageBag $validationErrors): JsonResponse {
            $validationErrorMessages = array();

            foreach ($validationErrors->toArray() as $validationError) {
                foreach ($validationError as $message) {
                    array_push($validationErrorMessages, $message);
                }
            }

            return response()->json($validationErrorMessages, 422);
        });
    }
}
