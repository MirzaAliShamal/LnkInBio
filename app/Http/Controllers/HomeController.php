<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Link;
use Route;

class HomeController extends Controller
{
    public function home(Request $req, $username = null)
    {

        if (is_null($username)) {
            return view('welcome', get_defined_vars());
        } else {
            $user = User::whereUsername($username)->first();
            $links = Link::where('user_id', $user->id)
                ->where('title', '!=',null)
                ->where('link', '!=',null)
                ->where('status', true)
                ->orderBy('position', 'DESC')->get();

            return view('preview', get_defined_vars());
        }

    }
}
