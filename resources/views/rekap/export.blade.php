<table>
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Nama Pegawai</th>
            <th rowspan="2">NIP</th>
            <th rowspan="2">Pangkat/Golongan</th>
            <th rowspan="2">Jabatan</th>
            @foreach (refJenisDiklat() as $row)
                <th colspan="{{ $row->diklat->count() }}">{{ $row->nama_jenis_diklat }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach (refJenisDiklat() as $row)
                @foreach (refDiklatByJenis($row->id_jenis_diklat) as $row)
                    <th>{!! nl2br(e($row->nama_diklat)) !!}</th>
                @endforeach
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->pegawai ? $row->pegawai->nama_pegawai : '' }}</td>
                <td>{{ $row->pegawai ? "'" . $row->pegawai->nip : '' }}</td>
                <td>
                    {{ $row->pegawai ? ($row->pegawai->pangkat ? $row->pegawai->pangkat->nama_pangkat : '') : '' }}
                    {{ $row->pegawai ? ($row->pegawai->golongan ? '(' . $row->pegawai->golongan->nama_golongan . ')' : '') : '' }}
                </td>
                <td>
                    {{ $row->pegawai ? ($row->pegawai->jabatan ? $row->pegawai->jabatan->nama_jabatan : '') : '' }}
                </td>
                @foreach (refJenisDiklat() as $jd)
                    @foreach (refDiklatByJenis($jd->id_jenis_diklat) as $d)
                        <td class="diklat">{{ $d->id_diklat === $row->id_diklat ? '1' : '' }}</td>
                    @endforeach
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
