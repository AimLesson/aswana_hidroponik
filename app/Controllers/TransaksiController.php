<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\LogModel;
use CodeIgniter\Controller;

class TransaksiController extends Controller
{
    public function index()
    {
        log_message('info', 'TransaksiController: Index method called.');

        $barangModel = new BarangModel();
        $data['barang'] = $barangModel->where('status_produk', 'Tersedia')->findAll();

        echo view('transaksi/index', $data);
    }

    public function processTransaction()
    {
        log_message('info', 'TransaksiController: processTransaction method called.');

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
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', 'TransaksiController: Validation failed with errors: ' . json_encode($validation->getErrors()));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $id = $this->request->getPost('id');
        $nama_barang = $this->request->getPost('nama_barang');
        $harga_barang = $this->request->getPost('harga_barang');
        $jumlah = $this->request->getPost('jumlah');
        $jenis = $this->request->getPost('jenis');
        $name = $this->request->getPost('name');
        $purpose = $this->request->getPost('purpose');
        $reference_number = $this->request->getPost('reference_number');
        $payment_method = $this->request->getPost('payment_method');

        log_message('debug', 'TransaksiController: Processing transaction for item ID: ' . $id);

        $barang = $barangModel->find($id);

        if ($barang === null) {
            log_message('error', 'TransaksiController: Item with ID ' . $id . ' not found.');
            return redirect()->back()->with('error', 'Item not found.');
        }

        if ($jenis == 'in') {
            $new_stock = $barang['stok_produk'] + $jumlah;
            log_message('debug', 'TransaksiController: Incoming transaction. New stock: ' . $new_stock);
        } elseif ($jenis == 'out') {
            $new_stock = $barang['stok_produk'] - $jumlah;
            if ($new_stock < $barang['stok_min']) {
                log_message('error', 'TransaksiController: Stock Produk Kurang for item ID: ' . $id);
                return redirect()->back()->with('error', 'Stock Produk Kurang.');
            }
            log_message('debug', 'TransaksiController: Outgoing transaction. New stock: ' . $new_stock);
        }

        $barangModel->update($id, ['stok_produk' => $new_stock]);

        $total_harga = $harga_barang * $jumlah;

        $logData = [
            'kode_barang' => $id,
            'nama_barang' => $nama_barang,
            'harga_barang' => $harga_barang,
            'jumlah' => $jumlah,
            'total_harga' => $total_harga,
            'jenis' => $jenis,
            'name' => $name,
            'purpose' => $purpose,
            'reference_number' => $reference_number,
            'payment_method' => $payment_method,
            'timestamp' => date('Y-m-d H:i:s'),
        ];

        $logModel->save($logData);

        log_message('info', 'TransaksiController: Transaction processed successfully for item ID: ' . $id);

        session()->setFlashdata('success', 'Transaksi Berhasil!');
        return redirect()->to('/transaksi');
    }

    public function getTransaction($id)
    {
        log_message('info', 'TransaksiController: getTransaction method called with ID: ' . $id);

        $logModel = new LogModel();
        $transaction = $logModel->find($id);

        if ($transaction) {
            log_message('info', 'TransaksiController: Transaction found for ID: ' . $id);
            return $this->response->setJSON($transaction);
        } else {
            log_message('error', 'TransaksiController: Transaction not found for ID: ' . $id);
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Transaction not found']);
        }
    }

    public function update($id)
    {
        log_message('info', 'TransaksiController: update method called with ID: ' . $id);
    
        $logModel = new LogModel();
        $barangModel = new BarangModel();
        $data = $this->request->getJSON(true);
    
        // Fetch the original log entry
        $originalLog = $logModel->find($id);
    
        if (!$originalLog) {
            log_message('error', 'TransaksiController: Original log not found for ID: ' . $id);
            return $this->response->setJSON(['success' => false, 'message' => 'Original log not found.']);
        }
    
        // Calculate the difference in jumlah
        $originalJumlah = $originalLog['jumlah'];
        $newJumlah = $data['jumlah'];
        $difference = $newJumlah - $originalJumlah;
    
        // Fetch the corresponding barang
        $barang = $barangModel->find($originalLog['kode_barang']);
    
        if (!$barang) {
            log_message('error', 'TransaksiController: Barang not found for kode_barang: ' . $originalLog['kode_barang']);
            return $this->response->setJSON(['success' => false, 'message' => 'Barang not found.']);
        }
    
        // Adjust the stock based on the transaction type
        if ($originalLog['jenis'] == 'in') {
            $newStock = $barang['stok_produk'] + $difference;
            log_message('debug', 'TransaksiController: Updated stock for IN transaction. New stock: ' . $newStock);
        } elseif ($originalLog['jenis'] == 'out') {
            $newStock = $barang['stok_produk'] - $difference;
    
            if ($newStock < $barang['stok_min']) {
                log_message('error', 'TransaksiController: Stock Produk Kurang for barang ID: ' . $barang['id']);
                return $this->response->setJSON(['success' => false, 'message' => 'Stock Produk Kurang.']);
            }
    
            log_message('debug', 'TransaksiController: Updated stock for OUT transaction. New stock: ' . $newStock);
        }
    
        // Update the stock in the Barang table
        $barangModel->update($barang['id'], ['stok_produk' => $newStock]);
    
        // Update the log entry with the new data
        $updateSuccess = $logModel->update($id, $data);
    
        if ($updateSuccess) {
            log_message('info', 'TransaksiController: Transaction updated successfully for ID: ' . $id);
            return $this->response->setJSON(['success' => true]);
        } else {
            log_message('error', 'TransaksiController: Failed to update transaction for ID: ' . $id);
            return $this->response->setJSON(['success' => false]);
        }
    }
    

    public function delete($id)
    {
        log_message('info', 'TransaksiController: delete method called with ID: ' . $id);

        $logModel = new LogModel();
        $result = $logModel->delete($id);

        if ($result) {
            log_message('info', 'TransaksiController: Transaction deleted successfully for ID: ' . $id);
            return $this->response->setJSON(['success' => true]);
        } else {
            log_message('error', 'TransaksiController: Failed to delete transaction for ID: ' . $id);
            return $this->response->setJSON(['success' => false]);
        }
    }
}
