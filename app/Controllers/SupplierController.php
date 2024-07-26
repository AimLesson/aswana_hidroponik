<?php

namespace App\Controllers;

use App\Models\SupplierModel;
use CodeIgniter\Controller;

class SupplierController extends Controller
{
    public function index()
    {
        $model = new SupplierModel();
        $data['suppliers'] = $model->findAll();
        return view('supplier/index', $data);
    }

    public function create()
    {
        return view('supplier/create');
    }

    public function store()
    {
        $model = new SupplierModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'phone' => $this->request->getPost('phone'),
            'rekening' => $this->request->getPost('rekening'),
            'company' => $this->request->getPost('company')
        ];
        $model->save($data);
        session()->setFlashdata('success', 'Berhasil Menambah Supplier');
        return redirect()->to('/supplier');
    }

    public function edit($id)
    {
        $model = new SupplierModel();
        $data['supplier'] = $model->find($id);
        return view('supplier/edit', $data);
    }

    public function update($id)
    {
        $model = new SupplierModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'phone' => $this->request->getPost('phone'),
            'rekening' => $this->request->getPost('rekening'),
            'company' => $this->request->getPost('company')
        ];
        $model->update($id, $data);
        session()->setFlashdata('success', 'Berhasil Mengupdate Supplier');
        return redirect()->to('/supplier');
    }

    public function delete($id)
    {
        $model = new SupplierModel();
        $model->delete($id);
        session()->setFlashdata('success', 'Berhasil Menghapus Supplier');
        return redirect()->to('/supplier');
    }
}
