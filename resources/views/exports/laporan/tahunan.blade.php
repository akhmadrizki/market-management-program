<table>
    <thead>
        <tr>
            <th>Laporan Tahunan {{ $yearly }}</th>
        </tr>
    </thead>
</table>

<table>
    <thead>
        <tr>
            <th style="border: 1px solid black; font-weight:bold">No</th>
            <th style="border: 1px solid black; font-weight:bold">Bulan</th>
            <th style="border: 1px solid black; font-weight:bold; background-color: #baf7b1;">Pemasukan</th>
            <th style="border: 1px solid black; font-weight:bold; background-color: #fa949e">Pengeluaran</th>
            <th style="border: 1px solid black; font-weight:bold; background-color: #90a8ff">Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($final as $keuangan)
        <tr>
            <td style="border: 1px solid black;">{{ $loop->iteration }}</td>
            <td style="border: 1px solid black;">{{ $keuangan->tanggal }}</td>
            <td style="border: 1px solid black; background-color: #baf7b1">
                {{$keuangan->pemasukan }}
            </td>
            <td style="border: 1px solid black; background-color: #fa949e">
                {{ $keuangan->pengeluaran }}
            </td>
            <td style="border: 1px solid black; background-color: #90a8ff">
                {{ $keuangan->saldo }}
            </td>
        </tr>
        @endforeach
        <tr>
            <th style="border: 1px solid black;" colspan="2" class="text-success">Total</th>
            <th class="text-success" style="border: 1px solid black; background-color: #baf7b1">
                {{ $uangmasuk }}
            </th>
            <th class="text-danger" style="border: 1px solid black; background-color: #fa949e">
                {{ $uangkeluar }}
            </th>
            <th class="text-dark" style="border: 1px solid black; background-color: #90a8ff">
                @if (!$totalsaldo)
                0
                @else
                {{ $totalsaldo }}
                @endif
            </th>
        </tr>
    </tbody>
</table>
