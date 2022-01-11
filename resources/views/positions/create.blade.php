@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Positions</h4>
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
                    <div class="text-lg py-2">Add position</div>
                    @if(session('error'))
                        <div class="alert alert-default-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @enderror
                    <form action="{{ route('positions.store') }}" method="POST">
                        @csrf
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
                        <div class="row justify-content-end mt-5">
                            <a class="col-3 btn btn-outline-secondary mr-4"
                               href="{{ route('positions.index') }}">Cancel</a>
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
    <script>
        function displayInputTextLength() {
            let [...elems] = document.querySelectorAll('input[maxlength]');
            elems.forEach(elem => elem.addEventListener('input', function () {
                this.nextElementSibling.innerHTML = this.value.length + '/' + this.maxLength;
            }))
            elems.forEach(elem => elem.nextElementSibling.innerHTML = elem.value.length + '/' + elem.maxLength);
        }
        displayInputTextLength();
    </script>
@endsection
