@extends('layouts.app')

@section('title', 'Detail Peserta')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row pt-1 pb-2">
            <div class="col-auto me-auto pt-1">
                <h4 class="fw-bold">Detail Peserta</h4>
            </div>
            <div class="col-auto">
                @if ($peserta->id_status == 1)
                    <button id="btn-verifikasi" type="button" class="btn btn-warning me-2">Verifikasi</button>
                @endif
                @if ($peserta->id_status == 2)
                    <button id="btn-sertifikat" type="button" class="btn btn-primary me-2">Upload Sertifikat</button>
                @endif
                <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary">Kembali</a>
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

    {{-- Modal Verifikasi --}}
    <div class="modal fade" id="modal-verifikasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Verifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-verifikasi" class="form"
                    action="{{ route('peserta.verifikasi', $peserta->id_peserta) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <small class="form-label d-block">Status</small>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="id_status" id="proses"
                                        value="2" checked />
                                    <label class="form-check-label" for="proses">Proses</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="id_status" id="tolak"
                                        value="4" />
                                    <label class="form-check-label" for="tolak">Tolak</label>
                                </div>
                            </div>
                        </div>
                        {{-- Input Terima --}}
                        <div class="realisasi">
                            <div class="divider">
                                <div class="divider-text">PROSES</div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">No Surat Perintah Tugas</label>
                                    <input type="text" class="form-control" name="no_spt" id="no_spt">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">File Surat Perintah Tugas</label>
                                    <input type="file" class="form-control" name="file_spt" id="file_spt">
                                    <small>Max: 2Mb | Ekstensi: pdf. </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Jumlah Anggaran</label>
                                    <input type="number" class="form-control" name="anggaran" id="anggaran">
                                </div>
                            </div>
                        </div>
                        {{-- Input Tolak --}}
                        <div class="keterangan_tolak">
                            <div class="divider">
                                <div class="divider-text">TOLAK</div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Alasan Ditolak</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="3"></textarea>
                                </div>
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

    {{-- Modal Sertifikat --}}
    <div class="modal fade" id="modal-sertifikat" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Upload Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-sertifikat" class="form"
                    action="{{ route('peserta.sertifikat', $peserta->id_peserta) }}" method="POST"
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

            $("#btn-verifikasi").on("click", function(event) {
                event.preventDefault();
                $("#modal-verifikasi").modal("show");
                verifikasi();
            });
            $('input[type=radio][name=id_status]').change(function() {
                verifikasi();
            });

            function verifikasi() {
                var id_status = $('input[name="id_status"]:checked').val();
                if (id_status === '2') {
                    $(".realisasi").show();
                    $(".keterangan_tolak").hide();
                } else if (id_status === '4') {
                    $(".realisasi").hide();
                    $(".keterangan_tolak").show();
                } else {
                    $(".realisasi").hide();
                    $(".keterangan_tolak").hide();
                }
            }

            $("#btn-sertifikat").on("click", function(event) {
                event.preventDefault();
                $("#modal-sertifikat").modal("show");
            });

            $(".form").on("submit", function(event) {
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
