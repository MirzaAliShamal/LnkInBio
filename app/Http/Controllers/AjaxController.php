<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Link;
use File;
use Str;

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

    public function uploadLinkImage(Request $req)
    {
        if ($req->ajax()) {
            $req->validate([
                'id' => 'required',
                'type' => 'required',
            ]);

            $user = auth()->user();
            $link = Link::find($req->id);

            $rand = Str::random(10);

            if ($req->type == "image") {
                $req->validate([
                    'image' => 'required',
                ]);

                $image_parts = explode(";base64,", $req->image);
                $image_type_aux = explode("image/", $image_parts[0]);
                $extension = $image_type_aux[1];
                $img = base64_decode($image_parts[1]);

                $path = public_path().'/assets/users/user-' . $user->id . '/thumbnails';

                if (! File::exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                }


                if (file_put_contents($path."/thumbnail-".$rand.".".$extension, $img)) {
                    $link->thumb_type = $req->type;
                    $link->image = "assets/users/user-".$user->id."/thumbnails/thumbnail-".$rand.".".$extension;
                    $link->save();

                    return response()->json([
                        'statusCode' => 200,
                        'message' => 'Link Image updated successfully!',
                    ]);
                } else {
                    return response()->json([
                        'statusCode' => 422,
                        'message' => 'Something went wrong, Please try again!',
                    ]);
                }
            }
            if ($req->type == "icon") {
                $req->validate([
                    'icon' => 'required',
                ]);

                $link->thumb_type = $req->type;
                $link->image = "assets/icons/tabler-icons/".$req->icon.".svg";
                $link->save();

                return response()->json([
                    'statusCode' => 200,
                    'message' => 'Link Image updated successfully!',
                ]);
            }

        } else {
            abort(404);
        }
    }

    public function removeLinkImage(Request $req)
    {
        if ($req->ajax()) {
            $req->validate([
                'id' => 'required',
            ]);

            $user = auth()->user();
            $link = Link::find($req->id);

            $link->image = null;
            $link->save();

            return response()->json([
                'statusCode' => 200,
                'message' => 'Link Image removed successfully!',
            ]);
        } else {
            abort(404);
        }
    }

    public function linkPriority(Request $req)
    {
        if ($req->ajax()) {
            $req->validate([
                'id' => 'required',
                'animation' => 'required',
            ]);

            $user = auth()->user();
            $link = Link::find($req->id);

            if ($link->animation == "none") {
                $link->animation = null;
            } else {
                $link->animation = $req->animation;
            }
            $link->save();

            return response()->json([
                'statusCode' => 200,
                'message' => 'Link Priority Set Successfully!',
            ]);
        } else {
            abort(404);
        }
    }

    public function deleteLink(Request $req, $id = null)
    {
        if($req->ajax()){
            $result = Link::where('id', $id)->delete();
            return response()->json([
                'statusCode' => 200,
                'message' => 'Link deleted successfully',
            ]);
        } else {
            abort(404);
        }
    }

    public function uploadAvatar(Request $req)
    {
        if ($req->ajax()) {
            $req->validate([
                'avatar' => 'required',
            ]);

            $user = auth()->user();

            $rand = Str::random(10);

            $image_parts = explode(";base64,", $req->avatar);
            $image_type_aux = explode("image/", $image_parts[0]);
            $extension = $image_type_aux[1];
            $img = base64_decode($image_parts[1]);

            $path = public_path().'/assets/users/user-' . $user->id;

            if (! File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            if ($user->avatar != "assets/images/avatar.png" && File::exists(public_path()."/".$user->avatar)) {
                File::delete(public_path()."/".$user->avatar);
            }

            if (file_put_contents($path."/user-".$user->id."-".$rand.".".$extension, $img)) {
                $user->avatar = "assets/users/user-".$user->id."/user-".$user->id."-".$rand.".".$extension;
                $user->save();

                return response()->json([
                    'statusCode' => 200,
                    'message' => 'Profile Image updated successfully!',
                ]);
            } else {
                return response()->json([
                    'statusCode' => 422,
                    'message' => 'Something went wrong, Please try again!',
                ]);
            }
        } else {
            abort(404);
        }

    }

    public function removeAvatar(Request $req)
    {
        if ($req->ajax()) {
            $user = auth()->user();

            if ($user->avatar != "assets/images/avatar.png" && File::exists(public_path()."/".$user->avatar)) {
                File::delete(public_path()."/".$user->avatar);
            }

            $user->avatar = "assets/images/avatar.png";
            $user->save();

            return response()->json([
                'statusCode' => 200,
                'message' => 'Profile Image deleted successfully!',
                'image' => asset($user->avatar),
            ]);
        } else {
            abort(404);
        }
    }

    public function updateProfile(Request $req)
    {
        if ($req->ajax()) {

            $profile = profile();
            if (isset($req->title)) {
                $profile->title = $req->title;
            }
            if (isset($req->bio)) {
                $profile->bio = $req->bio;
            }
            $profile->save();

            return response()->json([
                'statusCode' => 200,
                'message' => 'Profile updated successfully!',
            ]);

        } else {
            abort(404);
        }
    }

    public function hideLogo(Request $req)
    {
        if ($req->ajax()) {

            $profile = profile();
            $profile->hide_logo = $req->hide_logo;
            $profile->save();

            return response()->json([
                'statusCode' => 200,
                'message' => 'Logo Settings updated successfully!',
            ]);

        } else {
            abort(404);
        }
    }

    public function appearanceLayout(Request $req)
    {
        if ($req->ajax()) {

            $req->validate([
                'type' => 'required',
            ]);

            $profile = profile();
            $profile->layout_type = $req->type;
            if ($req->type == "theme") {
                $req->validate([
                    'name' => 'required',
                ]);
                $profile->theme = $req->name;
            }
            if ($req->type == "background") {
                $req->validate([
                    'background' => 'required',
                    'background_color_one' => 'required',
                    'background_color_two' => 'required',
                    'direction' => 'required',
                ]);
                $profile->background = $req->background;
                $profile->background_color_one = $req->background_color_one;
                $profile->background_color_two = $req->background_color_two;
                $profile->direction = $req->direction;
            }
            $profile->save();

            return response()->json([
                'statusCode' => 200,
                'message' => 'Layout Updated Successfully!',
            ]);

        } else {
            abort(404);
        }
    }

    public function buttonsLayout(Request $req)
    {
        if ($req->ajax()) {

            $req->validate([
                'custom_button' => 'required',
                'button_background_color' => 'required',
                'button_font_color' => 'required',
                'button_shadow_color' => 'required',
            ]);

            $profile = profile();
            $profile->custom_button = $req->custom_button;
            $profile->button_background_color = $req->button_background_color;
            $profile->button_font_color = $req->button_font_color;
            $profile->button_shadow_color = $req->button_shadow_color;
            $profile->save();

            return response()->json([
                'statusCode' => 200,
                'message' => 'Buttons Layout Updated Successfully!',
            ]);

        } else {
            abort(404);
        }
    }
}
