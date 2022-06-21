@extends('layouts.app')

@section('title', 'Data User')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Data User</h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Data Table -->
        <div class="card">
            <div class="card-header">
                <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th width="25">No</th>
                                <th>Nama</th>
                                <th>Nama Pengguna</th>
                                <th>Role</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->role ? $row->role->nama_role : '-' }}</td>
                                    <td class="text-center">
                                        {{-- <form action="{{ route('user.destory', $row->id_user) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-sm {{ $row->status ? 'btn-success' : 'btn-warning' }}">{{ $row->status ? 'Aktif' : 'Tidak Aktif' }}</button>
                                        </form> --}}
                                        <a href="{{ route('user.edit', $row->id_user) }}"
                                            class="btn btn-sm btn-info">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Data Table -->
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
