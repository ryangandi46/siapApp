@extends('templateLayout')
{{-- @include('template.headTable') --}}

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Sistem Inventaris Aset Sekolah</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('aset.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Spesifikasi</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($aset as $as)
            <tr>
                <td>{{ $as->id }}</td>
                <td>{{ $as->nama_aset }}</td>
                <td>{{ $as->merek }}</td>
                <td>
                    <form action="{{ route('aset.destroy', $as->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('aset.show', $as->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('aset.edit', $as->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>

    {{ $aset->links() }}

@endsection
{{-- @include('template.scriptTable') --}}