@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">Frequently Asked Questions</h1>
            <hr style="background:white;">
                <h5 class="text-light"><u>I get a page that says 500 | Server Error - What does this mean?</u></h5>

                <p class="text-light">For some reason, the application cannot load the page you want. This can be caused by a lot of different things and it can occasionally be rather difficult to find the cause. Initial troubleshooting can be rather simple for you to try before raising an issue.
                Clear your cache and cookies - In an attempt to be helpful, browsers “save” versions of a website. It does this to try to make the loading time as quick as possible for you but occasionally this causes problems. Within Desktop Browsers, you should enter your browser settings usually found by either a three lines or a three dots icon and clear your cookies and cache. WARNING: clearing cookies will most likely sign you out of other websites to ensure you will not lose anything when you do this.
                Restart your browser - Browsers, whether they are on a mobile or desktop occasionally “clog up” and require a restart in order to clear any temporary files the browser has collected.
                Log out and Log In - As we mentioned in the previous two options, browsers sometimes do strange things. Logging out and then back into your account has proven to fix some issues as this will completely destroy the session the user has created (that is developer talk for a clean slate for the browser).
                Check for updates - Most of the time, there are updates to be done and you might not know about it. Updates are vital both for security and to keep the programs up to date with the latest information they need to run. Browsers and devices that are out of date might struggle to run certain applications. Ensure your browser and device are up to date.
                Restart your device - When all else fails, turn it off and on again. This will completely clear those pesky temporary files that build up within your device, will give your device a clean slate to try again. If you still find problems please contact us.</p>

                <h5 class="text-light"><u>I upload a droid image/ profile image but nothing is there</u></h5>

                <p class="text-light">With every ability to upload to the internet, the majority of places 
                    will put a limit on how big of a file you can upload at once. Some places allow larger 
                    file sizes than others. In terms of images, especially those taken on smartphones, 
                    file sizes can be quite large because your device will attach a lot of information to the 
                    image to help it be processed and interpreted by the device, browsers, apps etc. Whilst 
                    this is very helpful, all it does in this case is make the file size too big for the 
                    application to accept. Don’t worry! We can fix this without you having to become a 
                    photoshop expert. There are many compression tools online you can use, we recommend a 
                    tool such as this - <a href="https://compressjpeg.com/"></a> - please make sure you are 
                    using the correct compressor for your file type. This will compress your file size down 
                    to a much more manageable size.
                    <br><br>
                    Please note, this does not fix all problems with images, sometimes images are too big to upload. If you face this issue please contact us.
                </p>

                <h5 class="text-light"><u>What file types are accepted for image uploads?</u></h5>

                <p class="text-light">We currently only allow .gif .jpg .jpeg .png .svg files.</p>

                <h5 class="text-light"><u>Can we upload multiple images?</u></h5>

                <p class="text-light">Not right now! In order to launch the checklist with a reasonable 
                    timescale, we couldn’t do everything we wanted for the launch. A future upgrade to 
                    the Printed Parts Checklist will be a sharable user Gallery in which you can upload 
                    multiple images and then share those images, link them to your droids etc.
                </p>
               
                <h5 class="text-light"><u>Can I download this from an App Store?</u></h5>

                <p class="text-light">No. Printed Parts Checklist is a Progressive Web Application which 
                    means it is basically a website that behaves like an app but you cannot download it 
                    via the app. play store. You can visit the website and then save it to your home 
                    screen and have it behave just like an app.
                    <br><br>
                    You can save it to your home screen by visiting the page and finding the page settings
                    within your device's browser and you should be presented with an option to save the
                    page, usually this allows saving to the homescreen.
                </p>

                
                <h5 class="text-light"><u>How long should I wait for the verification email to come through?</u></h5>

                <p class="text-light">Both the verification and the welcome email should come through 
                    instantly. We have had reports that some users' emails have been filtered into their 
                    Junk/ Spam Folders so please check those folders if you cannot see your email. 
                    If you have used Facebook, Google or Github you may not be required to verify 
                    your email but you should still get a welcome email!
                </p>

                <h5 class="text-light"><u>I haven’t received any emails, what should I do?</u></h5>

                <p class="text-light">Check your junk folders. Seriously you would be amazed at the 
                    amount of emails that automatically get filtered to junk folders. If you are positive 
                    that you entered the correct email and haven’t received the email to verify your 
                    account, please contact us and we will verify you.
                </p>
                
                <h5 class="text-light"><u>I’m building a droid that Mr Baddeley did not make, where is the checklist for other droids?</u></h5>

                <p class="text-light">There isn’t one. This application is for droids created by 
                    MrBaddeley, not other designers. 
                </p>

                <h5 class="text-light"><u>I’m building a Baddeley Droid that isn’t on the Checklist, can you add it?</u></h5>

                <p class="text-light">It is the job of MrBaddeley to update the checklist with droids. 
                    The Droid Builder Web Team is too busy to be constantly updating with additions of 
                    droids, revisions and changing of parts etc. If you spot a droid that is missing 
                    from the checklist, please contact MrBaddeley.
                </p>
        </div>
    </div>
</div>
@endsection
