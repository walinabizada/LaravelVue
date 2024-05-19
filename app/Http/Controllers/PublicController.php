<?php

namespace App\Http\Controllers;

use App\Models\Kbm;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Request::all('search'));
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'filters' => Request::all('search'),
            'kbms' => Kbm::query() // Start a new query builder instance
                ->orderBy('created_at', 'desc') // Chain orderBy on the query
                ->filter(Request::only('search')) // Apply filter
                ->paginate(10) // Paginate the results
                ->withQueryString() // Keep the query string
                ->through(function ($kbm) { // Map the results
                    return [
                        'id' => $kbm->id,
                        'service_name' => $kbm->service_name,
                        'implementation_side' => $kbm->implementation_side,
                        'time_frame' => $kbm->time_frame,
                        'needed_document' => $kbm->needed_document,
                        'fees' => $kbm->fees,
                        'legal_document' => $kbm->legal_document,
                        'implementation_procedures' => $kbm->implementation_procedures,
                        'course_of_action' => $kbm->course_of_action,
                        'updated_at' => $kbm->updated_at,
                        'created_at' => $kbm->created_at,
                    ];
                }),
        ]);
    }
}
