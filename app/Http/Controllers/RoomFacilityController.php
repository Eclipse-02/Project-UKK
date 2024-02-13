<?php

namespace App\Http\Controllers;

use App\Models\RoomFacility;
use App\Http\Controllers\Controller;
use App\DataTables\RoomFacilityDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoomFacilityDataTable $dataTable)
    {
        return $dataTable->render('scaffolds.facilities.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('scaffolds.facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            RoomFacility::create([
                'name' => $request->name,
                'desc' => $request->desc,
            ]);

            toastr()->success('Data Saved Successfully!', 'Success!');
            return redirect()->route('facilities.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomFacility $facility)
    {
        $data = $facility;

        return view('scaffolds.facilities.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomFacility $facility)
    {
        $data = $facility;

        return view('scaffolds.facilities.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomFacility $facility)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $facility->update([
                'name' => $request->name,
                'desc' => $request->desc,
            ]);

            toastr()->success('Data Updated Successfully!', 'Success!');
            return redirect()->route('facilities.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomFacility $facility)
    {
        $facility->delete();

        toastr()->success('Data Successfully Deleted!', 'Success!');
        return redirect()->route('facilities.index');
    }
}
