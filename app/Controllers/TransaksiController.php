<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\LogModel;
use CodeIgniter\Controller;

class TransaksiController extends Controller
{
    public function index()
    {
        $barangModel = new BarangModel();
        $data['barang'] = $barangModel->findAll();

        echo view('transaksi/index', $data);
    }

    public function processTransaction()
    {
        $barangModel = new BarangModel();
        $logModel = new LogModel();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'id' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'jenis' => 'required|in_list[in,out]',
            'name' => 'required|string',
            'purpose' => 'required|string',
            'reference_number' => 'required|string',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $id = $this->request->getPost('id');
        $nama_barang = $this->request->getPost('nama_barang');
        $jumlah = $this->request->getPost('jumlah');
        $jenis = $this->request->getPost('jenis');
        $name = $this->request->getPost('name');
        $purpose = $this->request->getPost('purpose');
        $reference_number = $this->request->getPost('reference_number');

        $barang = $barangModel->find($id);

        if ($barang === null) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        if ($jenis == 'in') {
            $new_stock = $barang['stok_produk'] + $jumlah;
        } elseif ($jenis == 'out') {
            $new_stock = $barang['stok_produk'] - $jumlah;
            if ($new_stock < 0) {
                return redirect()->back()->with('error', 'Not enough stok_produk.');
            }
        }

        $barangModel->update($id, ['stok_produk' => $new_stock]);

        $logData = [
            'kode_barang' => $id,
            'nama_barang' => $nama_barang,
            'jumlah' => $jumlah,
            'jenis' => $jenis,
            'name' => $name,
            'purpose' => $purpose,
            'reference_number' => $reference_number,
            'timestamp' => date('Y-m-d H:i:s'),
        ];

        $logModel->save($logData);

        session()->setFlashdata('success', 'Transaksi Berhasil!');
        return redirect()->to('/transaksi');
    }
}
