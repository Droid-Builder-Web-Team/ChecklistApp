@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">DROIDS</div>
                    <div class="card-body">
                        <table class="table table-bordered droids-datatable">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Droid Class</th>
                                    <th>Parts</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">USERS</div>
                    <div class="card-body">
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
        </div>
    </div>


    {{-- <div class="card">
        <div class="card-header">OAUTH Tokens</div>
        <div class="card-body">
            <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens>
        </div>
    </div> --}}
    @push('scripts')

        <script>
            $(document).ready(function() {

                $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/admin/dashboard/userstable",
                    columns: [{
                            data: 'fname',
                            name: 'fname'
                        },
                        {
                            data: 'lname',
                            name: 'lname'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'uname',
                            name: 'uname'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });

                $('.droids-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/admin/dashboard/droidstable",
                    columns: [{
                            data: 'image',
                            name: 'image'
                        },
                        {
                            data: 'parts',
                            name: 'parts'
                        },
                        {
                            data: 'class',
                            name: 'class'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                });

            });

        </script>
    @endpush

@endsection
