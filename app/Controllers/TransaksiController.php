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
    $data['barang'] = $barangModel->where('status_produk', 'Tersedia')->findAll();

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
            'harga_barang' => 'required|decimal',
            'jumlah' => 'required|integer',
            'jenis' => 'required|in_list[in,out]',
            'name' => 'required|string',
            'purpose' => 'required|string',
            'reference_number' => 'required|string',
            'payment_method' => 'required|in_list[Cash,Transfer]', // Added payment_method validation
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $id = $this->request->getPost('id');
        $nama_barang = $this->request->getPost('nama_barang');
        $harga_barang = $this->request->getPost('harga_barang'); // Capture harga_barang
        $jumlah = $this->request->getPost('jumlah');
        $jenis = $this->request->getPost('jenis');
        $name = $this->request->getPost('name');
        $purpose = $this->request->getPost('purpose');
        $reference_number = $this->request->getPost('reference_number');
        $payment_method = $this->request->getPost('payment_method'); // Capture payment_method

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

        $total_harga = $harga_barang * $jumlah; // Calculate total price

        $logData = [
            'kode_barang' => $id,
            'nama_barang' => $nama_barang,
            'harga_barang' => $harga_barang, // Log harga_barang
            'jumlah' => $jumlah,
            'total_harga' => $total_harga, // Log total_harga
            'jenis' => $jenis,
            'name' => $name,
            'purpose' => $purpose,
            'reference_number' => $reference_number,
            'payment_method' => $payment_method, // Log payment_method
            'timestamp' => date('Y-m-d H:i:s'),
        ];

        $logModel->save($logData);

        session()->setFlashdata('success', 'Transaksi Berhasil!');
        return redirect()->to('/transaksi');
    }
}
