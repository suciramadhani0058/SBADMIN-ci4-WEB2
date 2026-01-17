<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\BarangModel;
use CodeIgniter\HTTP\ResponseInterface;

class DetailTransaksi extends BaseController
{
    protected $detailtransaksi;
    public function __construct()
    {
        $this->detailtransaksi = new DetailTransaksiModel();
    }

    public function index()
    {
        $data['detailtransaksi'] = $this->detailtransaksi
            ->select('
                detail_transaksi.id,
                detail_transaksi.transaksi_id,
                barang.nama_barang,
                barang.harga,
                detail_transaksi.jumlah,
                detail_transaksi.subtotal
            ')
            ->join('barang', 'barang.id = detail_transaksi.barang_id')
            ->findAll();
    
        return view('detailtransaksi/index', $data);
    }
    

    public function new()
    {
        $transaksiModel = new TransaksiModel();
        $data['transaksi'] = $transaksiModel->findAll();
        $barangModel = new BarangModel();
        $data['barang'] = $barangModel->findAll();
        return view('detailtransaksi/create', $data);
    }


    public function create()
    {
        $this->detailtransaksi->insert([
            'transaksi_id'     => $this->request->getPost('transaksi_id'),
            'barang_id'     => $this->request->getPost('barang_id'),
            'jumlah'          => $this->request->getPost('jumlah'),
            'subtotal'            => $this->request->getPost('subtotal'),
        ]);

        return redirect()->to('/detailtransaksi');
    }

    public function edit($id)
    {
        $transaksiModel = new TransaksiModel();
        $data['transaksi'] = $transaksiModel->findAll();
        $barangModel = new BarangModel();
        $data['barang'] = $barangModel->findAll();
        $data['detailtransaksi'] = $this->detailtransaksi->find($id);
        return view('detailtransaksi/edit', $data);
    }

    public function update($id)
    {
        $this->detailtransaksi->update($id, [
            'transaksi_id'     => $this->request->getPost('transaksi_id'),
            'barang_id'     => $this->request->getPost('barang_id'),
            'jumlah'          => $this->request->getPost('jumlah'),
            'subtotal'            => $this->request->getPost('subtotal'),
        ]);

        return redirect()->to('/detailtransaksi');
    }

    public function delete($id)
    {
        $this->detailtransaksi->delete($id);
        return redirect()->to('/detailtransaksi');
    }
}
