<div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
    <div class="container mx-auto p-4">
        <div class="card bg-base-100 shadow-lg">
            <div class="card-body">
                <h4 class="card-title text-lg font-bold mb-4">Laporan Transaksi</h4>


                <div class="flex justify-between items-center mb-6">
                    <a href="{{ url('/laporan/view/pdf') }}" target="_blank" class="btn btn-primary no-print">
                        Cetak
                    </a>
                    <div class="flex items-center gap-2 no-print">
                        <input type="date" wire:model="startDate" class="input input-bordered">
                        <input type="date" wire:model="endDate" class="input input-bordered">
                        <button wire:click="filterTransaksi" class="btn btn-secondary">
                            Filter
                        </button>
                    </div>
                </div>

                <!-- Tabel Transaksi -->
                @if ($pilihanMenu == 'tutup')
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>No Invoice</th>
                                <th>Total</th>
                                <th class="no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaTransaksi as $transaksi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaksi->created_at }}</td>
                                    <td>{{ $transaksi->kode }}</td>
                                    <td>Rp. {{ number_format($transaksi->total, 2, '.', ',') }}</td>
                                    <td class="no-print">
                                        <button wire:click="pilihMenu({{ $transaksi->id }})"
                                            class="btn btn-sm btn-accent">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif ($pilihanMenu == 'lihat' && $transaksiTerpilih)
                    <div class="card border-primary mt-4">
                        <div class="card-body">
                            <table class="table w-full">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>No Invoice</th>
                                        <th>Total</th>
                                        <th>Jumlah</th>
                                        <th>Nama</th>
                                    </tr>
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
            </div>
        </div>
    </div>


</div>
