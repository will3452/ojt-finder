<?php

namespace App\Observers;

use App\Models\Employer;
use App\Models\User;

class EmployerObserver
{
    public function created(Employer $employer)
    {
        $employer->update(['type'=> User::TYPE_EMPLOYER]);
    }
}
