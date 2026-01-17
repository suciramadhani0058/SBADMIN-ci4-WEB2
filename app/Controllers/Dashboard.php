<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\PelangganModel;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $barangModel = new \App\Models\BarangModel();
        $pelangganModel = new \App\Models\PelangganModel();
        $transaksiModel = new \App\Models\TransaksiModel();
        $detailModel = new \App\Models\DetailTransaksiModel();
    
        // Mengambil data grafik (Total transaksi per bulan di tahun 2026)
        $grafik = [];
        for ($i = 1; $i <= 12; $i++) {
            $total = $transaksiModel->where('MONTH(tanggal)', $i)
                                    ->where('YEAR(tanggal)', 2026)
                                    ->selectSum('total')
                                    ->get()->getRow()->total;
            $grafik[] = $total ?? 0;
        }
    
        $data = [
            'totalBarang'    => $barangModel->countAll(),
            'totalPelanggan' => $pelangganModel->countAll(),
            'totalTransaksi' => $transaksiModel->countAll(),
            'totalDetail'    => $detailModel->selectSum('jumlah')->get()->getRow()->jumlah ?? 0,
            'grafikData'     => json_encode($grafik), // Kirim ke JS
            'stokRendah'     => $barangModel->where('stok <', 10)->findAll()
        ];
    
        return view('dashboard/index', $data);
    }
}