@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Employees</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card col-sm-6 border px-3 pb-3">
                    <div class="text-lg py-2">Add employee</div>
                    @if(session('error'))
                        <div class="alert alert-default-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @enderror
                    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="customFile">
                                @error('photo')
                                <i class="far fa-times-circle"></i>
                                @enderror
                                Photo
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('photo') is-invalid @enderror"
                                       id="customFile" name="photo">
                                <label class="custom-file-label" for="customFile"></label>
                                @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <span class="text-sm text-muted float-right">
                                File format jpg,png up to 5MB, the minimum size of 300x300px
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="name">
                                @error('name')
                                <i class="far fa-times-circle"></i>
                                @enderror
                                Name
                            </label>
                            <input class="form-control @error('name') is-invalid @enderror"
                                   maxlength="256" value="{{ old('name') }}" name="name" id="name">
                            <span class="text-sm float-right"></span>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">
                                @error('phone')
                                <i class="far fa-times-circle"></i>
                                @enderror
                                Phone
                            </label>
                            <input class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}" name="phone" id="phone">
                            <span class="text-sm float-right text-muted">
                                Required format +380 (xx) XXX XX XX
                            </span>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">
                                @error('email')
                                <i class="far fa-times-circle"></i>
                                @enderror
                                Email
                            </label>
                            <input class="form-control @error('email') is-invalid @enderror"
                                   type="email" value="{{ old('email') }}" name="email" id="email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="position_id">
                                @error('position_id')
                                <i class="far fa-times-circle"></i>
                                @enderror
                                Position
                            </label>
                            <select class="form-control @error('position_id') is-invalid @enderror"
                                    name="position_id" id="position_id">
                                <option value="0"> ---SELECT POSITION---</option>
                            @foreach($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                            </select>
                            @error('position_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="salary">
                                @error('salary')
                                <i class="far fa-times-circle"></i>
                                @enderror
                                Salary, $
                            </label>
                            <input class="form-control @error('salary') is-invalid @enderror"
                                   value="{{ old('salary') }}" name="salary" id="salary">
                            @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="head">
                                @error('head')
                                <i class="far fa-times-circle"></i>
                                @enderror
                                Head
                            </label>
                            <input class="form-control @error('head') is-invalid @enderror"
                                   value="{{ old('head') }}" name="head" id="head">
                            @error('head')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="employment_at">
                                @error('employment_at')
                                <i class="far fa-times-circle"></i>
                                @enderror
                                Date of employment
                            </label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" value="{{ old('employment_at') }}" class="form-control datetimepicker-input
                                       @error('employment_at') is-invalid @enderror"
                                       data-target="#reservationdate" name="employment_at" id="employment_at">
                                @error('employment_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="input-group-append" data-target="#reservationdate"
                                     data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end mt-5">
                            <button class="col-3 btn btn-outline-secondary mr-4">Cancel</button>
                            <button class="col-3 btn btn-outline-success" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
@section('javascript')
    <script src="{{ asset('js/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('moment/moment.min.js') }}"></script>
    <script src="{{ asset('tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'DD.MM.YY'
        });

        function displayInputTextLength() {
            let [...elems] = document.querySelectorAll('input[maxlength]');
            elems.forEach(elem => elem.addEventListener('input', function () {
                this.nextElementSibling.innerHTML = this.value.length + '/' + this.maxLength;
            }))
            elems.forEach(elem => elem.nextElementSibling.innerHTML = elem.value.length + '/' + elem.maxLength);
        }

        displayInputTextLength();

        <!-- Page specific script -->
        $(function () {
            bsCustomFileInput.init();
        });

        $('#head').autocomplete({
            source: "/api/head",
            minLength: 1
        });


    </script>
@endsection
