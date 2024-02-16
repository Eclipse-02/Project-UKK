<?php

namespace App\Http\Controllers;

use App\DataTables\RoomRegistrationDataTable;
use App\Models\RoomRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoomRegistrationDataTable $dataTable)
    {
        return $dataTable->render('scaffolds.registrations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scaffolds.registrations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomRegistration $roomRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomRegistration $roomRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomRegistration $roomRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomRegistration $roomRegistration)
    {
        //
    }
}
