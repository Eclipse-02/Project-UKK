<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\DataTables\RoomDataTable;
use App\Http\Controllers\Controller;
use App\Models\RoomFacility;
use App\Models\RoomType;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoomDataTable $dataTable)
    {
        return $dataTable->render('scaffolds.rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facilities = RoomFacility::all();
        $types = RoomType::all();

        return view('scaffolds.rooms.create', compact('facilities', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_type' => 'required',
            'room_number' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            Room::create([
                'type_id' => $request->room_type,
                'room_number' => $request->room_number,
                'facility' => $request->facility ?? null,
                'status' => 'AV',
            ]);

            toastr()->success('Data Saved Successfully!', 'Success!');
            return redirect()->route('rooms.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($room)
    {
        $data = Room::with('type')->where('id', $room)->first();

        return view('scaffolds.rooms.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $data = $room;
        $facilities = RoomFacility::all();
        $types = RoomType::all();

        // dd($data);

        return view('scaffolds.rooms.edit', compact('data', 'facilities', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validator = Validator::make($request->all(), [
            'room_type' => 'required',
            'room_number' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $room->update([
                'type_id' => $request->room_type,
                'room_number' => $request->room_number,
                // 'facility' => $request->facility ?? null,
                'status' => 'AV',
            ]);

            toastr()->success('Data Updated Successfully!', 'Success!');
            return redirect()->route('rooms.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();

        toastr()->success('Data Successfully Deleted!', 'Success!');
        return redirect()->route('rooms.index');
    }
}
