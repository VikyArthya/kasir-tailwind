<div>

    <div class="container mx-auto p-4">
        <div class="row mt-2">
            <div class="col-12">
                @if (!$transaksiAktif)
                    <button class="btn btn-primary" wire:click='transaksiBaru'>Transaksi Baru</button>
                @else
                    <button class="btn btn-danger" wire:click='batalTransaksi'>Batalkan Transaksi</button>
                @endif
                <button class="loading loading-spinner loading-lg" wire:loading>Loading...</button>
            </div>
        </div>
        @if ($transaksiAktif)
            <div class="grid grid-cols-12 gap-4 mt-4">
                <div class="col-span-8">
                    <div class="card shadow-lg">
                        <div class="card-body">

                            <h4 class="label-text">No Invoice {{ $transaksiAktif->kode }}</h4>
                            <input type="text" class="input input-bordered w-full max-w-xs" placeholder="Kode Barang"
                                wire:model.live='kode'>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semuaProduk as $produk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $produk->produk->kode }}</td>
                                            <td>{{ $produk->produk->nama }}</td>
                                            <td>{{ number_format($produk->produk->harga, 2, '.', ',') }}</td>
                                            <td><input type="number" class="input input-bordered w-full max-w-xs"
                                                    wire:model.lazy="jumlah.{{ $produk->id }}" class="form-control">
                                            </td>
                                            <td>
                                                @php
                                                    $hargaSatuan = $produk->produk->harga;
                                                    $jumlah = $produk->jumlah;
                                                    $subtotal =
                                                        $jumlah > 10
                                                            ? $hargaSatuan * 0.9 * $jumlah
                                                            : $hargaSatuan * $jumlah;
                                                @endphp
                                                {{ number_format($subtotal, 2, '.', ',') }}
                                            </td>

                                            <td>
                                                <button class="btn btn-danger"
                                                    wire:click='hapusProduk({{ $produk->id }})'>
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 space-y-4">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h4 class="label-text">Total Biaya</h4>
                            <div class="input input-bordered w-full max-w-xs">
                                <span>Rp. </span>
                                <span>{{ number_format($totalSemuaBelanja, 2, '.', '') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h4 class="label-text">Bayar</h4>
                            <input type="number" class="input input-bordered w-full max-w-xs" placeholder="bayar"
                                wire:model.live='bayar'>
                        </div>
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h4 class="label-text">Kembalian</h4>
                            <div class="input input-bordered w-full max-w-xs">
                                <span>Rp. </span>
                                <span>{{ number_format($kembalian, 2, '.', '') }}</span>
                            </div>
                        </div>
                    </div>
                    @if ($bayar)
                        @if ($kembalian < 0)
                            <div class="alert alert-danger mt-2" role="alert">
                                Uang Kurang
                            </div>
                        @elseif($kembalian > 0)
                            <button class="btn btn-success mt-2 w-100" wire:click='transaksiSelesai'>Bayar</button>
                        @endif
                    @endif
                </div>

            </div>
        @endif
    </div>

    <script src="{{ asset('index.js') }}"></script>
</div>
