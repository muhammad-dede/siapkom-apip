@extends('layouts.app')

@section('title', 'Edit Pendaftaran Diklat')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Edit Pendaftaran Diklat</h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Formulir Edit Pendaftaran Diklat</h4>
                        <small>Silahkan lengkapi data-data berikut ini dengan benar dan lengkap!</small>
                    </div>
                    <div class="card-body">
                        <form id="form-edit-peserta" action="{{ route('peserta.update', $peserta->id_peserta) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="peserta">
                                <div class="mb-3">
                                    <label for="id_pegawai" class="form-label">Pegawai</label>
                                    <select class="form-select select2" id="id_pegawai" aria-label="Pilih"
                                        name="id_pegawai">
                                        <option value="" selected></option>
                                        @foreach (getPegawai() as $row)
                                            <option value="{{ $row->id_pegawai }}"
                                                {{ $peserta->id_pegawai == $row->id_pegawai ? 'selected' : '' }}>
                                                {{ $row->nip }}&nbsp;-&nbsp;{{ $row->nama_pegawai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="id_diklat" class="form-label">Diklat</label>
                                    <select class="form-select select2" id="id_diklat" aria-label="Pilih" name="id_diklat">
                                        <option value="" selected></option>
                                        @foreach (refDiklat() as $row)
                                            @if ($row->id_diklat !== 1)
                                                <option value="{{ $row->id_diklat }}"
                                                    {{ $peserta->id_diklat == $row->id_diklat ? 'selected' : '' }}>
                                                    {{ $row->nama_diklat }}
                                                </option>
                                            @endif
                                        @endforeach
                                        <option value="1" {{ $peserta->id_diklat == 1 ? 'selected' : '' }}>LAINNYA
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3" id="diklat_lainnya">
                                    <label for="nama_diklat" class="form-label">Nama Diklat</label>
                                    <input type="text" class="form-control" id="nama_diklat" name="nama_diklat"
                                        value="{{ $peserta->nama_diklat }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <select class="form-select" id="tahun" aria-label="Pilih" name="tahun">
                                        <option value=""></option>
                                        @foreach (getTahun() as $row)
                                            <option value="{{ $row['tahun'] }}"
                                                {{ $peserta->tahun == $row['tahun'] ? 'selected' : '' }}>
                                                {{ $row['tahun'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai"
                                            value="{{ $peserta->tgl_mulai }}" />
                                    </div>
                                    <div class="col">
                                        <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai"
                                            value="{{ $peserta->tgl_selesai }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="tempat" class="form-label">Tempat</label>
                                        <input type="text" class="form-control" id="tempat" name="tempat"
                                            value="{{ $peserta->tempat }}" />
                                    </div>
                                    <div class="col">
                                        <label for="jam_pelatihan" class="form-label">Jam Pelatihan</label>
                                        <input type="number" class="form-control" id="jam_pelatihan" name="jam_pelatihan"
                                            value="{{ $peserta->jam_pelatihan }}" />
                                    </div>
                                </div>
                            </div>
                            @if ($peserta->realisasi)
                                <div class="realisasi">
                                    <div class="mb-3">
                                        <label for="no_spt" class="form-label">No Surat Perintah Tugas</label>
                                        <input type="text" class="form-control" id="no_spt" name="no_spt"
                                            value="{{ $peserta->realisasi->no_spt }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="file_spt" class="form-label">File Surat Perintah Tugas</label>
                                        <input type="file" class="form-control" id="file_spt" name="file_spt" />
                                        <small>Max: 2Mb | Ekstensi: pdf. </small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="anggaran" class="form-label">Jumlah Anggaran</label>
                                        <input type="text" class="form-control" id="anggaran" name="anggaran"
                                            value="{{ $peserta->realisasi->anggaran }}" />
                                    </div>
                                </div>
                            @endif
                            @if ($peserta->sertifikat)
                                <div class="sertifikat">
                                    <div class="mb-3">
                                        <label for="file_sertifikat" class="form-label">File Sertifikat</label>
                                        <input type="file" class="form-control" id="file_sertifikat"
                                            name="file_sertifikat" />
                                        <small>Max: 2Mb | Ekstensi: pdf. </small>
                                    </div>
                                </div>
                            @endif
                            @if ($peserta->keteranganTolak)
                                <div class="keterangan_tolak">
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Alasan Ditolak</label>
                                        <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control">{{ $peserta->keteranganTolak->keterangan }}</textarea>
                                    </div>
                                </div>
                            @endif
                            <div class="mt-3 border-top py-3">
                                <button type="submit" id="btn-simpan" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: "bootstrap-5",
                width: '100%'
            });

            diklat_lainnya();

            function diklat_lainnya() {
                var id_diklat = $("#id_diklat").val();
                if (id_diklat === '1') {
                    $('#diklat_lainnya').show();
                } else {
                    $('#diklat_lainnya').hide();
                }
            }

            $('#id_diklat').on("change", function() {
                diklat_lainnya();
            });

            $("#form-edit-peserta").on("submit", function(event) {
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
                        $('.btn-simpan').attr('disabled', 'disabled');
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
                                $('html, body').animate({
                                    scrollTop: name.offset().top - 200
                                }, 'slow');
                                return false;
                            });
                        } else if (response.success) {
                            form.unbind().submit();
                        } else if (response.invalid) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.invalid,
                            })
                        }
                        $('.btn-simpan').removeAttr('disabled', 'disabled');
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
