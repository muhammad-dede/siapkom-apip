@extends('layouts.app')

@section('title', 'Detail Diklat')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row pt-1 pb-2">
            <div class="col-auto me-auto pt-1">
                <h4 class="fw-bold">Detail Diklat</h4>
            </div>
            <div class="col-auto">
                <a href="{{ route('rekap.index') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="mb-4 table">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <h5>Data Pegawai</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{ $peserta->pegawai ? $peserta->pegawai->nama_pegawai : '' }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>{{ $peserta->pegawai ? $peserta->pegawai->nip : '' }}</td>
                        </tr>
                        <tr>
                            <td>Pangkat/Golongan</td>
                            <td>
                                {{ $peserta->pegawai ? ($peserta->pegawai->pangkat ? $peserta->pegawai->pangkat->nama_pangkat : '') : '' }}
                                {{ $peserta->pegawai ? ($peserta->pegawai->golongan ? '(' . $peserta->pegawai->golongan->nama_golongan . ')' : '') : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>
                                {{ $peserta->pegawai ? ($peserta->pegawai->jabatan ? $peserta->pegawai->jabatan->nama_jabatan : '') : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <br>
                                <h5>Data Diklat</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Diklat</td>
                            <td>{{ $peserta->diklat ? $peserta->diklat->nama_diklat : '' }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Diklat</td>
                            <td>{{ $peserta->jenisDiklat ? $peserta->jenisDiklat->nama_jenis_diklat : '' }}</td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td>{{ $peserta->tahun }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>
                                {{ \Carbon\Carbon::parse($peserta->tgl_mulai)->isoFormat('D-MM-Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>
                                {{ \Carbon\Carbon::parse($peserta->tgl_selesai)->isoFormat('D-MM-Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>No Surat Perintah Tugas</td>
                            <td>
                                <span
                                    class="{{ $peserta->realisasi ? '' : 'text-danger' }}">{{ $peserta->realisasi ? $peserta->realisasi->no_spt : 'Belum Upload' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>File Surat Perintah Tugas</td>
                            <td>
                                @if ($peserta->realisasi)
                                    <a href="{{ asset('') }}public/files/spt/{{ $peserta->realisasi->file_spt }}"
                                        target="_blank">Lihat</a>
                                @else
                                    <span class="text-danger">Belum Upload</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Anggaran Diklat</td>
                            <td>
                                <span
                                    class="{{ $peserta->anggaran ? '' : 'text-danger' }}">{{ $peserta->anggaran ? 'Rp. ' . number_format($peserta->anggaran->anggaran, 2, ',', '.') : 'Belum dianggarkan' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Sertifikat</td>
                            <td>
                                @if ($peserta->sertifikat)
                                    <a href="{{ asset('') }}public/files/sertifikat/{{ $peserta->sertifikat->file_sertifikat }}"
                                        target="_blank">Lihat</a>
                                @else
                                    <span class="text-danger">Belum Upload</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <br>
                                <h5>Status</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <span
                                    class="badge bg-{{ $peserta->status->color }}">{{ $peserta->status->nama_status }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>{{ $peserta->keterangan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
