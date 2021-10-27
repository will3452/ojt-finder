@component('mail::message')
# New application Alert!

There's a new applicant in your offer titled "{{$application->offer->title}}"

@component('mail::button', ['url' => url('/applications/'.$application->id)])
Check it out
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
