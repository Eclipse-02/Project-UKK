<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromotionCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\DataTables\PromotionCodeDataTable;
use Carbon\Carbon;

class PromotionCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PromotionCodeDataTable $dataTable)
    {
        return $dataTable->render('scaffolds.codes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scaffolds.codes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_name' => 'required',
            'discount' => 'required',
            'duration' => 'required',
        ]);

        $discount = str_replace('% ', '', $request->discount);
        $discount = str_replace('_', '', $discount);

        $dates = explode(' - ', $request->duration);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            PromotionCode::create([
                'code_name' => $request->code_name,
                'discount' => $discount,
                'begin_at' => Carbon::parse($dates[0]),
                'end_at' => Carbon::parse($dates[1]),
            ]);

            toastr()->success('Data Saved Successfully!', 'Success!');
            return redirect()->route('codes.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PromotionCode $code)
    {
        $data = $code;

        return view('scaffolds.codes.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PromotionCode $code)
    {
        $data = $code;

        return view('scaffolds.codes.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PromotionCode $code)
    {
        $validator = Validator::make($request->all(), [
            'code_name' => 'required',
            'discount' => 'required',
            'duration' => 'required',
        ]);

        $discount = str_replace('% ', '', $request->discount);
        $discount = str_replace('_', '', $discount);

        $dates = explode(' - ', $request->duration);

        if ($validator->fails()) {
            toastr()->error('Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $code->update([
                'code_name' => $request->code_name,
                'discount' => $discount,
                'begin_at' => Carbon::parse($dates[0]),
                'end_at' => Carbon::parse($dates[1]),
            ]);

            toastr()->success('Data Updated Successfully!', 'Success!');
            return redirect()->route('codes.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PromotionCode $code)
    {
        $code->delete();

        toastr()->success('Data Successfully Deleted!', 'Success!');
        return redirect()->route('codes.index');
    }
}
