<?php

namespace App\Http\Controllers;

use App\Services\ExtractFileDetailsService;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * This is a method named "__invoke" in a class.
     * It takes an instance of the "ExtractFileDetailsService" class as a parameter.
     * The method returns the result of calling the "get_files_and_details" method on the "ExtractFileDetailsService" instance.
     * The result is then passed as a value for the "files" key in an array that is used as data for rendering an Inertia view named "Dashboard/Index".
     */
    public function __invoke(ExtractFileDetailsService $extractFileDetailsService): \Inertia\Response
    {
        return Inertia::render('Dashboard/Index', [
            'files' => $extractFileDetailsService->get_files_and_details()
        ]);
    }
}
