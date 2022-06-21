@extends('layouts.app')

@section('title', 'Edit Diklat')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Edit Diklat</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('diklat.update', $diklat->id_diklat) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="id_jenis_diklat" class="form-label">Kategori</label>
                                <select class="form-select @error('id_jenis_diklat') is-invalid @enderror"
                                    id="id_jenis_diklat" aria-label="Pilih" name="id_jenis_diklat">
                                    <option value="" selected></option>
                                    @foreach (refJenisDiklat() as $row)
                                        <option value="{{ $row->id_jenis_diklat }}"
                                            {{ old('id_jenis_diklat') ?? $diklat->id_jenis_diklat == $row->id_jenis_diklat ? 'selected' : '' }}>
                                            {{ $row->nama_jenis_diklat }}</option>
                                    @endforeach
                                </select>
                                @error('id_jenis_diklat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_diklat" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control @error('nama_diklat') is-invalid @enderror"
                                    id="nama_diklat" value="{{ old('nama_diklat') ?? $diklat->nama_diklat }}"
                                    name="nama_diklat" />
                                @error('nama_diklat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('diklat.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
