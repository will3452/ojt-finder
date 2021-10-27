<?php

namespace App\Observers;

use App\Mail\ApplicationUpdate;
use App\Mail\NewApplicant;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;

class ApplicationObserver
{
    public function updated(Application $application)
    {
        Mail::to($application->user->email)->send(new ApplicationUpdate($application));
    }

    public function created(Application $application)
    {
        Mail::to($application->offer->user->email)->send(new NewApplicant($application));
    }
}
