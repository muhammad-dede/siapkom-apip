@extends('layouts.app')

@section('title', 'Tambah Pangkat')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3">Tambah Pangkat</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('pangkat.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_pangkat" class="form-label">Nama Pangkat</label>
                                <input type="text" class="form-control @error('nama_pangkat') is-invalid @enderror"
                                    id="nama_pangkat" value="{{ old('nama_pangkat') }}" name="nama_pangkat" />
                                @error('nama_pangkat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="{{ route('pangkat.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
