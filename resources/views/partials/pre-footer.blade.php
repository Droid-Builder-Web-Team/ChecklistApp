@each('pre-footer', $users->uname)
<div class="container">
    <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12">
        <p>Online Users:
            @foreach ($users as $user)
            <table>
                <thead></thead>
                <tbody>
                    <tr>
                        <td>
                            @if($user->isOnline())
                                <li>{{ $user->uname }}</li>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            @endforeach
        </p>
    </div>
    </div>
</div>
