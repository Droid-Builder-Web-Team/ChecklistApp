@component('mail::message')
# Welcome, {{ $user->fname }}!

Thank you for joining the Printed Parts Checklist. We created this application in the hopes it helps builders during their build to keep track of their progress and various droids.
<br><br>
We are always adding new droids, new features and many other things to make it as helpful as possible.
<br><br>
Being new to the community can be tricky so we have includes some quick links to help you get started
    <ul>
        <li><a href="https://www.facebook.com/groups/MrBaddeley">The Facebook Group</a></li>
        <li><a href="https://www.patreon.com/mrbaddeley">Patreon Page</a></li>
        <li><a href="https://astromech.net">Astromech.net</a></li>
        <li><a href="https://www.robsrobots.co.uk/guides.php">New Builder Guides</a></li>
    </ul>
<br><br>
If you have any problems or questions, please post in our Facebook Group or contact me and I will do anything I can to help.


@component('mail::button', ['url' => 'https://checklist.mbprinteddroids.com'])
Get Started!
@endcomponent

Thanks,<br>
{{ config('app.bossman') }}
@endcomponent
