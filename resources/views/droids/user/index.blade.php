@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="heading mb-5">
            <h1 class="title text-center">My current builds</h1>
        </div>
        <div class="row mt-5" id="droidmainframe">
            @foreach ($my_droids as $my_droid)
                <div class="col-md-3 mb-5 droid-card">
                    <div class="droid-card-content" onclick="document.location='{{ route('droid.user.edit', $my_droid->id) }}'">
                        <div style="text-align:center">
                            <img src="{{ url($my_droid->image) }}" alt="{{ $my_droid->class }}" class="img-fluid mb-2"
                                style="height:300px;">
                        </div>

                        <div class="droid-card-table" style="z-index:2">
                            <div class="droid-card-row">
                                <div class="droid-card-left">
                                    <form action="">
                                        <input type="image" src="/img/share.png">
                                    </form>
                                </div>
                                <div class="droid-card-center noclick">
                                    @if($my_droid->droid_designation == NULL)
                                    <h2 style="margin-bottom:0px">{{ $my_droid->class }}</h2>
                                    @else
                                    <h2 style="margin-bottom:0px">{{ $my_droid->droid_designation }}</h2>
                                    @endif
                                </div>
                                <div class="droid-card-right">

                                    <button type="button" class="delete-button" data-toggle="modal"
                                        data-target="#exampleModal" data-whatever="{{ $my_droid->id }}"
                                        onclick="showModal(event, {{ $my_droid->id }}, '{{ $my_droid->class }}')">
                                        <input type="image" src="/img/trash.png">
                                    </button>
                                    <form id="delete-droid-{{ $my_droid->id }}" action="{{ route('droid.user.destroy', $my_droid->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="progress-container noclick">
                            <div class="progress-bar" style="width:{{ $my_droid->progress }}%;">&nbsp;</div>
                            <h5 class="progress-text">{{ $my_droid->progress }}%</h5>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="modalDeleteBuild" tabindex="-1" role="dialog" aria-labelledby="modalDeleteBuildTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="doCancelDelete()" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="doConfirmDelete()">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .delete-button {
        border: 0;
        background: none;
        padding: 0;
    }
</style>
@endpush

@push('scripts')

    <script>
        let deletingId;
        let deletingDroidClass;

        function showModal(event, droidId, droidClass) {
            event.stopPropagation();
            deletingId = droidId;
            deletingDroidClass = droidClass;
            $("#modalDeleteBuild").modal('show');
        }

        $('#modalDeleteBuild').on('show.bs.modal', function(event) {
            const modal = $(this);
            modal.find('.modal-title').text("Delete " + deletingDroidClass + "?");
            modal.find('.modal-body input').val(deletingId);
        });

        function doConfirmDelete()
        {
            document.getElementById("delete-droid-" + deletingId).submit();
        }

        function doCancelDelete()
        {
            deletingId = null;
            deletingDroidClass = null;
        }

    </script>
@endpush
