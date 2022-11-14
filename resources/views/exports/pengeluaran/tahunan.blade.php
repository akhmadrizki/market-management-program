<table>
    <thead>
        <tr>
            <th>Laporan Pengeluaran {{ $yearly }}</th>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th style="border: 1px solid black; font-weight:bold">Keterangan</th>
            <th style="border: 1px solid black; font-weight:bold">Tanggal</th>
            <th style="border: 1px solid black; font-weight:bold">Operator</th>
            <th style="border: 1px solid black; font-weight:bold">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengeluarans as $pengeluaran)
        <tr>
            <td style="border: 1px solid black;">{{ $pengeluaran->desc }}</td>
            <td style="border: 1px solid black;">{{ $pengeluaran->tanggal }}</td>
            <td style="border: 1px solid black;">{{ $pengeluaran->user->name }}</td>
            <td style="border: 1px solid black;">{{ $pengeluaran->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>