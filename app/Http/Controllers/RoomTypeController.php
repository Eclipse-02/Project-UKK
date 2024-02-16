<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\RoomTypeDataTable;
use Illuminate\Support\Facades\Validator;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoomTypeDataTable $dataTable)
    {
        return $dataTable->render('scaffolds.types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scaffolds.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'bed_qty' => 'required',
            'bed_type' => 'required',
        ]);

        $price = str_replace('Rp. ', '', $request->price);
        $price = str_replace('_', '', $price);
        $price = str_replace('.', '', $price);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            RoomType::create([
                'name' => $request->name,
                'price' => $price,
                'bed_qty' => $request->bed_qty,
                'bed_type' => $request->bed_type,
            ]);

            toastr()->success('Data Saved Successfully!', 'Success!');
            return redirect()->route('types.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $type)
    {
        $data = $type;

        return view('scaffolds.types.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $type)
    {
        $data = $type;

        return view('scaffolds.types.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $type)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'bed_qty' => 'required',
            'bed_type' => 'required',
        ]);

        $discount = str_replace('% ', '', $request->discount);
        $discount = str_replace('_', '', $discount);

        $dates = explode(' - ', $request->duration);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $type->update([
                'name' => $request->name,
                'price' => $request->price,
                'bed_qty' => $request->bed_qty,
                'bed_type' => $request->bed_type,
            ]);

            toastr()->success('Data Updated Successfully!', 'Success!');
            return redirect()->route('types.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $type)
    {
        $type->delete();

        toastr()->success('Data Successfully Deleted!', 'Success!');
        return redirect()->route('types.index');
    }
}
