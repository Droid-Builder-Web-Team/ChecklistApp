@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Links</div>
                    <div class="card-body">
                        <ul class="d-block text-center justify-center" style="list-style:none;">
                            <li class="mb-2"><a href="{{ route('logs') }}" class="btn btn-block btn-info">Logs</a></li>
                            <li class="mb-2"><a href="{{ route('admin.users.unverified') }}" class="btn btn-block btn-info">Verification Management</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">User List</div>
                    <div class="card-body">
                        <table class="table table-bordered user-datatable">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Last Login Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div><br>
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
                    <h4 align="center" style="margin:0;">Are you sure you want to remove this user?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" name="ok_button" id="ok_button">Confirm</button>
                </div>
            </div>
        </div>
    </div>

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
                            data: 'last_activity',
                            name: 'last_activity',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('.user-datatable').on('click', '.btn-delete[data-userid]', function (e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var url = "/admin/users/" + $(this).data('userid');
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('.user-datatable').DataTable().draw(false);
                    });
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

                $('.droids-datatable').on('click', '.btn-delete[data-droidid]', function (e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var url = "/droids/admin/" + $(this).data('droidid');
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('.droids-datatable').DataTable().draw(false);
                    });
                });
            });


        </script>
    @endpush


@endsection
