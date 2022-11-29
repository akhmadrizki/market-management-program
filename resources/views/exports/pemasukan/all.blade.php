<table>
    <thead>
        <tr>
            <th>Laporan Seluruh Pemasukan</th>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th style="border: 1px solid black; font-weight:bold">Nama Penyewa</th>
            <th style="border: 1px solid black; font-weight:bold">Jenis</th>
            <th style="border: 1px solid black; font-weight:bold">Nomor</th>
            <th style="border: 1px solid black; font-weight:bold">Jenis Sewa</th>
            <th style="border: 1px solid black; font-weight:bold">Biaya Sewa</th>
            <th style="border: 1px solid black; font-weight:bold">Dibayarkan</th>
            <th style="border: 1px solid black; font-weight:bold">Tunggakan</th>
            <th style="border: 1px solid black; font-weight:bold">Tanggal</th>
            <th style="border: 1px solid black; font-weight:bold">Operator</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemasukans as $pemasukan)
        <tr>
            <td style="border: 1px solid black;">{{ $pemasukan->kontrak->penyewa->name }}</td>
            <td style="border: 1px solid black;">{{ $pemasukan->kontrak->jenisToko->name }}</td>
            <td style="border: 1px solid black;">{{ $pemasukan->kontrak->no_toko }}</td>
            <td style="border: 1px solid black;">{{ $pemasukan->kontrak->jenis_kontrak }}</td>
            <td style="border: 1px solid black;">{{ $pemasukan->biaya_sewa }}</td>
            <td style="border: 1px solid black;">{{ $pemasukan->dibayarkan }}</td>
            <td style="border: 1px solid black;">{{ $pemasukan->kontrak->tunggakan }}</td>
            <td style="border: 1px solid black;">{{ $pemasukan->tanggal}}</td>
            <td style="border: 1px solid black;">{{ $pemasukan->user->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>