<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Link;

class AjaxController extends Controller
{
    public function validateUsername(Request $req)
    {
        if ($req->ajax()) {
            $name = $req->name;
            $username = validateUsername($name);

            return response()->json([
                'statusCode' => 200,
                'username' => $username,
            ]);
        } else {
            abort(404);
        }
    }

    public function usernameExists(Request $req)
    {
        if ($req->ajax()) {
            $exists = User::whereUsername($req->name)->exists();

            return response()->json([
                'statusCode' => 200,
                'exists' => $exists,
            ]);
        } else {
            abort(404);
        }
    }

    public function emailExists(Request $req)
    {
        if ($req->ajax()) {
            $exists = User::whereEmail($req->email)->exists();

            return response()->json([
                'statusCode' => 200,
                'exists' => $exists,
            ]);
        } else {
            abort(404);
        }
    }
}
