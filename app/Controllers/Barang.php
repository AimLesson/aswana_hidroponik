<?php

namespace App\Controllers;

use App\Models\BarangModel;
use CodeIgniter\Controller;

class Barang extends Controller
{
    public function index() {
        $barangModel = new \App\Models\BarangModel();
        
        // Get all items with "Kurang" status for debugging
        $kurangItems = $barangModel->where('stok_produk < stok_min')->get()->getResultArray();
        
        // Log the retrieved items for debugging
        log_message('info', 'Barang with "Kurang" status: ' . print_r($kurangItems, true));
        
        // Count the number of "Kurang" items
        $kurangCount = count($kurangItems);
    
        $data = [
            'barang' => $barangModel->findAll(),
            'kurangCount' => $kurangCount,
        ];
        
        return view('barang/index', $data);
    }
    
    

    public function create()
    {
        echo view('barang/create');
    }

    public function store()
    {
        $model = new BarangModel();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga_beli' => 'required|decimal',
            'harga_jual' => 'required|decimal',
            'stok_produk' => 'required|integer',
            'stok_min' => 'required|integer',
            'satuan' => 'required',
            'gambar_produk' => 'uploaded[gambar_produk]|max_size[gambar_produk,1024]|is_image[gambar_produk]|mime_in[gambar_produk,image/jpg,image/jpeg,image/png]',
            'status_produk' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', 'Validation errors: ' . json_encode($validation->getErrors()));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('gambar_produk');
        $kode_barang = $this->request->getPost('kode_barang');
        log_message('debug', 'Received Kode Barang: ' . $kode_barang);

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);

            $data = [
                'kode_barang' => $kode_barang,
                'nama_barang' => $this->request->getPost('nama_barang'),
                'harga_beli' => $this->request->getPost('harga_beli'),
                'harga_jual' => $this->request->getPost('harga_jual'),
                'stok_produk' => $this->request->getPost('stok_produk'),
                'stok_min' => $this->request->getPost('stok_min'),
                'satuan' => $this->request->getPost('satuan'),
                'gambar_produk' => $newName,
                'status_produk' => $this->request->getPost('status_produk'),
            ];

            if ($model->save($data)) {
                log_message('info', 'Data saved successfully: ' . json_encode($data));
                session()->setFlashdata('success', 'Item created successfully!');
            } else {
                log_message('error', 'Data not saved: ' . json_encode($data));
                log_message('error', 'Model errors: ' . json_encode($model->errors()));
            }
        } else {
            log_message('error', 'File upload error: ' . $file->getErrorString() . ' (' . $file->getError() . ')');
        }

        return redirect()->to('/barang');
    }

    public function edit($kode_barang)
    {
        $model = new BarangModel();
        $data['barang'] = $model->find($kode_barang);

        echo view('barang/edit', $data);
    }

    public function update($kode_barang)
    {
        $model = new BarangModel();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_barang' => 'required',
            'harga_beli' => 'required|decimal',
            'harga_jual' => 'required|decimal',
            'stok_produk' => 'required|integer',
            'stok_min' => 'required|integer',
            'satuan' => 'required',
            'gambar_produk' => 'max_size[gambar_produk,1024]|is_image[gambar_produk]|mime_in[gambar_produk,image/jpg,image/jpeg,image/png]',
            'status_produk' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', 'Validation errors: ' . json_encode($validation->getErrors()));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('gambar_produk');

        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'stok_produk' => $this->request->getPost('stok_produk'),
            'stok_min' => $this->request->getPost('stok_min'),
            'satuan' => $this->request->getPost('satuan'),
            'status_produk' => $this->request->getPost('status_produk'),
        ];

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);
            $data['gambar_produk'] = $newName;
        }

        if ($model->update($kode_barang, $data)) {
            log_message('info', 'Data updated successfully: ' . json_encode($data));
            session()->setFlashdata('success', 'Item updated successfully!');
        } else {
            log_message('error', 'Data not updated: ' . json_encode($data));
            log_message('error', 'Model errors: ' . json_encode($model->errors()));
        }

        return redirect()->to('/barang');
    }

    public function delete($kode_barang)
    {
        $model = new BarangModel();
        $barang = $model->find($kode_barang);

        if ($barang) {
            $gambar_path = 'uploads/' . $barang['gambar_produk'];
            if (file_exists($gambar_path)) {
                unlink($gambar_path);
            }

            $model->delete($kode_barang);
        }

        session()->setFlashdata('success', 'Item deleted successfully!');
        return redirect()->to('/barang');
    }
}
