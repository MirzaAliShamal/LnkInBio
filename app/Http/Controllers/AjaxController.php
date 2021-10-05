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

    public function deleteBox(Request $req){
        if ($req->ajax()) {
            return response()->json([
                'statusCode' => 200,
                'html' => view('ajax.delete_link', get_defined_vars())->render(),
            ]);
        } else {
            abort(404);
        }
    }

    public function addThumbnailBox(Request $req){
        if ($req->ajax()) {
            return response()->json([
                'statusCode' => 200,
                'html' => view('ajax.add_thumbnail', get_defined_vars())->render(),
            ]);
        } else {
            abort(404);
        }
    }

    public function leapLinkBox(Request $req){
        if ($req->ajax()) {
            return response()->json([
                'statusCode' => 200,
                'html' => view('ajax.leap_link', get_defined_vars())->render(),
            ]);
        } else {
            abort(404);
        }
    }

    public function linkAnalyticsBox(Request $req){
        if ($req->ajax()) {
            return response()->json([
                'statusCode' => 200,
                'html' => view('ajax.link_analytics', get_defined_vars())->render(),
            ]);
        } else {
            abort(404);
        }
    }

    public function priorityLinkBox(Request $req){
        if ($req->ajax()) {
            return response()->json([
                'statusCode' => 200,
                'html' => view('ajax.priority_link', get_defined_vars())->render(),
            ]);
        } else {
            abort(404);
        }
    }

    public function scheduleLinkBox(Request $req){
        if ($req->ajax()) {
            return response()->json([
                'statusCode' => 200,
                'html' => view('ajax.schedule_link', get_defined_vars())->render(),
            ]);
        } else {
            abort(404);
        }
    }

    public function deleteLink(Request $req, $id = null){
        if($req->ajax()){
            $result = Link::where('id', $id)->delete();
            return response()->json([
                'statusCode' => 200,
                'id' => $id,
                'html' => $result,
            ]);
        } else {
            abort(404);
        }
    }
}
