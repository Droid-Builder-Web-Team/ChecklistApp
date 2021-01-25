<footer class="site-footer">
    <div class="container">
        @if (Auth::check())
        <div class="row">
            <div class="col-md-12">
                <div class="onlineUsersBar p-3 ml-auto mr-auto">
                    <p>Online Users:
                        <ol style="list-style:none; display:flex;">
                        @foreach ($users as $user)
                            @if($user->isOnline())
                                <li>&nbsp {{ $user->uname }}, &nbsp </li>
                            @endif
                        @endforeach
                        </ol>
                    </p>
                </div>
            </div>
        </div>
        <hr>
        @endif
        <div class="row">
            <div class="col-md-4">
                <ul class="site-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('getting_started') }}">Help</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                    {{-- <li><a href="#">Contact</a></li> --}}
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="site-links">
                    <li><a href="{{ route('droids.index.index') }}">Droid Mainframe</a></li>
                    <li><a href="{{ route('droid.user.index') }}">My Droids</a></li>
                    @if (Auth::check())
                        <li><a href="{{ route('admin.users.profile', Auth::user()->id) }}">My Profile</a></li>
                    @endif
                    <li><a href="{{ route('gdpr-terms') }}">GDPR Notice</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="site-links">
                    <h5>Need to report a technical problem?</h5>
                    <a href="mailto:droidbuilderwebteam@gmail.com?Subject=Technical%20Issue%20Report%3A%20Printed%20Parts%20Checklist">Report it here</a>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Printed Parts Checklist <?php echo date("Y");?> Created and Maintained by <a href="https://www.facebook.com/DroidBuilderWebTeam">Droid Builder Web Team</a>
            </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
                <li><a class="facebook" href="https://www.facebook.com/DroidBuilderWebTeam"><i class="fab fa-facebook"></i></a></li>
                <li><a class="youtube" href="https://youtube.com/channel/UCwT5SV9ezzcorQa9AHu11uQ"><i class="fab fa-youtube"></i></a></li>
                <li><a class="discord" href="https://discord.gg/4ZV9DmY"><i class="fab fa-discord"></i></a></li>
                <li><a class="email" href="mailto:droidbuilderwebteam@gmail.com"><i class="fas fa-envelope"></i></a></li>
            </ul>
            </div>
        </div>
    </div>
</footer>
