@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Tambah Pegawai</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                                <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror"
                                    id="nama_pegawai" value="{{ old('nama_pegawai') }}" name="nama_pegawai" />
                                @error('nama_pegawai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                    value="{{ old('nip') }}" name="nip" />
                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="id_pangkat" class="form-label">Pangkat</label>
                                    <select class="form-select @error('id_pangkat') is-invalid @enderror" id="id_pangkat"
                                        aria-label="Pilih" name="id_pangkat">
                                        <option value="" selected></option>
                                        @foreach (refPangkat() as $row)
                                            <option value="{{ $row->id_pangkat }}"
                                                {{ old('id_pangkat') == $row->id_pangkat ? 'selected' : '' }}>
                                                {{ $row->nama_pangkat }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pangkat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="id_golongan" class="form-label">Golongan</label>
                                    <select class="form-select @error('id_golongan') is-invalid @enderror" id="id_golongan"
                                        aria-label="Pilih" name="id_golongan">
                                        <option value="" selected></option>
                                        @foreach (refGolongan() as $row)
                                            <option value="{{ $row->id_golongan }}"
                                                {{ old('id_golongan') == $row->id_golongan ? 'selected' : '' }}>
                                                {{ $row->nama_golongan }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_golongan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="id_jabatan" class="form-label">Jabatan</label>
                                <select class="form-select @error('id_jabatan') is-invalid @enderror" id="id_jabatan"
                                    aria-label="Pilih" name="id_jabatan">
                                    <option value="" selected></option>
                                    @foreach (refJabatan() as $row)
                                        <option value="{{ $row->id_jabatan }}"
                                            {{ old('id_jabatan') == $row->id_jabatan ? 'selected' : '' }}>
                                            {{ $row->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                                @error('id_jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary">Kembali</a>
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
