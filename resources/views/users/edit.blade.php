@extends('templateLayout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit User</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row justify-content-md-center">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" placeholder="Nama lengkap kamu" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" placeholder="Masukan email kamu" readonly>
                        </div>

                        <div class="form-group">
                            <label for="jabatan" class="control-label">jabatan</label>
                            <select class="form-control" id="jabatan"  value="{{ old('jabatan') }}" name="jabatan" required>
                                <option value="{{ $user->jabatan }}">{{ $user->jabatan }}</option>
                                <option value="admin">admin</option>
                                <option value="sarana">sarana</option>
                                <option value="kaprog">kaprog</option>
                                <option value="toolman">toolman</option>
                            </select>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" id="tombol-update">Update</button>
                        </div>
                    </div>
                </div>
        </div>

        </form>
    @endsection
