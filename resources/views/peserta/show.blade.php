@extends('layouts.app')

@section('title', 'Detail Peserta')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row pt-1 pb-2">
            <div class="col-auto me-auto pt-1">
                <h4 class="fw-bold">Detail Peserta</h4>
            </div>
            <div class="col-auto">
                <form action="{{ route('peserta.terima', $peserta->id_peserta) }}" id="form-terima" method="POST"
                    class="d-inline">
                    @csrf
                    <button id="btn-verifikasi" type="button" class="btn btn-warning me-2">Verifikasi</button>
                    <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary">Kembali</a>
                </form>
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
                <h5>Data Pegawai</h5>
                <hr>
                <table class="mb-4">
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peserta->pegawai ? $peserta->pegawai->nama_pegawai : '' }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peserta->pegawai ? $peserta->pegawai->nip : '' }}</td>
                        </tr>
                        <tr>
                            <td>Pangkat/Golongan</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                {{ $peserta->pegawai ? ($peserta->pegawai->pangkat ? $peserta->pegawai->pangkat->nama_pangkat : '') : '' }}
                                {{ $peserta->pegawai ? ($peserta->pegawai->golongan ? '(' . $peserta->pegawai->golongan->nama_golongan . ')' : '') : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                {{ $peserta->pegawai ? ($peserta->pegawai->jabatan ? $peserta->pegawai->jabatan->nama_jabatan : '') : '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h5>Data Diklat</h5>
                <hr>
                <table class="mb-4">
                    <tbody>
                        <tr>
                            <td>Nama Diklat</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peserta->diklat ? $peserta->diklat->nama_diklat : '' }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Diklat</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peserta->jenisDiklat ? $peserta->jenisDiklat->nama_jenis_diklat : '' }}</td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peserta->tahun }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                {{ \Carbon\Carbon::parse($peserta->tgl_mulai)->isoFormat('D-MM-Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                {{ \Carbon\Carbon::parse($peserta->tgl_selesai)->isoFormat('D-MM-Y') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h5>Status Peserta</h5>
                <hr>
                <table class="mb-4">
                    <tbody>
                        <tr>
                            <td>Status</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>
                                <span
                                    class="badge bg-{{ $peserta->status->color }}">{{ $peserta->status->nama_status }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ $peserta->keterangan }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-tolak" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Verifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-tolak" action="{{ route('peserta.tolak', $peserta->id_peserta) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Alasan Ditolak</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="3"></textarea>
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
            $("#btn-verifikasi").on("click", function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Verifikasi',
                    text: "Verifikasi Pendaftaran!",
                    icon: 'info',
                    showCancelButton: true,
                    showDenyButton: true,
                    confirmButtonText: 'Terima',
                    denyButtonText: 'Tolak',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form-terima").submit();
                    } else if (result.isDenied) {
                        $("#modal-tolak").modal("show");
                    }
                })
            });

            $("#form-tolak").on("submit", function(event) {
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
