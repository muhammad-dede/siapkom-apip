@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Halo, {{ auth()->user()->nama }}! 🎉</h5>
                                <p class="mb-4">
                                    Selamat datang di {{ config('app.name_2') }} ({{ config('app.name') }})
                                </p>
                                @if (auth()->user()->id_role !== 3)
                                    <a href="{{ route('peserta.create') }}"
                                        class="btn btn-sm btn-outline-primary">Pendaftaran</a>
                                @else
                                    <a href="{{ route('diklatku.create') }}"
                                        class="btn btn-sm btn-outline-primary">Pendaftaran</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('') }}public/template/assets/img/illustrations/man-with-laptop-light.png"
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
