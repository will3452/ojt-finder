<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function submitApplication()
    {
        Application::create([
            'user_id'=>auth()->id(),
            'offer_id'=>request()->offer_id
        ]);

        alert('Your Application has been submitted!');

        return back();
    }

    public function applicationIndex(Offer $offer)
    {
        $offer->load('applications');
        return view('show_offer', compact('offer'));
    }

    public function applicationPost(Application $application)
    {
        $data = request()->validate([
            'status'=>'required'
        ]);

        alert('Done');
        $application->update($data);

        return back();
    }
}
