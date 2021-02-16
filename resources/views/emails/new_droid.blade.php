@component('mail::message')
# Hello!

We try to only contact you when it's important and we wanted to let you know
that a new droid has been added to the checklist.
<br><br>
You can head over to the Droid Mainframe to take a look at which droid(s) we just added!
@component('mail::button', ['url' => 'https://checklist.mbprinteddroids.com'])
Check it out!
@endcomponent

Thanks,<br>
{{ config('app.bossman') }}
@endcomponent