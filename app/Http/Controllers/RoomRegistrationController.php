<?php

namespace App\Http\Controllers;

use App\DataTables\RoomRegistrationDataTable;
use App\Models\RoomRegistration;
use App\Models\Room;
use App\Models\User;
use App\Models\RoomAddOn;
use App\Models\RoomType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
        $rooms = Room::all();
        $roomTypes = RoomType::all();
        $roomAddOns = RoomAddOn::all();
        $users = User::all();

        return view('scaffolds.registrations.create', compact('rooms', 'roomTypes', 'roomAddOns', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
            'type_id' => 'required',
            'add_on_id' => 'required',
            'user_id' => 'required',
            'checkin' => 'required',
            'checkout' => 'required'
        ]);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            RoomRegistration::create([
                'room_id' => $request->room_id,
                'type_id' => $request->type_id,
                'add_on_id' => $request->add_on_id,
                'user_id' => $request->user_id,
                'checkin' => $request->checkin,
                'checkout' => $request->checkout,
            ]);

            toastr()->success('Data Saved Successfully!', 'Success!');
            return redirect()->route('registrations.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($roomRegistration)
    {
        $data = RoomRegistration::with('type')->where('id', $roomRegistration)->first();

        return view('scaffolds.registrations.view');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomRegistration $roomRegistration)
    {
        $data = $roomRegistration;

        return view('scaffolds.registrations.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomRegistration $roomRegistration)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
            'type_id' => 'required',
            'add_on_id' => 'required',
            'user_id' => 'required',
            'checkin' => 'required',
            'checkout' => 'required'
        ]);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $roomRegistration->update([
                'room_id' => $request->room_id,
                'type_id' => $request->type_id,
                'add_on_id' => $request->add_on_id,
                'user_id' => $request->user_id,
                'checkin' => $request->checkin,
                'checkout' => $request->checkout,
            ]);

            toastr()->success('Data Saved Successfully!', 'Success!');
            return redirect()->route('registrations.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomRegistration $roomRegistration)
    {
        $roomRegistration->delete();

        toastr()->success('Data Successfully Deleted!', 'Success!');
        return redirect()->route('registrations.index');
    }
}
