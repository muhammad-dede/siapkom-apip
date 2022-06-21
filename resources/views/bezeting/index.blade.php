@extends('layouts.app')

@section('title', 'Data Bezeting')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Data Bezeting</h4>
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
                        <a href="{{ route('bezeting.create') }}" class="btn btn-primary">Tambah</a>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('bezeting.export') }}" method="POST" id="form-export" class="d-inline">
                            @csrf
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <select class="form-control" name="tahun" id="tahun">
                                        <option value="">-- Filter Sesuai Tahun --</option>
                                        @foreach (getTahun() as $row)
                                            <option value="{{ $row['tahun'] }}">{{ $row['tahun'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                                <th>Nama Jabatan</th>
                                <th>Tahun</th>
                                <th>ABK</th>
                                <th>Eksisting</th>
                                <th>Bezeting</th>
                                <th>Keterangan</th>
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
                    url: "{{ route('bezeting.index') }}",
                    data: function(d) {
                        d.tahun = $('#tahun').val(),
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
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'abk',
                        name: 'abk'
                    },
                    {
                        data: 'existing',
                        name: 'existing'
                    },
                    {
                        data: 'bezeting',
                        name: 'bezeting'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $("#tahun").change(function() {
                table.draw();
            });

            $("#nama_jabatan").change(function() {
                table.draw();
            });
        });
    </script>
@endpush
