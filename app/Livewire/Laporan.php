<?php

namespace App\Livewire;

use App\Models\DetilTransaksi;
use App\Models\Transaksi;
use Livewire\Component;

class Laporan extends Component
{
    public $pilihanMenu = 'tutup';
    public $transaksiId;
    public $startDate;
    public $endDate;

    public $semuaTransaksi = [];
    public $transaksiTerpilih = null;

    public function mount()
    {
        $this->loadTransaksi();
    }

    public function view_pdf(){
        $mpdf = new \Mpdf\Mpdf();

        // Ambil data dari model Transaksi dengan status 'selesai' saja
        $data = Transaksi::with('detilTransaksi.produk')
            ->where('status', 'selesai')  // Menyaring status 'selesai'
            ->get();

        // Kirimkan semua data yang diperlukan ke view
        $mpdf->WriteHTML(view("livewire.laporan", [
            'pilihanMenu' => $this->pilihanMenu,
            'semuaTransaksi' => $data,
            'transaksiTerpilih' => $this->transaksiTerpilih
        ]));

        // Output file PDF ke browser
        $mpdf->Output();
    }



    public function pilihMenu($id)
    {
        if ($this->pilihanMenu == 'lihat' && $this->transaksiId == $id) {
            $this->pilihanMenu = 'tutup';
            $this->transaksiId = null;
        } else {
            $this->pilihanMenu = 'lihat';
            $this->transaksiId = $id;
        }

        $this->transaksiTerpilih = $this->pilihanMenu === 'lihat' && $this->transaksiId
            ? Transaksi::with(['detilTransaksi.produk'])->find($this->transaksiId)
            : null;
    }

    public function filterTransaksi()
    {
        $this->loadTransaksi();
    }

    private function loadTransaksi()
    {
        $query = Transaksi::with('detilTransaksi')
            ->where('status', 'selesai');

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        $this->semuaTransaksi = $query->get();
    }

    public function render()
    {
        return view('livewire.Laporan')->with([
            'semuaTransaksi' => $this->semuaTransaksi,
            'transaksiTerpilih' => $this->transaksiTerpilih,
        ]);
    }
}