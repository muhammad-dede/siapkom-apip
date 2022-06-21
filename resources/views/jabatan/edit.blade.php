@extends('layouts.app')

@section('title', 'Edit Jabatan')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Edit Jabatan</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('jabatan.update', $jabatan->id_jabatan) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="id_jenis_jabatan" class="form-label">Jenis</label>
                                <select class="form-select @error('id_jenis_jabatan') is-invalid @enderror"
                                    id="id_jenis_jabatan" aria-label="Pilih" name="id_jenis_jabatan">
                                    <option value="" selected></option>
                                    @foreach (refJenisJabatan() as $row)
                                        <option value="{{ $row->id_jenis_jabatan }}"
                                            {{ old('id_jenis_jabatan') ?? $jabatan->id_jenis_jabatan == $row->id_jenis_jabatan ? 'selected' : '' }}>
                                            {{ $row->nama_jenis_jabatan }}</option>
                                    @endforeach
                                </select>
                                @error('id_jenis_jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror"
                                    id="nama_jabatan" value="{{ old('nama_jabatan') ?? $jabatan->nama_jabatan }}"
                                    name="nama_jabatan" />
                                @error('nama_jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('jabatan.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
