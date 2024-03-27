<?php

namespace App\Http\Controllers\HttpError;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BadRequestController extends Controller
{
    public static function show(): Response
    {
        return Inertia::render('Error/404Error');
    }
}
