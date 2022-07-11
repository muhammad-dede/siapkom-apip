@extends('layouts.app')

@section('title', 'Pendaftaran Diklat')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Pendaftaran Diklat</h4>
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
                        <h4>Formulir Pendaftaran Diklat</h4>
                        <small>Silahkan lengkapi data-data berikut ini dengan benar dan lengkap!</small>
                    </div>
                    <div class="card-body">
                        <form id="form-pendaftaran" action="{{ route('diklatku.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="id_diklat" class="form-label">Diklat</label>
                                <select class="form-select select2" id="id_diklat" aria-label="Pilih" name="id_diklat">
                                    <option value="" selected></option>
                                    @foreach (refDiklat() as $row)
                                        @if ($row->id_diklat !== 1)
                                            <option value="{{ $row->id_diklat }}">
                                                {{ $row->nama_diklat }}
                                            </option>
                                        @endif
                                    @endforeach
                                    <option value="1">LAINNYA</option>
                                </select>
                            </div>
                            <div class="mb-3" id="diklat_lainnya">
                                <label for="nama_diklat" class="form-label">Nama Diklat</label>
                                <input type="text" class="form-control" id="nama_diklat" name="nama_diklat" />
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select class="form-select" id="tahun" aria-label="Pilih" name="tahun">
                                    <option value="" selected></option>
                                    @foreach (getTahun() as $row)
                                        <option value="{{ $row['tahun'] }}">
                                            {{ $row['tahun'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" />
                                </div>
                                <div class="col">
                                    <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="tempat" class="form-label">Tempat</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" />
                                </div>
                                <div class="col">
                                    <label for="jam_pelatihan" class="form-label">Jam Pelatihan</label>
                                    <input type="number" class="form-control" id="jam_pelatihan" name="jam_pelatihan" />
                                </div>
                            </div>
                            <div class="mt-3 border-top py-3">
                                <button type="submit" id="btn-daftar" class="btn btn-primary me-2">Daftar</button>
                                <button type="reset" class="btn btn-outline-secondary">Batal</button>
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

            $("#form-pendaftaran").on("submit", function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: $('input[name=_method]').val() == undefined ? 'POST' : 'POST',
                    data: new FormData(form[0]),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('.text_error').text('');
                        $('.btn-daftar').attr('disabled', 'disabled');
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
                        }

                        $('.btn-daftar').removeAttr('disabled', 'disabled');
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
