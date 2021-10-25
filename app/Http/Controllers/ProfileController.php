<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function setupProfile(User $user)
    {
        return view('profile', compact('user'));
    }



    public function updateProfile(User $user)
    {
        $data = request()->validate([
            'name'=>'required',
            'password'=>'',
            'inline_address'=>'required',
            'city'=>'required',
            'about'=>'required',
            'picture'=>''
        ]);

        $accountField = [
            'name'=>$data['name'],
            'password'=>bcrypt($data['password']),
        ];

        $more = json_encode([
            'inline_address'=>$data['inline_address'],
            'city'=>$data['city'],
            'about'=>$data['about']
        ]);

        $profileFields = [
            'user_id'=>auth()->id(),
            'picture'=>$data['picture']->store('public'),
            'more'=>$more
        ];

        $profile = $user->profile;

        if ($profile == null) {
            Profile::create($profileFields);
        } else {
            auth()->user()->profile()->update($profileFields);
        }

        $user->update($accountField);

        return back();
    }
}
