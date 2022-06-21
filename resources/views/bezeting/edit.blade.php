@extends('layouts.app')

@section('title', 'Edit Bezeting')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Edit Bezeting</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('bezeting.update', $bezeting->id_bezeting) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select class="form-select @error('tahun') is-invalid @enderror select2" id="tahun"
                                    aria-label="Pilih" name="tahun">
                                    <option value="" selected></option>
                                    @foreach (getTahun() as $row)
                                        <option value="{{ $row['tahun'] }}"
                                            {{ old('tahun') ?? $bezeting->tahun == $row['tahun'] ? 'selected' : '' }}>
                                            {{ $row['tahun'] }}</option>
                                    @endforeach
                                </select>
                                @error('tahun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="id_jabatan" class="form-label">Jabatan</label>
                                <select class="form-select @error('id_jabatan') is-invalid @enderror select2"
                                    id="id_jabatan" aria-label="Pilih" name="id_jabatan">
                                    <option value="" selected></option>
                                    @foreach (refJabatan() as $row)
                                        <option value="{{ $row->id_jabatan }}"
                                            {{ old('id_jabatan') ?? $bezeting->id_jabatan == $row->id_jabatan ? 'selected' : '' }}>
                                            {{ $row->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                                @error('id_jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="abk" class="form-label">Analisa Beban Kerja</label>
                                <input type="number" class="form-control @error('abk') is-invalid @enderror" id="abk"
                                    value="{{ old('abk') ?? $bezeting->abk }}" name="abk" />
                                @error('abk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                    id="keterangan" value="{{ old('keterangan') ?? $bezeting->keterangan }}"
                                    name="keterangan" />
                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('bezeting.index') }}" class="btn btn-outline-secondary">Kembali</a>
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
        });
    </script>
@endpush
