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
                    <div class="text-lg py-2">Edit position</div>
                    @if(session('error'))
                        <div class="alert alert-default-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                        <form action="{{ route('positions.update', $position) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">
                                    @error('name')
                                    <i class="far fa-times-circle"></i>
                                    @enderror
                                    Name
                                </label>
                                <input class="form-control @error('name') is-invalid @enderror"
                                       maxlength="256" value="{{ $position->name }}" name="name" id="name">
                                <span class="text-sm float-right"></span>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="clearfix"></div>
                            <div class="row mt-3">
                                <div class="col-sm-6"><strong>Created
                                        at: </strong> {{ $position->created_at->format('d.m.y') }}
                                </div>
                                <div class="col-sm-6">
                                    <strong>Admin created ID : </strong> {{ $position->admin_created_id }}
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-6"><strong>Updated
                                        at: </strong> {{ $position->updated_at->format('d.m.y') }}
                                </div>
                                <div class="col-sm-6">
                                    <strong>Admin updated ID : </strong> {{ $position->admin_updated_id }}
                                </div>
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
