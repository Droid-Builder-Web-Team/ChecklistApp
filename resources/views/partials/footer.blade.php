<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="onlineUsersBar p-3 ml-auto mr-auto">
                <p>Online Users:
                    @foreach ($users as $user)
                        @if($user->isOnline())
                            <li> {{ $user->uname }}, </li>
                        @endif

                    @endforeach
                </p>
            </div>
        </div>
      <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
          <p class="copyright-text">Printed Parts Checklist <?php echo date("Y");?> Created and Maintained by <a href="https://www.facebook.com/DroidBuilderWebTeam">Droid Builder Web Team</a>
          </p>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <ul class="social-icons">
            <li><a class="facebook" href="https://www.facebook.com/DroidBuilderWebTeam"><i class="fab fa-facebook"></i></a></li>
            <li><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
            <li><a class="dribbble" href="https://discord.gg/4ZV9DmY"><i class="fab fa-discord"></i></a></li>
            <li><a class="email" href="#"><i class="fas fa-envelope"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
</footer>
