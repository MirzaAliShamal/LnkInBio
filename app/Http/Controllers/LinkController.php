<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Link;

class LinkController extends Controller
{
    public function links()
    {
        $user = auth()->user();
        $links = Link::where('user_id', $user->id)->orderBy('position', 'DESC')->get();

        return view('dashboard.links', get_defined_vars());
    }

    public function new(Request $req)
    {
        if ($req->ajax()) {
            $user = auth()->user();
            $serial = $req->serial;

            $link = new Link();
            $link->user_id = $user->id;
            $link->position = $serial;
            $link->save();

            return response()->json([
                'statusCode' => 200,
                'html' => view('ajax.new_link', get_defined_vars())->render(),
            ]);
        } else {
            abort(404);
        }
    }

    public function save(Request $req)
    {
        $link = Link::find($req->id);
        if ($req->title) {
            $link->title = $req->title;
        }
        if ($req->link) {
            $link->link = $req->link;
        }
        if ($req->position) {
            $link->position = $req->position;
        }
        $link->save();

        return response()->json([
            'statusCode' => 200,
            'message' => $link,
        ]);
    }
}
