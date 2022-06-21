<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Jabatan</th>
            <th>Tahun</th>
            <th>ABK</th>
            <th>Eksisting</th>
            <th>Bezeting</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $row->jabatan ? $row->jabatan->nama_jabatan : '' }}
                </td>
                <td>
                    {{ $row->tahun }}
                </td>
                <td>
                    {{ $row->abk }}
                </td>
                <td>
                    <?php
                    $existing = \App\Models\Pegawai::where('id_jabatan', $row->id_jabatan)->count();
                    ?>
                    {{ $existing }}
                </td>
                <td>
                    <?php
                    $existing = \App\Models\Pegawai::where('id_jabatan', $row->id_jabatan)->count();
                    ?>
                    {{ $existing - $row->abk }}
                </td>
                <td>
                    {{ $row->keterangan }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
