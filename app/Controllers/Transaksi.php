<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\PelangganModel;
use App\Models\BarangModel; // Gunakan BarangModel
// use App\Models\DetailTransaksiModel; // Pastikan model ini ada untuk menyimpan rincian barang

class Transaksi extends BaseController
{
    protected $transaksi;
    public function __construct()
    {
        $this->transaksi = new TransaksiModel();
    }

    public function index()
{
    // Mengambil semua kolom dari transaksi + kolom 'nama' dari pelanggan
    $data['transaksi'] = $this->transaksi
        ->select('transaksi.*, pelanggan.nama') 
        ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id')
        ->findAll();

    return view('transaksi/index', $data);
}

    public function new()
    {
        $pelangganModel = new PelangganModel();
        $barangModel    = new BarangModel(); // Inisialisasi BarangModel

        $data['pelanggan'] = $pelangganModel->findAll();
        $data['produk']    = $barangModel->findAll(); // Kirim data barang ke view dengan nama $produk
        
        return view('transaksi/create', $data);
    }

    public function create()
    {
        // Ambil data array dari form
        $barang_ids = $this->request->getPost('produk_id');
        $hargas     = $this->request->getPost('harga');
        $jumlahs    = $this->request->getPost('jumlah');

        // 1. Simpan ke tabel utama: transaksi
        $this->transaksi->insert([
            'pelanggan_id' => $this->request->getPost('pelanggan_id'),
            'tanggal'      => $this->request->getPost('tanggal'),
            'total'        => $this->request->getPost('total'),
        ]);

        $transaksi_id = $this->transaksi->insertID();

       
        
        $detailModel = new \App\Models\DetailTransaksiModel();
        foreach ($barang_ids as $key => $id_barang) {
            $detailModel->insert([
                'transaksi_id' => $transaksi_id,
                'barang_id'    => $id_barang,
                'harga'        => $hargas[$key],
                'jumlah'       => $jumlahs[$key],
                'subtotal'     => $hargas[$key] * $jumlahs[$key],
            ]);
        }
        

        return redirect()->to('/transaksi')->with('success', 'Transaksi Berhasil');
    }

    
    public function delete($id)
{
    // 1. Hapus dulu detail transaksinya (karena ada relasi Foreign Key)
    $detailModel = new \App\Models\DetailTransaksiModel();
    $detailModel->where('transaksi_id', $id)->delete();

    // 2. Baru hapus data utama transaksinya
    $this->transaksi->delete($id);

    // 3. Kembali ke halaman index dengan pesan sukses
    return redirect()->to('/transaksi')->with('success', 'Data berhasil dihapus');
}

public function edit($id)
{
    $pelangganModel = new \App\Models\PelangganModel();
    $barangModel    = new \App\Models\BarangModel();
    $detailModel    = new \App\Models\DetailTransaksiModel(); // Tambahkan ini

    $data = [
        'pelanggan' => $pelangganModel->findAll(),
        'produk'    => $barangModel->findAll(), 
        'transaksi' => $this->transaksi->find($id),
        // Ambil rincian barang berdasarkan ID transaksi
        'detail'    => $detailModel->where('transaksi_id', $id)->findAll() 
    ];

    if (!$data['transaksi']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Transaksi tidak ditemukan");
    }

    return view('transaksi/edit', $data);
}

public function show($id)
{
    // Mengambil data transaksi dan join pelanggan untuk mendapatkan nama_pelanggan
    $transaksi = $this->transaksi
        ->select('transaksi.*, pelanggan.nama as nama_pelanggan')
        ->join('pelanggan', 'pelanggan.id = transaksi.pelanggan_id')
        ->find($id);

    // Pastikan variabel $transaksi ditemukan
    if (!$transaksi) {
        return redirect()->to('/transaksi')->with('error', 'Data tidak ditemukan');
    }

    $detailModel = new \App\Models\DetailTransaksiModel();
    // Mengambil rincian barang dan join tabel barang untuk mendapatkan nama_barang dan harga
    $detail = $detailModel
        ->select('detail_transaksi.*, barang.nama_barang, barang.harga')
        ->join('barang', 'barang.id = detail_transaksi.barang_id')
        ->where('transaksi_id', $id)
        ->findAll();

    $data = [
        'transaksi' => $transaksi, // Kunci ini harus sama dengan variabel di View ($transaksi)
        'detail'    => $detail
    ];

    return view('detailtransaksi/index', $data);
}


public function update($id)
{
    $transaksiModel = new \App\Models\TransaksiModel();
    $detailModel = new \App\Models\DetailTransaksiModel();
    $barangModel = new \App\Models\BarangModel();

    // 1. Ambil data dari form
    $tanggal = $this->request->getPost('tanggal');
    $pelanggan_id = $this->request->getPost('pelanggan_id');
    $total = $this->request->getPost('total');
    $produk_ids = $this->request->getPost('produk_id');
    $hargas = $this->request->getPost('harga');
    $jumlahs = $this->request->getPost('jumlah');
    $subtotals = $this->request->getPost('subtotal');

    // 2. Update data utama transaksi
    $transaksiModel->update($id, [
        'tanggal'      => $tanggal,
        'pelanggan_id' => $pelanggan_id,
        'total'        => $total
    ]);

    // 3. Hapus detail lama (agar bisa diganti dengan yang baru/update)
    $detailModel->where('transaksi_id', $id)->delete();

    // 4. Simpan detail barang yang baru
    foreach ($produk_ids as $key => $produk_id) {
        $detailModel->save([
            'transaksi_id' => $id,
            'barang_id'    => $produk_id,
            'harga'        => $hargas[$key],
            'jumlah'       => $jumlahs[$key],
            'subtotal'     => $subtotals[$key],
        ]);
    }

    return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil diperbarui');
}
}