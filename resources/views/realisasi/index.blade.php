@extends('layouts.app')

@section('title', 'Realisasi Peserta')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Realisasi Peserta</span></h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Data Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive pb-3">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th width="25">No</th>
                                <th>Pegawai</th>
                                <th>Diklat</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th class="text-center" width="100">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="table-data">
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->pegawai ? $row->pegawai->nama_pegawai : '' }}
                                    </td>
                                    <td>{{ $row->diklat ? $row->diklat->nama_diklat : '' }}</td>
                                    <td>{{ $row->tahun }}
                                    <td>
                                        <span
                                            class="badge bg-{{ $row->status->color }}">{{ $row->status->nama_status }}</span>
                                    </td>
                                    <td>
                                        @if (!$row->realisasi)
                                            <span class="text-info">Belum upload SPT</span>
                                        @endif
                                        @if ($row->realisasi && !$row->anggaran)
                                            <span class="text-secondary">Belum dianggarkan</span>
                                        @endif
                                        @if ($row->realisasi && $row->anggaran && !$row->sertifikat)
                                            <span class="text-primary">Belum upload sertifikat</span>
                                        @endif
                                        @if ($row->realisasi && $row->anggaran && $row->sertifikat)
                                            <span class="text-success">Diklat Selesai</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (auth()->user()->id_role === 1)
                                            <a href="{{ route('realisasi.edit', $row->id_peserta) }}"
                                                class="btn btn-sm btn-info" title="Edit">
                                                <i class="tf-icons bx bx-edit-alt"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('realisasi.detail', $row->id_peserta) }}"
                                            class="btn btn-sm btn-primary" title="Detail">
                                            <i class="tf-icons bx bx-show"></i>
                                        </a>
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
            $('#dataTable').DataTable({
                "pageLength": 25,
            });
        });
    </script>
@endpush
