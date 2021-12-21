<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppearenceController extends Controller
{
    public function appearence($page = null)
    {
        $profile = profile();

        if (is_null($page)) {
            return view('dashboard.appearence.themes', get_defined_vars());
        } else if ($page == "themes") {
            return view('dashboard.appearence.themes', get_defined_vars());
        } else if ($page == "backgrounds") {
            return view('dashboard.appearence.backgrounds', get_defined_vars());
        } else if ($page == "buttons") {
            return view('dashboard.appearence.buttons', get_defined_vars());
        }
    }
}
