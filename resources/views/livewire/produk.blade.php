<div>


    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Semua produk
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Tambah produk
                </button>
                <button wire:click="pilihMenu('excel')"
                    class="btn {{ $pilihanMenu == 'excel' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Import produk
                </button>
                <button wire:loading class="loading loading-spinner loading-lg">
                    Loading...
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                @if ($pilihanMenu == 'lihat')
                    <div class="container mx-auto p-4">
                        <div class="card bg-base-100 shadow-lg">
                            <div class="card-header">
                                Semua produk
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Data</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($semuaProduk as $produk)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $produk->kode }}</td>
                                                <td>{{ $produk->nama }}</td>
                                                <td>{{ $produk->harga }}</td>
                                                <td>{{ $produk->stok }}</td>

                                                <td>
                                                    <button wire:click="pilihEdit({{ $produk->id }})"
                                                        class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                        Edit produk
                                                    </button>
                                                    <button wire:click="pilihHapus ({{ $produk->id }})"
                                                        class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                        Hapus produk
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'tambah')
                    <div class="container mx-auto p-4">
                        <div class="card bg-base-100 shadow-lg">
                            <div class="card-header">
                                Tambah produk
                            </div>
                            <div class="card-body">
                                <form wire:submit='simpan'>
                                    <label class="form-control w-full max-w-xs">Nama</label>
                                    <input type="text" class="input input-bordered w-full max-w-xs"
                                        wire:model='nama'>
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for="" class="form-control w-full max-w-xs">Kode / Barcode</label>
                                    <input type="kode" class="input input-bordered w-full max-w-xs"
                                        wire:model='kode'>
                                    @error('kode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for="" class="form-control w-full max-w-xs">stok</label>
                                    <input type="stok" class="input input-bordered w-full max-w-xs"
                                        wire:model='stok'>


                                    @error('stok')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for="" class="form-control w-full max-w-xs">harga</label>
                                    <input type="passowrd" class="input input-bordered w-full max-w-xs"
                                        wire:model='harga'>
                                    @error('harga')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>

                                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'edit')
                    <div class="container mx-auto p-4">
                        <div class="card bg-base-100 shadow-lg">
                            <div class="card-header">
                                Edit produk
                            </div>
                            <div class="card-body">
                                <form wire:submit='simpanEdit'>
                                    <label class="form-control w-full max-w-xs">Nama</label>
                                    <input type="text" class="input input-bordered w-full max-w-xs"
                                        wire:model='nama'>
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for="" class="form-control w-full max-w-xs">kode</label>
                                    <input type="text" class="input input-bordered w-full max-w-xs"
                                        wire:model='kode'>
                                    @error('kode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for="" class="form-control w-full max-w-xs">Stok</label>
                                    <input type="number" class="input input-bordered w-full max-w-xs"
                                        wire:model='stok'>
                                    @error('stok')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for="" class="form-control w-full max-w-xs">Harga</label>
                                    <input type="number" class="input input-bordered w-full max-w-xs"
                                        wire:model='harga'>
                                    @error('harga')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>

                                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                    <button type="button" wire:click='batal'
                                        class="btn btn-secondary mt-3">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'hapus')
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            Hapus produk
                        </div>
                        <div class="card-body">
                            Anda yakin menghapus produk ini ?
                            <p>Nama : {{ $produkTerpilih->name }}</p>
                            <button class="btn btn-danger" wire:click='hapus'>Hapus</button>
                            <button class="btn btn-danger" wire:click='batal'>Batal</button>
                        </div>
                    </div>
                @elseif($pilihanMenu == 'excel')
                    <div class="container mx-auto p-4">
                        <div class="card bg-base-100 shadow-lg">
                            <div class="card-header">
                                Import produk
                            </div>
                            <div class="card-body">
                                <form wire:submit='imporExcel'>
                                    <input type="file"
                                        class="file-input file-input-bordered file-input-secondary w-full max-w-xs"
                                        wire:model='fileExcel'>
                                    <br>
                                    <button class="btn btn-primary mt-2" type="submit">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


</div>
