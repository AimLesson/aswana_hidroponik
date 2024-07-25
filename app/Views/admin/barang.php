<?= $this->extend('layout/admin.php') ?>

<?= $this->section('content') ?>

<!-- TABEL Barang -->
<h3 class="text-3xl font-bold dark:text-white mb-3">Barang</h3>
<div class="relative border overflow-x-auto shadow-md sm:rounded-lg p-3">
    <table id="tb_supplier" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    Kode Barang
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Barang
                </th>
                <th scope="col" class="px-6 py-3">
                    Harga Beli
                </th>
                <th scope="col" class="px-6 py-3">
                    Harga Jual
                </th>
                <th scope="col" class="px-6 py-3">
                    Stok Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Gambar Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Status Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Kode Barang
                </th>
                <td class="px-6 py-4">
                    Nama Barang
                </td>
                <td class="px-6 py-4">
                    Harga Beli
                </td>
                <td class="px-6 py-4">
                    Harga Jual
                </td>
                <td class="px-6 py-4">
                    Stok Produk
                </td>
                <td class="px-6 py-4">
                    Gambar Produk (image)
                </td>
                <td class="px-6 py-4">
                    Status Produk
                </td>
                <td class="flex items-center px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>