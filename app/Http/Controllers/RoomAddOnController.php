<?php

namespace App\Http\Controllers;

use App\Models\RoomAddOn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\RoomAddOnDataTable;
use Illuminate\Support\Facades\Validator;

class RoomAddOnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoomAddOnDataTable $dataTable)
    {
        return $dataTable->render('scaffolds.addOns.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scaffolds.addOns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);

        $price = str_replace('Rp. ', '', $request->price);
        $price = str_replace('_', '', $price);
        $price = str_replace('.', '', $price);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            RoomAddOn::create([
                'name' => $request->name,
                'price' => $price,
            ]);

            toastr()->success('Data Saved Successfully!', 'Success!');
            return redirect()->route('addOns.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomAddOn $addOn)
    {
        $data = $addOn;

        return view('scaffolds.addOns.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomAddOn $addOn)
    {
        $data = $addOn;

        return view('scaffolds.addOns.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomAddOn $addOn)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);

        $price = str_replace('Rp. ', '', $request->price);
        $price = str_replace('_', '', $price);
        $price = str_replace('.', '', $price);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $addOn->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);

            toastr()->success('Data Updated Successfully!', 'Success!');
            return redirect()->route('addOns.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomAddOn $addOn)
    {
        $addOn->delete();

        toastr()->success('Data Successfully Deleted!', 'Success!');
        return redirect()->route('addOns.index');
    }
}
