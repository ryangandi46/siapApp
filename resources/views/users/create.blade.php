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
                        <h2>Add User</h2>
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

            <div class="container" id="tambah-edit-form">
                <div class="header">
                    <h5 class="modal-title" id="modal-judul"></h5>
                </div>
                <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal"
                    action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <br>
                    <div class="row justify-content-md-center">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="Nama lengkap kamu" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Masukan email kamu" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukan Password" required>
                            </div>

                            {{-- <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan"
                                    value="{{ old('jabatan') }}" placeholder="Masukan jabatan kamu" required>
                            </div> --}}

                            <div class="form-group">
                                <label for="jabatan" class="control-label">jabatan</label>
                                <select class="form-control" id="jabatan"  name="jabatan" required>
                                    <option value="">- Pilih -</option>
                                    <option value="admin">admin</option>
                                    <option value="sarana">sarana</option>
                                    <option value="kaprog">kaprog</option>
                                    <option value="toolman">toolman</option>
                                </select>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="tombol-simpan"
                                    value="create">Simpan</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
