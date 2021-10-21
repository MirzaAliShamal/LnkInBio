<?php

use App\Models\UserProfile;
use App\Models\User;


function validateUsername($name) {
    $no = substr(str_shuffle("123456789"), 0, 3);
    $name = str_replace(' ', '', $name);

    if (usernameExists($name)) {
        $name = $name.$no;
        return validateUsername($name);
    } else {
        return strtolower($name);
    }
}

function usernameExists($name) {
    return User::whereUsername($name)->exists();
}

function profile() {
    $user = auth()->user();
    return $user->userProfile;
}
