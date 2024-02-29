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
use Carbon\Carbon;

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
            'type_id' => 'required',
            'total_rooms' => 'required',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
        ]);

        $rooms = Room::where([
            ['type_id', '=', $request->type_id],
            ['status', '=', 'AV'],
        ])
        ->inRandomOrder()
        ->get();

        if ($rooms->count() <= $request->total_rooms) {
            toastr()->error('We don`t have enough rooms!', 'Sorry!');
            return redirect()->back()->withErrors(['rooms' => 'Not enough rooms!'])->withInput();
        }

        $user = auth()->user();

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            for ($i=0; $i < $request->total_rooms; $i++) { 

                RoomRegistration::create([
                    'room_id' => $rooms[$i]->id,
                    'type_id' => $request->type_id,
                    'add_on_id' => $request->add_on_id,
                    'user_id' => $user->id,
                    'checkin' => Carbon::parse($request->checkin)->format('Y-m-d H:i:s'),
                    'checkout' => Carbon::parse($request->checkout)->format('Y-m-d H:i:s'),
                    'status' => 'BK',
                ]);

                Room::where('id', $rooms[$i]->id)->update([
                    'status' => 'BK'
                ]);

                event(new LogEvent($user->name, $rooms[$i]->room_number, 'BK'));
            }

            toastr()->success('Data Saved Successfully!', 'Success!');
            return redirect()->route('welcome');
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
        $data = RoomRegistration::with('user', 'room', 'type')->where('id', $reg)->first();
        // $rooms = Room::all();
        // $types = RoomType::all();
        // $addons = RoomAddOn::all();

        return view('scaffolds.registrations.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomRegistration $reg)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        // $dates = explode(' - ', $request->duration);

        $user = User::where('id', $request->user_id)->first();
        $room = Room::where('id', $request->room_id)->first();

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $reg->update([
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
