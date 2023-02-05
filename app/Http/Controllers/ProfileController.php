<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function update()
    {

        $user = request()->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required',
            'mobilenumber' => 'max:10',
        ]);

        auth()->user()->update($attributes);
        return back()->withStatus('Profile successfully updated.');

}
}
