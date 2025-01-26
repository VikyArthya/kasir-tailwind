<div>


    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Semua Pengguna
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Tambah Pengguna
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
                                Semua Pengguna
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Peran</th>
                                        <th>Data</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($semuaPengguna as $pengguna)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pengguna->name }}</td>
                                                <td>{{ $pengguna->email }}</td>
                                                <td>{{ $pengguna->peran }}</td>
                                                <td>
                                                    <button wire:click="pilihEdit({{ $pengguna->id }})"
                                                        class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                        Edit Pengguna
                                                    </button>
                                                    <button wire:click="pilihHapus ({{ $pengguna->id }})"
                                                        class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                        Hapus Pengguna
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
                                Tambah Pengguna
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
                                    <label for="" class="form-control w-full max-w-xs">Email</label>
                                    <input type="email" class="input input-bordered w-full max-w-xs"
                                        wire:model='email'>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for="" class="form-control w-full max-w-xs">Peran</label>
                                    <select name="" id="" class="input input-bordered w-full max-w-xs"
                                        wire:model="peran">
                                        <option value="">---Pilih Peran---</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @error('peran')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for="" class="form-control w-full max-w-xs">Password</label>
                                    <input type="passowrd" class="input input-bordered w-full max-w-xs"
                                        wire:model='password'>
                                    @error('password')
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
                                Edit Pengguna
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
                                    <label for="" class="form-control w-full max-w-xs">Email</label>
                                    <input type="email" class="input input-bordered w-full max-w-xs"
                                        wire:model='email'>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for=""
                                        class="form-control w-full max-w-xs"><span>Peran</span></label>
                                    <select name="" id="" class="input input-bordered w-full max-w-xs"
                                        wire:model="peran">
                                        <option value="">---Pilih Peran---</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @error('peran')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <label for=""
                                        class="form-control w-full max-w-xs"><span>Password</span></label>
                                    <input type="passowrd" class="input input-bordered w-full max-w-xs"
                                        wire:model='password'>
                                    @error('password')
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
                            Hapus Pengguna
                        </div>
                        <div class="card-body">
                            Anda yakin menghapus pengguna ini ?
                            <p>Nama : {{ $penggunaTerpilih->name }}</p>
                            <button class="btn btn-danger" wire:click='hapus'>Hapus</button>
                            <button class="btn btn-danger" wire:click='batal'>Batal</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


</div>
