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
                            <div class="mb-3">
                                <label for="id_pegawai" class="form-label">Pegawai</label>
                                <select class="form-select select2" id="id_pegawai" aria-label="Pilih" name="id_pegawai">
                                    <option value="" selected></option>
                                    @foreach (getPegawai() as $row)
                                        <option value="{{ $row->id_pegawai }}"
                                            {{ $peserta->id_pegawai == $row->id_pegawai ? 'selected' : '' }}>
                                            {{ $row->nip }}&nbsp;-&nbsp;{{ $row->nama_pegawai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_jenis_diklat" class="form-label">Jenis Diklat</label>
                                <select class="form-select" id="id_jenis_diklat" aria-label="Pilih" name="id_jenis_diklat">
                                    <option value=""></option>
                                    @foreach (refJenisDiklat() as $row)
                                        <option value="{{ $row->id_jenis_diklat }}"
                                            {{ $peserta->id_jenis_diklat == $row->id_jenis_diklat ? 'selected' : '' }}>
                                            {{ $row->nama_jenis_diklat }}
                                        </option>
                                    @endforeach
                                </select>
                                <small>Pilih jenis diklat untuk menampilkan nama diklat.</small>
                            </div>
                            <div class="mb-3">
                                <label for="id_diklat" class="form-label">Nama Diklat</label>
                                <select class="form-select select2" id="id_diklat" aria-label="Pilih" name="id_diklat">
                                </select>
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
                            <div class="mb-3">
                                <label for="tempat" class="form-label">Tempat</label>
                                <textarea class="form-control" name="tempat" id="tempat" cols="30" rows="3">{{ $peserta->tempat }}</textarea>
                            </div>
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

            data_diklat();

            $("#id_jenis_diklat").on("change", function() {
                data_diklat();
            });

            function data_diklat() {
                var id_jenis_diklat = $("#id_jenis_diklat").val();
                var id_diklat = "{{ $peserta->id_diklat }}";
                if (id_jenis_diklat == "") {
                    $("#id_diklat").prop('disabled', 'disabled');
                    $('#id_diklat').empty();
                } else {
                    $("#id_diklat").prop('disabled', false);;
                    $.ajax({
                        url: "{{ route('peserta.edit', $peserta->id_peserta) }}",
                        method: "GET",
                        data: {
                            id_jenis_diklat: id_jenis_diklat
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $('#id_diklat').empty();
                                $('#id_diklat').append('<option hidden></option>');
                                $.each(response, function(key, diklat) {
                                    $('#id_diklat').append(`
                                        <option value="` + diklat.id_diklat + `" ` + (diklat.id_diklat == id_diklat ?
                                        `selected` : ``) + `>` + diklat.nama_diklat + `</option>
                                    `);
                                });
                            } else {
                                $('#id_diklat').empty();
                            }
                        }
                    });
                }
            }

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
