@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Statistics</div>
                    <div class="card-body">
                        <table class="table table-bordered" id="statsTable">
                            <thead>
                                <tr>
                                    <th>Total Droids</th>
                                    <th>Total Users</th>
                                    <th>Popular Droids</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $totalDroids }}</td>
                                    <td>{{ $totalUsers }}</td>
                                    <td>
                                        <ol class="list-group">
                                            @foreach($topFiveDroids as $t)
                                                <li>{{ $t->droids->class}}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Droids</div>
                    <div class="card-body">
                        <table class="table table-bordered droids-datatable">
                            <thead>
                                <tr>
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
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        <table class="table table-bordered user-datatable">
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

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="modalDeleteBuildTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Are you sure you want to remove this uuser?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" name="ok_button" id="ok_button">Confirm</button>
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

                $('.user-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/admin/dashboard/userstable",
                    columns: [
                        {
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
                    columns: [
                        {
                            data: 'class',
                            name: 'class'
                        },
                        {
                            data: 'parts',
                            name: 'parts'
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
