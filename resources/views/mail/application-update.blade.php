@component('mail::message')
# Application Update

Your application to {{$application->offer->user->name}},
was {{$application->status}}!

@component('mail::button', ['url' => url('/')])
    Check it out!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
