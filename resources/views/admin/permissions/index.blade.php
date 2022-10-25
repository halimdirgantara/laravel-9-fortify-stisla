@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')

    <div class="section-header">
        <h1>{{ $title }}</h1>
    </div>
    <div class="section-body">
        <div class="card card-primary">
            <div class="card-body">
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#formModal">
                    {{ $newButton }}
                </button>
                <div class="card-body table-responsive">
                    <table class="table table-striped data-table" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
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

@endsection

@section('modal')
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        @include('admin.permissions.form-control')
                </div>
                <div class="modal-footer justify-content-between">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('permission.index') }}",
                columns: [
                    {data: 'id', name: 'id',orderable: true,},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            //Edit User
            $('body').on('click touchstart','.edit', function(){
                let id = $(this).data("id");
                let url = window.location.href;
                //redirect to
                window.location.href = url+"/"+id+"/edit";
            })

            //Delete item
            $('body').on('click touchstart','.delete', function(){
                let id = $(this).data("id");
                Swal.fire({
                    title: 'Delete This User!',
                    text: "Are you sure you want to delete this user?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "DELETE",
                            url: window.location.href+'/'+id,
                            success: function (data) {
                                table.draw();
                                Swal.fire({
                                    icon: data.icon,
                                    title: data.title,
                                    text: data.message,
                                })
                            },
                            error: function (data) {
                                Swal.fire({
                                    icon: data.responseJSON.icon,
                                    title: data.responseJSON.title,
                                    text: data.responseJSON.message,
                                })
                            }
                        });
                    }
                })
            });
        });
    </script>

@endpush
