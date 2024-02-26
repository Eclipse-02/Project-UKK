<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomRegistration;
use App\Models\Room;
use App\Models\User;
use App\Models\RoomAddOn;
use App\Models\RoomType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\DataTables\RoomRegistrationDataTable;
use App\Events\LogEvent;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
            'type_id' => 'required',
            'addons' => 'required',
            'user_id' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
        ]);

        $dates = explode(' - ', $request->duration);

        $user = User::where('id', $request->user_id)->first();
        $room = Room::where('id', $request->room_id)->first();

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            RoomRegistration::create([
                'room_id' => $request->room_id,
                'type_id' => $request->type_id,
                'add_on_id' => $request->add_on_id,
                'user_id' => $request->user_id,
                'checkin' => $dates[0],
                'checkout' => $dates[0],
                'status' => $request->status,
            ]);

            event(new LogEvent($user->name, $room->room_number, $request->status));

            toastr()->success('Data Saved Successfully!', 'Success!');
            return redirect()->route('registrations.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($reg)
    {
        $data = RoomRegistration::where('id', $reg)->with(['room', 'type', 'addOn', 'user'])->first();

        return view('scaffolds.registrations.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($reg)
    {
        $data = RoomRegistration::with('user')->where('id', $reg)->get();
        $rooms = Room::all();
        $types = RoomType::all();
        $addons = RoomAddOn::all();

        return view('scaffolds.registrations.edit', compact('data', 'rooms', 'types', 'addons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomRegistration $reg)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        $dates = explode(' - ', $request->duration);

        $user = User::where('id', $request->user_id)->first();
        $room = Room::where('id', $request->room_id)->first();

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $reg->update([
                'room_id' => $request->room_id,
                'type_id' => $request->type_id,
                'add_on_id' => $request->add_on_id,
                'user_id' => $request->user_id,
                'checkin' => $dates[0],
                'checkout' => $dates[0],
                'status' => $request->status,
            ]);

            event(new LogEvent($user->name, $room->room_number, $request->status));

            toastr()->success('Data Updated Successfully!', 'Success!');
            return redirect()->route('facilities.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomRegistration $reg)
    {
        //
    }
}
