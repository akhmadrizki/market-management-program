<table>
    <thead>
        <tr>
            <th>Laporan Harian {{ $daily }}</th>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th style="border: 1px solid black; font-weight:bold">No</th>
            <th style="border: 1px solid black; font-weight:bold">Tanggal</th>
            <th style="border: 1px solid black; font-weight:bold">Keterangan</th>
            <th style="border: 1px solid black; font-weight:bold">Operator</th>
            <th style="border: 1px solid black; font-weight:bold; background-color: #baf7b1;">Pemasukan</th>
            <th style="border: 1px solid black; font-weight:bold; background-color: #dc3546">Pengeluaran</th>
            <th style="border: 1px solid black; font-weight:bold; background-color: #435ebe">Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($final as $keuangan)
        <tr>
            <td style="border: 1px solid black;">{{ $loop->iteration }}</td>
            <td style="border: 1px solid black;">{{ $keuangan->tanggal }}</td>
            <td style="border: 1px solid black;">{{ $keuangan->keterangan }}</td>
            <td style="border: 1px solid black;">{{ $keuangan->operator }}</td>
            <td style="border: 1px solid black; background-color: #baf7b1">
                {{$keuangan->pemasukan }}
            </td>
            <td style="border: 1px solid black; background-color: #dc3546">
                {{ $keuangan->pengeluaran }}
            </td>
            <td style="border: 1px solid black; background-color: #435ebe">
                {{ $keuangan->saldo }}
            </td>
        </tr>
        @endforeach
        <tr>
            <th style="border: 1px solid black;" colspan="4" class="text-success">Total</th>
            <th class="text-success" style="border: 1px solid black; background-color: #baf7b1">
                {{ $uangmasuk }}
            </th>
            <th class="text-danger" style="border: 1px solid black; background-color: #dc3546">
                {{ $uangkeluar }}
            </th>
            <th class="text-dark" style="border: 1px solid black; background-color: #435ebe">
                @if (!$totalsaldo)
                0
                @else
                {{ $totalsaldo }}
                @endif
            </th>
        </tr>
    </tbody>
</table>