@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Positions</h4>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('positions.create') }}" class="btn btn-success float-right">Add position</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    @if(session('error'))
        <div class="alert alert-default-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-default-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card col-sm-12 border pb-2">
                    <div class="text-lg py-2">Position list</div>
                    <table class="table border w-100">
                        <thead>
                        <tr>
                            <th class="col-9">Name</th>
                            <th class="col text-center">Last update</th>
                            <th class="col">Action</th>
                            <th class="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
@section('javascript')
    <script src="{{ asset('js/__cdn.datatables.net_1.11.3_js_jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "{{ route('api.positions.index') }}",
                    headers: {"token": "{{ csrf_token() }}"}
                },
                "columns": [
                    {data: 'name'},
                    {data: 'updated_at'},
                    {data: 'action', orderable: false, searchable: false},
                    {data: 'delete', orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        targets: -3,
                        className: 'dt-body-center'
                    }
                ]
            });
        });
    </script>
@endsection
