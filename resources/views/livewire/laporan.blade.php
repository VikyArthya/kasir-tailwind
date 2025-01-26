<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="container mx-auto p-4">
                    <div class="card bg-base-100 shadow-lg">
                        <div class="card-body">
                            <h4 class="card-title">Laporan Transaksi</h4>
                            @if ($pilihanMenu == 'tutup')
                                <a href="{{ url('/cetak') }}" target="_blank">Cetak</a>
                                <table class="table">
                                    <thead>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>No Invoice</th>
                                        <th>Total</th>
                                        <th>Aksi</th>

                                    </thead>
                                    <tbody>
                                        @foreach ($semuaTransaksi as $transaksi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transaksi->created_at }}</td>
                                                <td>{{ $transaksi->kode }}</td>
                                                <td>Rp. {{ number_format($transaksi->total, 2, '.', ',') }}</td>
                                                <td>
                                                    <button wire:click="pilihMenu({{ $transaksi->id }})" class="btn">
                                                        Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @elseif ($pilihanMenu == 'lihat' && $transaksiTerpilih)
                                    <div class="card border-primary">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>No Invoice</th>
                                                    <th>Total</th>
                                                    <th>Jumlah</th>
                                                    <th>Nama</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($transaksiTerpilih->detilTransaksi as $index => $detil)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $transaksiTerpilih->created_at }}</td>
                                                            <td>{{ $transaksiTerpilih->kode }}</td>
                                                            <td>{{ $transaksiTerpilih->total }}</td>
                                                            <td>{{ $detil->jumlah }}</td>
                                                            <td>{{ $detil->produk->nama }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            @endif


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
