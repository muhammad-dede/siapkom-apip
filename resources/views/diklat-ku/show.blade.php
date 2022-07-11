@extends('layouts.app')

@section('title', 'Detail Diklat')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row pt-1 pb-2">
            <div class="col-auto me-auto pt-1">
                <h4 class="fw-bold">Detail Diklat</h4>
            </div>
            <div class="col-auto">
                @if ($peserta->id_status === 2)
                    <button id="btn-sertifikat" type="button" class="btn btn-primary me-2">Upload Sertifikat</button>
                @endif
                <a href="{{ route('diklatku.index') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <table class="mb-4 table">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <h5>Data Pegawai</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <strong>{{ $peserta->pegawai ? $peserta->pegawai->nama_pegawai : '' }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>{{ $peserta->pegawai ? $peserta->pegawai->nip : '' }}</td>
                        </tr>
                        <tr>
                            <td>Pangkat/Golongan</td>
                            <td>
                                {{ $peserta->pegawai ? ($peserta->pegawai->pangkat ? $peserta->pegawai->pangkat->nama_pangkat : '') : '' }}
                                {{ $peserta->pegawai ? ($peserta->pegawai->golongan ? '(' . $peserta->pegawai->golongan->nama_golongan . ')' : '') : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>
                                {{ $peserta->pegawai ? ($peserta->pegawai->jabatan ? $peserta->pegawai->jabatan->nama_jabatan : '') : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <br>
                                <h5>Data Diklat</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Diklat</td>
                            <td><strong>{{ $peserta->nama_diklat }}</strong></td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td>{{ $peserta->tahun }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>
                                {{ \Carbon\Carbon::parse($peserta->tgl_mulai)->isoFormat('D MMMM Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>
                                {{ \Carbon\Carbon::parse($peserta->tgl_selesai)->isoFormat('D MMMM Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td>{{ $peserta->tempat }}</td>
                        </tr>
                        <tr>
                            <td>Jam Pelatihan</td>
                            <td>{{ $peserta->jam_pelatihan }} Jam</td>
                        </tr>
                        <tr>
                            <td>No Surat Perintah Tugas</td>
                            <td>
                                <span
                                    class="{{ $peserta->realisasi ? '' : 'text-danger' }}">{{ $peserta->realisasi ? $peserta->realisasi->no_spt : 'Belum Upload' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>File Surat Perintah Tugas</td>
                            <td>
                                @if ($peserta->realisasi)
                                    <a href="{{ asset('') }}public/files/spt/{{ $peserta->realisasi->file_spt }}"
                                        target="_blank">Lihat</a>
                                @else
                                    <span class="text-danger">Belum Upload</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Anggaran Diklat</td>
                            <td>
                                <span
                                    class="{{ $peserta->realisasi ? '' : 'text-danger' }}">{{ $peserta->realisasi ? 'Rp. ' . number_format($peserta->realisasi->anggaran, 2, ',', '.') : 'Belum dianggarkan' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Sertifikat</td>
                            <td>
                                @if ($peserta->sertifikat)
                                    <a href="{{ asset('') }}public/files/sertifikat/{{ $peserta->sertifikat->file_sertifikat }}"
                                        target="_blank">Lihat</a>
                                @else
                                    <span class="text-danger">Belum Upload</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <br>
                                <h5>Status Peserta</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <span
                                    class="badge bg-{{ $peserta->status->color }}">{{ $peserta->status->nama_status }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Modal Sertifikat --}}
    <div class="modal fade" id="modal-sertifikat" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Upload Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-sertifikat" class="form"
                    action="{{ route('diklatku.sertifikat', $peserta->id_peserta) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">File Sertifikat</label>
                                <input type="file" class="form-control" name="file_sertifikat" id="file_sertifikat">
                                <small>Max: 2Mb | Ekstensi: pdf. </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            $("#btn-sertifikat").on("click", function(event) {
                event.preventDefault();
                $("#modal-sertifikat").modal("show");
            });

            $("#form-sertifikat").on("submit", function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('.text_error').text('');
                    },
                    success: function(response) {
                        if (response.error) {
                            $.each(response.error, function(key, val) {
                                if (key.indexOf(".") != -1) {
                                    var arr = key.split(".");
                                    name = $("[name='" + arr[0] + "[]']:eq(" + arr[
                                        1] + ")");
                                } else {
                                    var name = $('[name=' + key + ']');
                                }
                                name.parent().append(
                                    '<small class="text-danger text_error">' + val[
                                        0] + '</small>');
                                return false;
                            });
                        } else if (response.success) {
                            form.unbind().submit();
                        }
                    },
                    error: function(jqXHR, ajaxOptions, thrownError) {
                        Swal.fire({
                            title: 'Error!',
                            text: thrownError,
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        })
                    }
                });
            });
        });
    </script>
@endpush
