<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function uploadResume()
    {
        $data = request()->validate([
            'file'=>'required',
        ]);

        $data['file'] = $data['file']->store('public');
        if (auth()->user()->resume) {
            auth()->user()->resume()->update($data);
        } else {
            auth()->user()->resume()->create($data);
        }

        return back();
    }

    public function deleteResume(Resume $resume)
    {
        $resume->delete();
        return back();
    }
}
