@extends('layouts.app')

@section('title', 'Edit Golongan')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Edit Golongan</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('golongan.update', $golongan->id_golongan) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="nama_golongan" class="form-label">Nama Golongan</label>
                                <input type="text" class="form-control @error('nama_golongan') is-invalid @enderror"
                                    id="nama_golongan" value="{{ old('nama_golongan') ?? $golongan->nama_golongan }}"
                                    name="nama_golongan" />
                                @error('nama_golongan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('golongan.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
