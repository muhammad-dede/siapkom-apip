<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama Pegawai</th>
            <th>Pangkat/Golongan</th>
            <th>Jabatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>'{{ $row->nip }}</td>
                <td>{{ $row->nama_pegawai }}</td>
                <td>
                    {{ $row->pangkat ? $row->pangkat->nama_pangkat : '' }}
                    {{ $row->golongan ? '(' . $row->golongan->nama_golongan . ')' : '' }}
                </td>
                <td>
                    {{ $row->jabatan ? $row->jabatan->nama_jabatan : '' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
