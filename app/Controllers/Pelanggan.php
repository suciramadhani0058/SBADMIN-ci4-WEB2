<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pelanggan extends BaseController
{
    protected $pelanggan;
    public function __construct()
    {
        $this->pelanggan = new PelangganModel();
    }

    public function index()
    {
        $data['pelanggan'] = $this->pelanggan->findAll();
        return view('pelanggan/index', $data);
    }

    public function new()
    {
        return view('pelanggan/create');
    }

    public function create()
    {
        $this->pelanggan->insert([
            'nama'         => $this->request->getPost('nama'),
            'alamat'       => $this->request->getPost('alamat'),
            'telepon'      => $this->request->getPost('telepon'),
        ]);

        return redirect()->to('/pelanggan');
    }

    public function edit($id)
    {
        $data['pelanggan'] = $this->pelanggan->find($id);
        return view('pelanggan/edit', $data);
    }

    public function update($id)
    {
        $this->pelanggan->update($id, [
            'nama'           => $this->request->getPost('nama'),
            'alamat'         => $this->request->getPost('alamat'),
            'telepon'        => $this->request->getPost('telepon'),
        ]);

        return redirect()->to('/pelanggan');
    }

    public function delete($id)
    {
        $this->pelanggan->delete($id);
        return redirect()->to('/pelanggan');
    }
}
