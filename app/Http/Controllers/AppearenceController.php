<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppearenceController extends Controller
{
    public function appearence()
    {
        return view('dashboard.appearence', get_defined_vars());
    }
}
