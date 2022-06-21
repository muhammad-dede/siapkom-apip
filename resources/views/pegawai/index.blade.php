@extends('layouts.app')

@section('title', 'Data Pegawai')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Data Pegawai</h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Data Table -->
        <div class="card">
            <div class="card-header">
                <div class="row mb-2">
                    <div class="col-auto me-auto">
                        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah Pegawai</a>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('pegawai.export') }}" method="POST" id="form-export" class="d-inline">
                            @csrf
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <select class="form-control" name="nama_jabatan" id="nama_jabatan">
                                        <option value="">-- Filter Sesuai Jabatan --</option>
                                        @foreach (refJabatan() as $row)
                                            <option value="{{ $row->nama_jabatan }}">{{ $row->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" id="btn-export" class="btn btn-success">Export</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Pangkat/Golongan</th>
                                <th>Jabatan</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0"></tbody>
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
            var table = $('#dataTable').DataTable({
                pageLength: 25,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pegawai.index') }}",
                    data: function(d) {
                        d.nama_jabatan = $('#nama_jabatan').val(),
                            d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'nama_pegawai',
                        name: 'nama_pegawai'
                    },
                    {
                        data: 'pangkat_golongan',
                        name: 'pangkat_golongan'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $("#nama_jabatan").change(function() {
                table.draw();
            });
        });
    </script>
@endpush
