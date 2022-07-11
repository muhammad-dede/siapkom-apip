@extends('layouts.app')

@section('title', 'Diklat-Ku')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-3"><span class="text-muted fw-light">Diklat-Ku</span></h4>
        @if (Session::has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                @foreach (refStatus() as $row)
                    <li class="nav-item">
                        <button type="button" class="nav-link {{ $row->id_status == 1 ? 'active' : '' }}" role="tab"
                            data-bs-toggle="tab" data-bs-target="#navs-justified-{{ $row->id_status }}"
                            aria-controls="navs-justified-{{ $row->id_status }}"
                            aria-selected="{{ $row->id_status == 1 ? 'true' : 'false' }}">
                            {{ $row->nama_status }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach (refStatus() as $row)
                    <div class="tab-pane fade {{ $row->id_status == 1 ? 'show active' : '' }}"
                        id="navs-justified-{{ $row->id_status }}" role="tabpanel">
                        <div class="table-responsive pb-3">
                            <table class="table dataTable" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="25">No</th>
                                        <th>Pegawai</th>
                                        <th>Diklat</th>
                                        <th>Tahun</th>
                                        <th class="text-center" width="100">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0" id="table-data">
                                    @foreach (getPesertaByPegawai($row->id_status) as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->pegawai ? $row->pegawai->nama_pegawai : '' }}
                                            </td>
                                            <td>{{ $row->nama_diklat }}</td>
                                            <td>{{ $row->tahun }}
                                            <td class="text-center">
                                                <a href="{{ route('diklatku.edit', $row->id_peserta) }}"
                                                    class="btn btn-sm btn-info my-1" title="Edit">
                                                    <i class="tf-icons bx bx-edit-alt"></i>
                                                </a>
                                                <a href="{{ route('diklatku.detail', $row->id_peserta) }}"
                                                    class="btn btn-sm btn-primary my-1" title="Detail">
                                                    <i class="tf-icons bx bx-show"></i>
                                                </a>
                                                {{-- @if ($row->id_status == 4)
                                                    <form action="{{ route('diklatku.destroy', $row->id_peserta) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger my-1"
                                                            title="Delete">
                                                            <i class="tf-icons bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable({
                "pageLength": 25,
            });
        });
    </script>
@endpush
