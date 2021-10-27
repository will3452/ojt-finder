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
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_name'=>'required',
            'password'=>'',
            'inline_address'=>'required',
            'city'=>'required',
            'about'=>'required',
            'picture'=>''
        ]);


        $accountField = [
            'first_name'=>$data['first_name'],
            'middle_name'=>$data['middle_name'],
            'last_name'=>$data['last_name'],
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
