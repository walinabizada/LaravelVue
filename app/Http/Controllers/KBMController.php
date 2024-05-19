<?php

namespace App\Http\Controllers;

use App\Models\Kbm;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class KBMController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Request::all('search'));
        return Inertia::render('Kbm/List', [
            'title' => 'Knowledge Base Managements',
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Kbm/Create', [
            'title' => 'Create a new knowledge base',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Kbm::create(
            Request::validate([
                'service_name' => ['required', 'max:255'],
                'implementation_side' => [],
                'time_frame' => [],
                'needed_document' => [],
                'fees' => [],
                'legal_document' => [],
                'implementation_procedures' => [],
                'course_of_action' => []
            ])
        );

        return Redirect::route('dashboard.kbm.index')->with('success', 'Knowledge base created.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kbm $kbm, string $id)
    {
        // dd($id);
        $kbm = Kbm::where('id', $id)->first();
        // dd($kbm);
        return Inertia::render('Kbm/Edit', [
            'title' => $kbm->title,
            'kbm' => [
                'id' => $kbm->id,
                'service_name' => $kbm->service_name,
                'implementation_side' => $kbm->implementation_side,
                'time_frame' => $kbm->time_frame,
                'needed_document' => $kbm->needed_document,
                'fees' => $kbm->fees,
                'legal_document' => $kbm->legal_document,
                'implementation_procedures' => $kbm->implementation_procedures,
                'course_of_action' => $kbm->course_of_action,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Kbm $kbm, string $id)
    {
        $kbm = Kbm::where('id', $id)->first();
        // dd($kbm);
        $kbm->update(
            Request::validate([
                'service_name' => ['required', 'max:255'],
                'implementation_side' => [],
                'time_frame' => [],
                'needed_document' => [],
                'fees' => [],
                'legal_document' => [],
                'implementation_procedures' => [],
                'course_of_action' => []
            ])
        );

        return Redirect::route('dashboard.kbm.index')->with('success', 'Knowledge base updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $kbm = Kbm::where('id', $id)->first();
        $kbm->delete();
        return Redirect::route('dashboard.kbm.index')->with('success', 'Knowledge base deleted.');
    }
}
