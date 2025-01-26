<?php

namespace App\Livewire;

use App\Models\DetilTransaksi;
use App\Models\Transaksi as ModelsTransaksi;
use Livewire\Component;
use App\Models\Produk;

class Transaksi extends Component
{
    public $kode, $total,  $kembalian, $totalSemuaBelanja;
    public $bayar = 0;
    public $transaksiAktif;
    public $jumlah;

    public function transaksiBaru(){
        $this->reset();
        $this->transaksiAktif = new ModelsTransaksi();
        $this->transaksiAktif->kode = 'INV/'. date('YmdHis');
        $this->transaksiAktif->total = 0;
        $this->transaksiAktif->status = 'pending';
        $this->transaksiAktif->save();
    }

    public function batalTransaksi(){
        if($this->transaksiAktif){
            $detilTransaksi = DetilTransaksi:: where('transaksi_id', $this->transaksiAktif->id)->get();
            foreach ($detilTransaksi as $detil){
                if($detil){
                    $produk = Produk::find($detil->produk_id);
                    $produk->stok += $detil->jumlah;
                    $produk->save();
                }
                $detil->delete();
            }
            $this->transaksiAktif->delete();
        }
        $this->reset();
    }

    public function updatedKode()
    {
        $produk = Produk::where('kode', $this->kode)->first();
        if ($produk && $produk->stok > 0) {
            $detil = DetilTransaksi::firstOrNew([
                'transaksi_id' => $this->transaksiAktif->id,
                'produk_id' => $produk->id,
            ], [
                'jumlah' => 0,
            ]);
            $detil->jumlah += 1;
            $detil->save();
            $this->reset('kode');
        }
    }


    public function updatedBayar(){

        if($this->bayar >0 ){

            $this->kembalian = $this->bayar- $this->totalSemuaBelanja;
        }
    }

    public function hapusProduk($id){
        $detil = DetilTransaksi::find($id);
        if($detil){
            $produk = Produk::find($detil->produk_id);
            $produk->stok += $detil->jumlah;
            $produk->save();
        }
        $detil->delete();

    }

    public function transaksiSelesai()
    {
        $detilTransaksi = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();

        foreach ($detilTransaksi as $detil) {
            $produk = Produk::find($detil->produk_id);
            $produk->stok -= $detil->jumlah; // Kurangi stok sesuai jumlah final
            $produk->save();
        }

        $this->transaksiAktif->total = $this->totalSemuaBelanja;
        $this->transaksiAktif->status = 'selesai';
        $this->transaksiAktif->save();

        $this->reset();
    }



public function updatedJumlah($value, $key)
{
    $detil = DetilTransaksi::find($key);

    if ($detil) {
        $produk = Produk::find($detil->produk_id);

        // Pastikan jumlah tidak melebihi stok awal + jumlah di transaksi
        if ($value > ($detil->jumlah + $produk->stok)) {
            $this->jumlah[$key] = $detil->jumlah; // Reset ke nilai sebelumnya
            return;
        }

        // Simpan perubahan jumlah tanpa mengubah stok produk
        $detil->jumlah = $value;
        $detil->save();

        // Hitung ulang total belanja
        $this->totalSemuaBelanja = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)
            ->get()
            ->sum(function ($detil) {
                return $detil->produk->harga * $detil->jumlah;
            });
    }
}


    public function render()
    {
        if ($this->transaksiAktif) {
            $semuaProduk = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();

            foreach ($semuaProduk as $produk) {
                $this->jumlah[$produk->id] = $produk->jumlah;
            }


            $totalBelanja = $semuaProduk->sum(function ($detil) {
                $hargaAsli = $detil->produk->harga;
                $jumlah = $detil->jumlah;


                if ($jumlah > 10) {
                    $hargaAsli *= 0.9;
                }

                return $hargaAsli * $jumlah;
            });

            $this->totalSemuaBelanja = $totalBelanja;
        } else {
            $semuaProduk = [];
        }

        return view('livewire.transaksi')->with([
            'semuaProduk' => $semuaProduk
        ]);
    }






}
