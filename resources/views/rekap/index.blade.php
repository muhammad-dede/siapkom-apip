@extends('layouts.app')

@section('title', 'Rekap Diklat')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Rekap Diklat</h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Data Table -->
        <div class="card">
            <div class="card-header">
                <form action="{{ route('rekap.export') }}" method="POST" id="form-export" class="d-inline">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <select class="form-control" name="tahun" id="tahun">
                                <option value="">-- Tahun --</option>
                                @foreach (getTahun() as $row)
                                    <option value="{{ $row['tahun'] }}">{{ $row['tahun'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <select class="form-control" name="nama_diklat" id="nama_diklat">
                                <option value="">-- Diklat --</option>
                                @foreach (refDiklat() as $row)
                                    @if ($row->id_diklat !== 1)
                                        <option value="{{ $row->nama_diklat }}">{{ $row->nama_diklat }}</option>
                                    @endif
                                @endforeach
                                <option value="LAINNYA">LAINNYA</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" id="btn-export" class="btn btn-success">Export</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th width="25">No</th>
                                <th>Pegawai</th>
                                <th>Diklat</th>
                                <th>Tahun</th>
                                <th class="text-center" width="100">Opsi</th>
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
                    url: "{{ route('rekap.index') }}",
                    data: function(d) {
                        d.tahun = $('#tahun').val(),
                            d.nama_diklat = $('#nama_diklat').val(),
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
                        data: 'pegawai',
                        name: 'pegawai'
                    },
                    {
                        data: 'diklat',
                        name: 'diklat'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
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

            $("#nama_diklat").change(function() {
                table.draw();
            });
        });
    </script>
@endpush
