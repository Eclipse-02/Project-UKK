<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $types = RoomType::all();

        return view('welcome', compact('types'));
    }
}
