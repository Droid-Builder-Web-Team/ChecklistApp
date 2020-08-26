@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="page-wrapper">
                <nav id="sidebar" class="sidebar-wrapper">
                <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">Administrator Panel</a>
                </div>
                @foreach($users as $user)
                <div class="sidebar-header">
                    <h2>{{  $user->uname }}</h2>

                    <div class="user-info">
                    <span class="user-name"></span>
                    <span class="user-role">Administrator</span>
                    <span class="user-status">
                        <i class="fa fa-circle"></i>
                        <span>Online</span>
                    </span>
                    </div>
                </div>
                @endforeach

                <!-- sidebar-header  -->
                <div class="sidebar-search">
                    <div>
                    <div class="input-group">
                        <input type="text" class="form-control search-menu" placeholder="Search...">
                        <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </span>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
                    <li class="header-menu">
                        <span>Users</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                        <i class="fa fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                        </a>

                        <div class="sidebar-submenu">
                            <ul>
                            <li>
                                <a href="#">Admin Dashboard</a>
                            </li>

                            <li>
                                <a href="#">Designer Dashboard</a>
                            </li>
                            </ul>
                        </div>

                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Droids</span>
                        </a>
                        <div class="sidebar-submenu">
                        <ul>
                            <li>
                            <a href="#">New Droid</a>
                            </li>

                        </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                        <i class="far fa-gem"></i>
                        <span>Users</span>
                        </a>
                        <div class="sidebar-submenu">
                        <ul>
                            <li>
                            <a href="#">Add New User</a>
                            </li>
                            <li>
                            <a href="#">User Management</a>
                            </li>
                            <li>
                            <a href="#">User Activity</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    <li class="sidebar-item">
                        <a href="#">
                        <i class="fa fa-chart-line"></i>
                        <span>Statistics</span>
                        </a>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                        <i class="fa fa-globe"></i>
                        <span>Locations</span>
                        </a>
                        <div class="sidebar-submenu">
                        <ul>
                            <li>
                            <a href="#">User Locations</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    <li class="header-menu">
                        <span>Extra</span>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Documentation</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span>To Do List</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-folder"></i>
                        <span>Project Board</span>
                        </a>
                    </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
                </div>
                <!-- sidebar-content  -->
                <div class="sidebar-footer">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-pill badge-warning notification">3</span>
                </a>
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span class="badge badge-pill badge-success notification">7</span>
                </a>
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span class="badge-sonar"></span>
                </a>
                <a href="#">
                    <i class="fa fa-power-off"></i>
                </a>
                </div>
            </nav>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">OAUTH Tokens</div>
                <div class="card-body">
                    <passport-clients></passport-clients>
                    <passport-authorized-clients></passport-authorized-clients>
                    <passport-personal-access-tokens></passport-personal-access-tokens>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.admin.dashboard') }}",
                columns: [
                    {data: 'fname', name: 'fname'},
                    {data: 'lname', name: 'lname'},
                    {data: 'email', name: 'email'},
                    {data: 'uname', name: 'uname'},
                ]
             });
          });
       </script>
@endpush
