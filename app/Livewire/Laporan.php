<?php

namespace App\Livewire;

use App\Models\DetilTransaksi;
use App\Models\Transaksi;

use Livewire\Component;

class Laporan extends Component
{
    public $pilihanMenu = 'tutup';
    public $transaksiId;

    public function pilihMenu($id)
    {
        if ($this->pilihanMenu == 'lihat' && $this->transaksiId == $id) {
            $this->pilihanMenu = 'tutup';
            $this->transaksiId = null;
        } else {
            $this->pilihanMenu = 'lihat';
            $this->transaksiId = $id;
        }
    }

    public function render()
    {
        $semuaTransaksi = Transaksi::with('detilTransaksi')
            ->where('status', 'selesai')
            ->get();

        $transaksiTerpilih = null;
        if ($this->pilihanMenu == 'lihat' && $this->transaksiId) {
            $transaksiTerpilih = Transaksi::with(['detilTransaksi.produk'])
                ->find($this->transaksiId);
        }

        return view('livewire.Laporan')->with([
            'semuaTransaksi' => $semuaTransaksi,
            'transaksiTerpilih' => $transaksiTerpilih,
        ]);
    }
}