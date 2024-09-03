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
use App\Models\PromotionCode;
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

        $registrations = RoomRegistration::whereDate('checkin', '>=', $request->checkin)
                         ->whereDate('checkout', '<=', $request->checkout)
                         ->first();

        $promotion = PromotionCode::where('code_name', $request->promotion_code)->first();

        $check_promotion = $promotion->whereDate('begin_at', '>=', Carbon::now())
                                     ->whereDate('end_at', '<=', Carbon::now())
                                     ->first();

        if (!$check_promotion) {
            toastr()->error('This code promotion is invalid!', 'Sorry!');
            return redirect()->back()->withErrors(['rooms' => 'Code is invalid!'])->withInput();
        }

        if ($registrations) {
            toastr()->error('The room is already booked!', 'Sorry!');
            return redirect()->back()->withErrors(['rooms' => 'Room is already booked!'])->withInput();
        }

        if ($rooms->count() < $request->total_rooms) {
            toastr()->error('We don`t have enough rooms!', 'Sorry!');
            return redirect()->back()->withErrors(['rooms' => 'Not enough rooms!'])->withInput();
        }

        $user = auth()->user();

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            for ($i=0; $i < $request->total_rooms; $i++) { 

                Room::where('id', $rooms[$i]->id)->update([
                    'status' => 'BK'
                ]);

                $room_ids[] = $rooms[$i]->id;
                event(new LogEvent($user->name, $rooms[$i]->room_number, 'BK'));
            }

            // dd($room_ids);

            RoomRegistration::create([
                'room_id' => $room_ids,
                'type_id' => $request->type_id,
                'add_on_id' => $request->add_on_id,
                'user_id' => $user->id,
                'for_another' => $request->for_another ?? null,
                'for_another' => $request->promotion_code ?? null,
                'checkin' => Carbon::parse($request->checkin)->format('Y-m-d H:i:s'),
                'checkout' => Carbon::parse($request->checkout)->format('Y-m-d H:i:s'),
                'status' => 'BK',
            ]);

            toastr()->success('Data Saved Successfully!', 'Success!');
            return redirect()->route('welcome');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($reg)
    {
        $data = RoomRegistration::where('id', $reg)->with(['type', 'addOn', 'user'])->first();
        foreach ($data->room_id as $value) {
            $room = Room::where('id', $value)->first();

            $room_num[] = $room->room_number;
        }

        return view('scaffolds.registrations.view', compact('data', 'room_num'));
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

    public function invoice(RoomRegistration $reg)
    {
        $data = $reg;
        $discount = PromotionCode::where('code_name', $data->promotion_code)->first();
        if ($data->addons) {
            foreach ($data->addons as $i) {
                $addons[] = RoomAddOn::where('id', $i)->first();
            }
        } else {
            $addons = [];
        }

        foreach ($addons as $i) {
            $addons_price =+ $i->price;
        }

        $total_price = $addons_price + ($data->type->price * count($data->room_id));

        if ($discount) {
            $total_price = $total_price * 10 / 100;
        }

        return view('scaffolds.registrations.invoice', compact('data', 'addons', 'total_price'));
    }
}
