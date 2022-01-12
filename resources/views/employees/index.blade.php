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
                    <h4 class="m-0">Employees</h4>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('employees.create') }}" class="btn btn-success float-right">Add employee</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
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
                    <div class="text-lg py-2">Employees list</div>
                    <table class="table border w-100">
                        <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Date of employment</th>
                            <th class="col-sm-2">Phone number</th>
                            <th>Email</th>
                            <th>Salary</th>
                            <th class="text-center">Action</th>
                            <th></th>
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
                    url: "{{ route('api.employees.index', ['token' => csrf_token()]) }}"
                },
                "columns": [
                    {data: 'photo', render: function (data, type, row, meta) {
                            return '<img src="' + (data ?? '{{asset('50x50.png')}}') + '" height="50" width="50" class="rounded-circle"/>';
                        }},
                    {data: 'name'},
                    {data: 'position.name'},
                    {data: 'employment_at'},
                    {data: 'phone'},
                    {data: 'email'},
                    {data: 'salary'},
                    {data: 'action',   orderable: false, searchable: false},
                    {data: 'delete',   orderable: false, searchable: false}
                ],
            });
        });
    </script>
@endsection
